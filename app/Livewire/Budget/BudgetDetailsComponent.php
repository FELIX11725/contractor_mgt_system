<?php

namespace App\Livewire\Budget;

use App\Models\Budget;
use Livewire\Component;
use App\Models\BudgetItem;
use Livewire\WithPagination;
use App\Models\ExpenseCategoryItem;

class BudgetDetailsComponent extends Component
{
    use WithPagination;
    public $expenseCategoryItems;
    public $showNewBudgetItemModal = false;
    public $newCategoryName;
    public $newCategoryRate;
    public $newCategoryQuantity, $selectedExpenseCategory;
    public $newCategoryAmount;
    public $budget;
    public $showEditBudgetItemModal = false;
    public $editBudgetItemId;
    public $editCategoryRate;
    public $editCategoryQuantity;
    public $editCategoryAmount;
    public $selectedEditExpenseCategory;
    public $showDeleteBudgetItemModal = false;

    protected $rules = [
        'editCategoryRate' => 'required|numeric',
        'editCategoryQuantity' => 'nullable|numeric',
        'editCategoryAmount' => 'nullable|numeric',
        'selectedEditExpenseCategory' => 'required|exists:expense_category_items,id',
    ];

    public function mount($budget)
    {
        $this->budget = Budget::with(['project', 'phase'])->find($budget);
        $this->expenseCategoryItems = ExpenseCategoryItem::all();
    }
    public function openNewBudgetItemModal()
    {
        $this->showNewBudgetItemModal = true;
    }

    public function closeNewBudgetItemModal()
    {
        $this->showNewBudgetItemModal = false;
        $this->reset(['newCategoryName', 'newCategoryRate', 'newCategoryQuantity', 'newCategoryAmount']);
    }

    public function openEditBudgetItemModal($itemId)
    {
        $this->editBudgetItemId = $itemId;
        $budgetItem = BudgetItem::find($itemId);

        $this->selectedEditExpenseCategory = $budgetItem->expense_category_item_id;
        $this->editCategoryRate = $budgetItem->rate;
        $this->editCategoryQuantity = $budgetItem->quantity;
        $this->editCategoryAmount = $budgetItem->estimated_amount;

        $this->showEditBudgetItemModal = true;
    }

    public function closeEditBudgetItemModal()
    {
        $this->showEditBudgetItemModal = false;
        $this->reset([
            'editBudgetItemId',
            'selectedEditExpenseCategory',
            'editCategoryRate',
            'editCategoryQuantity',
            'editCategoryAmount',
        ]);
    }

    public function updatedEditCategoryRate()
    {
        $this->calculateEditTotal();
    }

    public function updatedEditCategoryQuantity()
    {
        $this->calculateEditTotal();
    }

    public function calculateEditTotal()
    {
        if ($this->editCategoryQuantity && $this->editCategoryRate) {
            $this->editCategoryAmount = $this->editCategoryQuantity * $this->editCategoryRate;
        } else {
            $this->editCategoryAmount = null;
        }
    }

    public function updateBudgetItem()
    {
        // Validate the input fields
        $this->validate([
            'editCategoryRate' => 'required|numeric',
            'editCategoryQuantity' => 'nullable|numeric',
            'editCategoryAmount' => 'nullable|numeric',
            'selectedEditExpenseCategory' => 'required|exists:expense_category_items,id',
        ]);

        // Update the budget item in the database
        $budgetItem = BudgetItem::find($this->editBudgetItemId);
        $budgetItem->update([
            'expense_category_item_id' => $this->selectedEditExpenseCategory,
            'rate' => $this->editCategoryRate,
            'quantity' => $this->editCategoryQuantity,
            'estimated_amount' => $this->editCategoryAmount,
        ]);
        //flash message



        $this->closeEditBudgetItemModal();
        flash()->addSuccess('Budget Item Updated');
    }

    public function openDeleteBudgetItemModal($itemId)
    {
        $this->editBudgetItemId = $itemId;
        $this->showDeleteBudgetItemModal = true;
    }

    public function closeDeleteBudgetItemModal()
    {
        $this->showDeleteBudgetItemModal = false;
    }

    public function deleteBudgetItem()
    {
        // Delete the budget item from the database
        BudgetItem::destroy($this->editBudgetItemId);

        // Close the modal
        $this->closeDeleteBudgetItemModal();
        flash()->addSuccess('Budget Item Deleted');
    }
    public function updatedNewCategoryRate()
    {
        $this->calculatetotal();
    }

    public function updatedNewCategoryQuantity()
    {
        $this->calculatetotal();
    }
    public function calculatetotal()
    {
        if ($this->newCategoryQuantity == "" || $this->newCategoryRate ==   "") {
            $this->newCategoryAmount = null;
        } else {
            $this->newCategoryAmount = $this->newCategoryQuantity * $this->newCategoryRate;
        }
    }
    public function saveNewBudgetItem()
    {

        // Validate the input fields
        $this->validate([
            'newCategoryRate' => 'required|numeric',
            'newCategoryQuantity' => 'nullable|numeric',
            'newCategoryAmount' => 'nullable|numeric',
        ]);

        // Save the new budget item to the database
        BudgetItem::create([
            'expense_category_item_id' => $this->selectedExpenseCategory,
            'rate' => $this->newCategoryRate,
            'quantity' => $this->newCategoryQuantity,
            'estimated_amount' => $this->newCategoryAmount,
            'budget_id' => $this->budget->id,
        ]);



        // Close the modal and reset the fields
        $this->closeNewBudgetItemModal();

        flash()->addSuccess('Budget Item Added');
    }
    public function render()
    {
        return view('livewire.budget.budget-details-component', [
            'budgetItems' => BudgetItem::with('expenseCategoryItem')
                ->where('budget_id', $this->budget->id)
                ->withSum('expenses', 'amount_paid')
                ->withSum('approvedExpenses', 'amount_paid')
                ->paginate(10),
        ]);
    }
}
