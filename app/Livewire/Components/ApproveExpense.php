<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Expense;
use App\Models\ExpenseCategoryItem;
use App\Models\PaymentMethod;
use App\Models\ExpenseApproval;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;

class ApproveExpense extends Component
{
    use WithPagination;

    public $filtersModal_isOpen = false;
    public $addPaymentModal_isOpen = false;

    public $selectedReqs = [];
    public $payment_method;
    public $transaction_id;
    public $expenseIdForPayment;

    #[Url(as: 'fd', keep: true)]
    public $from_date;

    #[Url(as: 'td', keep: true)]
    public $to_date;

    #[Url(as: 'cat', keep: true)]
    public $category = "";

    #[Url(as: 'pp', keep: true)]
    public $perPage = 10;

    #[Url(as: 'sb', keep: true)]
    public $sort_by = "date_of_pay";

    #[Url(as: 'sd', keep: true)]
    public $sort_dir = "desc";

    #[Url(as: 'sc', keep: true)]
    public $searchColumn = "description";

    #[Url(as: 'q', keep: true)]
    public $search = "";

    public function mount()
    {
        $this->from_date = $this->from_date ?? now()->subDays(30)->format('Y-m-d');
        $this->to_date = $this->to_date ?? now()->format('Y-m-d');
    }

    public function sortBy($field)
    {
        if ($this->sort_by === $field) {
            $this->sort_dir = $this->sort_dir === "asc" ? "desc" : "asc";
        } else {
            $this->sort_by = $field;
            $this->sort_dir = "asc";
        }
    }

    public function openFiltersModal()
    {
        $this->filtersModal_isOpen = true;
    }

    public function closeFiltersModal()
    {
        $this->filtersModal_isOpen = false;
    }

    public function openPaymentModal($expenseId)
    {
        $this->expenseIdForPayment = $expenseId;
        $this->addPaymentModal_isOpen = true;
    }

    public function closePaymentModal()
    {
        $this->reset(['payment_method', 'transaction_id', 'expenseIdForPayment']);
        $this->addPaymentModal_isOpen = false;
    }

    public function approveExpense($expenseId)
    {
        $expense = Expense::findOrFail($expenseId);

        // Check if the expense is already approved
        $existingApproval = ExpenseApproval::where('expense_id', $expenseId)->first();

        if ($existingApproval && $existingApproval->is_approved) {
            flash()->addError( 'This expense is already approved.');
            return;
        }

        // Create or update the approval record
        ExpenseApproval::updateOrCreate(
            ['expense_id' => $expenseId],
            [
                'user_id' => Auth::id(),
                'is_approved' => true,
                'comment' => 'Approved by ' . Auth::user()->name,
            ]
        );

        flash()->addInfo( 'Expense approved successfully.');
    }

    public function declineExpense($expenseId)
    {
        $expense = Expense::findOrFail($expenseId);

        // Check if the expense is already declined
        $existingApproval = ExpenseApproval::where('expense_id', $expenseId)->first();

        if ($existingApproval && !$existingApproval->is_approved) {
            flash()->addError( 'This expense is already declined.');
            return;
        }

        // Create or update the approval record
        ExpenseApproval::updateOrCreate(
            ['expense_id' => $expenseId],
            [
                'user_id' => Auth::id(),
                'is_approved' => false,
                'comment' => 'Declined by ' . Auth::user()->name,
            ]
        );

        flash()->addInfo( 'Expense declined successfully.');
    }

    public function addPayment()
    {
        $this->validate([
            'payment_method' => 'required|exists:payment_methods,id',
            'transaction_id' => 'required|string|max:255',
        ]);

        $expense = Expense::findOrFail($this->expenseIdForPayment);
        $expense->update([
            'payment_method_id' => $this->payment_method,
            'transaction_id' => $this->transaction_id,
        ]);

        $this->closePaymentModal();
        flash()->addInfo( 'Payment details added successfully.');
    }

    public function render()
    {
        $expenses = Expense::with(['category', 'paymentMethod', 'approvals'])
            ->whereBetween('date_of_pay', [$this->from_date, $this->to_date])
            ->when($this->category !== "", function ($query) {
                return $query->where('budget_items_id', $this->category);
            })
            ->when($this->search !== "", function ($query) {
                return $query->where($this->searchColumn, 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sort_by, $this->sort_dir)
            ->paginate($this->perPage);

        $categories = ExpenseCategoryItem::all();
        $paymentMethods = PaymentMethod::all();

        return view('livewire.components.approve-expense', [
            'expenses' => $expenses,
            'categories' => $categories,
            'paymentMethods' => $paymentMethods,
        ]);
    }
}