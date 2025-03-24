<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Expense;
use App\Models\ExpenseCategoryItem;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExpensesExport;
use Illuminate\Support\Str;
use Livewire\Attributes\Url;

class ViewExpense extends Component
{
    use WithPagination;

    public $filtersModal_isOpen = false;

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
        // Set default date range if not provided
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

    public function exportExcelReport()
    {
        $this->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $expenses = Expense::with('category')
            ->whereBetween('date_of_pay', [$this->from_date, $this->to_date])
            ->when($this->category !== "", function ($query) {
                return $query->where('budget_items_id', $this->category);
            })
            ->when($this->search !== "", function ($query) {
                return $query->where($this->searchColumn, 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sort_by, $this->sort_dir)
            ->get();

        return Excel::download(new ExpensesExport($expenses), 'expenses_' . Str::slug(date('Y-m-d H:i:s')) . '.xlsx');
    }

    public function render()
    {
        $expenses = Expense::with('category')
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

        return view('livewire.components.view-expense', [
            'expenses' => $expenses,
            'categories' => $categories,
        ]);
    }
}