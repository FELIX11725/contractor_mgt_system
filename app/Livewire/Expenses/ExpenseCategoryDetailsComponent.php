<?php

namespace App\Livewire\Expenses;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ExpenseCategory;
use App\Models\ExpenseCategoryItem;
use Illuminate\Support\Facades\Auth;

class ExpenseCategoryDetailsComponent extends Component
{
    use WithPagination;

    public $category;

    // for item management
    public $name, $description, $item_id;

    // for viewing items
    public $search = "", $sortDir = "desc", $sortField = "created_at";

    // for modals
    public $showCreateModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;

    // validation rules
    protected $rules = [
        'name' => 'required|min:3|max:255',
        'description' => 'nullable|max:1000',
    ];

    public function mount($category)
    {
        $this->category = ExpenseCategory::findOrFail($category);

        abort_if($this->category->user_id != auth()->user()->id, 403, "This resource is not available for you");
    }

    // Reset pagination when search changes
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Set sorting
    public function setSorting($field)
    {
        if ($this->sortField === $field) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDir = 'asc';
        }
    }

    // Open create modal
    public function openCreateModal()
    {
        $this->resetValidation();
        $this->resetExcept(['category', 'search', 'sortDir', 'sortField']);
        $this->showCreateModal = true;
    }

    // Create new item
    public function store()
    {
        $this->validate();

        ExpenseCategoryItem::create([
            'expense_category_id' => $this->category->id,
            'name' => $this->name,
            'description' => $this->description,
            'user_id' => Auth::user()->id,
        ]);

        $this->showCreateModal = false;
        $this->resetExcept(['category', 'search', 'sortDir', 'sortField']);
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Item created successfully!'
        ]);
    }

    // Open edit modal
    public function edit($id)
    {
        $this->resetValidation();
        $this->resetExcept(['category', 'search', 'sortDir', 'sortField']);

        $item = ExpenseCategoryItem::findOrFail($id);
        $this->item_id = $item->id;
        $this->name = $item->name;
        $this->description = $item->description;

        $this->showEditModal = true;
    }

    // Update item
    public function update()
    {
        $this->validate();

        $item = ExpenseCategoryItem::findOrFail($this->item_id);

        // Security check
        abort_if($item->expense_category_id != $this->category->id, 403);

        $item->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->showEditModal = false;
        $this->resetExcept(['category', 'search', 'sortDir', 'sortField']);
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Item updated successfully!'
        ]);
    }

    // Confirm delete
    public function confirmDelete($id)
    {
        $this->item_id = $id;
        $this->showDeleteModal = true;
    }

    // Delete item
    public function delete()
    {
        $item = ExpenseCategoryItem::findOrFail($this->item_id);

        // Security check
        abort_if($item->expense_category_id != $this->category->id, 403);

        $item->delete();

        $this->showDeleteModal = false;
        $this->resetExcept(['category', 'search', 'sortDir', 'sortField']);
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Item deleted successfully!'
        ]);
    }

    // Cancel any modal
    public function cancel()
    {
        $this->showCreateModal = false;
        $this->showEditModal = false;
        $this->showDeleteModal = false;
        $this->resetValidation();
        $this->resetExcept(['category', 'search', 'sortDir', 'sortField']);
    }

    // Back to categories list
    public function backToCategories()
    {
        return redirect()->route('expenses.manage-categories');
    }

    public function render()
    {
        return view('livewire.expenses.expense-category-details-component', [
            'categoryItems' => ExpenseCategoryItem::query()
                ->where('expense_category_id', $this->category->id)
                ->when($this->search, function ($query) {
                    $query->where('name', "like", "%" . $this->search . "%")
                        ->orWhere('description',  "like", "%" . $this->search . "%");
                })
                ->orderBy($this->sortField, $this->sortDir)
                ->paginate(10),
        ]);
    }
}
