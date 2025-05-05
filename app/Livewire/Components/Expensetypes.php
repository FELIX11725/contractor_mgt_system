<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Auditlog;
use Livewire\WithPagination;
use App\Models\ExpenseCategory;
use App\Models\ExpenseCategoryItem;
use Flasher\Prime\FlasherInterface;

class ExpenseTypes extends Component
{
    use WithPagination; 

    // Public properties
    public $showNewCategoryItemModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $itemIdToDelete;
    
    // Form properties
    public $name;
    public $expense_category_id;
    public $has_quantity = 0;
    public $itemIdToEdit;

    // Validation rules
    protected $rules = [
        'name' => 'required|string|max:255',
        'expense_category_id' => 'required|exists:expense_categories,id',
        'has_quantity' => 'required|boolean',
    ];

    // Open the modal for adding a new item
    public function openNewCategoryItemModal()
    {
        $this->resetInputFields();
        $this->showNewCategoryItemModal = true;
    }

    // Close the modal for adding a new item
    public function closeNewCategoryModal()
    {
        $this->showNewCategoryItemModal = false;
        $this->resetInputFields();
    }

    // Open the modal for editing an item
    public function openEditModal($itemId)
    {
        $this->resetInputFields();
        $item = ExpenseCategoryItem::findOrFail($itemId);
        $this->itemIdToEdit = $item->id;
        $this->name = $item->name;
        $this->expense_category_id = $item->expense_category_id;
        $this->has_quantity = $item->has_quantity;
        $this->showEditModal = true;
    }

    // Close the modal for editing an item
    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->resetInputFields();
    }

    // Open delete confirmation modal
    public function confirmDelete($itemId)
    {
        $this->itemIdToDelete = $itemId;
        $this->showDeleteModal = true;
    }

    // Close delete confirmation modal
    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->itemIdToDelete = null;
    }

    // Save a new item
    public function saveNewCategoryItem()
    {
        $this->validate();

        ExpenseCategoryItem::create([
            'name' => $this->name,
            'expense_category_id' => $this->expense_category_id,
            'has_quantity' => $this->has_quantity,
            'user_id' => auth()->id(),
        ]);
        // Log the action
        Auditlog::create([
            'user_id' => auth()->id(),
            'action' => 'Created a new expense item',
            'description' => 'Expense Item: '.$this->name,
            'ip_address' => request()->ip(),
        ])->save();

        $this->resetInputFields();
        $this->showNewCategoryItemModal = false;
        flash()->addSuccess('Expense item created successfully!');
    }

    // Update an existing item
    public function updateCategory(FlasherInterface $flasher)
    {
        $this->validate();

        $item = ExpenseCategoryItem::findOrFail($this->itemIdToEdit);
        $item->update([
            'name' => $this->name,
            'expense_category_id' => $this->expense_category_id,
            'has_quantity' => $this->has_quantity,
        ]);

        $this->resetInputFields();
        $this->showEditModal = false;
        flash()->addSuccess('Expense item updated successfully!');
    }

    // Delete an item
    public function deleteCategory(FlasherInterface $flasher)
    {
        $item = ExpenseCategoryItem::find($this->itemIdToDelete);
        
        if($item->budgetsItems()->exists()){
            flash()->addError('Cannot delete expense item that has been used in budgeting.');
            $this->closeDeleteModal();
            return;
        }

        $item->delete();
        $this->closeDeleteModal();
        flash()->addSuccess('Expense item deleted successfully!');
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->reset([
            'name',
            'expense_category_id',
            'has_quantity',
            'itemIdToEdit',
            'itemIdToDelete',
        ]);
    }


    public function render()
    {
        return view('livewire.components.expensetypes', [
            'items' => ExpenseCategoryItem::with('expenseCategory')
                ->latest()
                ->paginate(10),
            'categories' => ExpenseCategory::orderBy('name')->get(),
        ]);
    }
}