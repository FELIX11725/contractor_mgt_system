<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Auditlog;
use Livewire\WithPagination;
use App\Models\ExpenseCategory;
use App\Models\ExpenseCategoryItem;

class Expenses extends Component
{
    use WithPagination;

    public $showNewCategoryModal = false;
    public $showEditModal = false;
    public $selectedCategories = [];
    public $selectAll = false;
    public $newCategoryName;
    public $newCategoryDescription;
    public $newCategoryCode;

    // Fields for editing an existing category
    public $editCategoryId;
    public $editCategoryName;
    public $editCategoryDescription;
    public $editCategoryCode;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $expenseCategories = ExpenseCategory::paginate(10);
        $expenseCategoryItems = ExpenseCategoryItem::all();
        return view('livewire.components.expenses', ['expenseCategories' => $expenseCategories,
            'expenseCategoryItems' => $expenseCategoryItems]);
    }

    // Open the modal for creating a new category
    public function openNewCategoryModal()
    {
        $this->showNewCategoryModal = true;
    }

    public function activateSelected() {
        ExpenseCategory::whereIn('id', $this->selectedCategories)->update(['is_active' => true]);
        $this->selectedCategories = [];
        $this->selectAll = false;
        // Add flash message
    }
    
    public function deactivateSelected() {
        ExpenseCategory::whereIn('id', $this->selectedCategories)->update(['is_active' => false]);
        $this->selectedCategories = [];
        $this->selectAll = false;
        // Add flash message
        flash()->addSuccess('Expense Category Deactivated');
    }
    
    // For individual actions
    public function activateCategory($id) {
        ExpenseCategory::find($id)->update(['is_active' => true]);
        // Add flash message
        flash()->addSuccess('Expense Category Activated');
    }
    
    public function deactivateCategory($id) {
        ExpenseCategory::find($id)->update(['is_active' => false]);
        // Add flash message
        flash()->addSuccess('Expense Category Deactivated');
    }
    
    // For sorting
    public function sortBy($field) {
        // Implement your sorting logic here
    }

    // Close the modal for creating a new category and reset fields
    public function closeNewCategoryModal()
    {
        $this->showNewCategoryModal = false;
        $this->reset(['newCategoryName', 'newCategoryDescription', 'newCategoryCode']);
    }

    // Save a new category
    public function saveNewCategory()
    {
        $this->validate([
            'newCategoryName' => 'required|string|max:255',
            'newCategoryDescription' => 'nullable|string',
            'newCategoryCode' => 'nullable|string|max:50',
        ]);

        ExpenseCategory::create([
            'name' => $this->newCategoryName,
            'description' => $this->newCategoryDescription,
            'code' => $this->newCategoryCode,
            'user_id' => auth()->id(),
        ]);
        // Log the action
        Auditlog::create([
            'user_id' => auth()->id(),
            'action' => 'Created a new expense category',
            'description' => 'Expense Category: '.$this->newCategoryName,
            'ip_address' => request()->ip(),
        ])->save();

        flash()->addSuccess('Expense Added');

        $this->closeNewCategoryModal();
    }

    // Open the modal for editing an existing category
    public function openEditModal($id)
    {
        $category = ExpenseCategory::findOrFail($id);
        $this->editCategoryId = $category->id;
        $this->editCategoryName = $category->name;
        $this->editCategoryDescription = $category->description;
        $this->editCategoryCode = $category->code;
        $this->showEditModal = true;
    }
    public function viewDetails($categoryId)
{
    return redirect()->route('expensetypes', ['categoryId' => $categoryId]);
}

    // Close the modal for editing an existing category and reset fields
    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->reset(['editCategoryId', 'editCategoryName', 'editCategoryDescription', 'editCategoryCode']);
    }

    // Update an existing category
    public function updateCategory()
    {
        $this->validate([
            'editCategoryName' => 'required|string|max:255',
            'editCategoryDescription' => 'nullable|string',
            'editCategoryCode' => 'nullable|string|max:50',
        ]);

        $category = ExpenseCategory::findOrFail($this->editCategoryId);
        $category->update([
            'name' => $this->editCategoryName,
            'description' => $this->editCategoryDescription,
            'user_id' => auth()->id(),
        ]);

        $this->closeEditModal();
    }


}