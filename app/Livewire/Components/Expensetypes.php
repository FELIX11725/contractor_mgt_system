<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ExpenseCategory;
use App\Models\ExpenseCategoryItem;
use Flasher\Prime\FlasherInterface;

class ExpenseTypes extends Component
{
    use WithPagination; 

    // Public properties
    public $categoryId;
    public $category;
    public $showNewCategoryItemModal = false;
    public $showEditModal = false;
    public $modalType = null; // 'add', 'edit', or 'view'
    public $itemIdToEdit;
    public $name;
    public $description;
    public $amount;

    // Validation rules
    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        
    ];

    // Mount the component with the category ID
    public function mount($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->category = ExpenseCategory::findOrFail($categoryId);
    }

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
        $this->description = $item->description;
        $this->modalType = 'edit';
        $this->showEditModal = true;
    }

    // Close the modal for editing an item
    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->resetInputFields();
    }

    // Save a new item
    public function saveNewCategoryItem(FlasherInterface $flasher)
    {
        $this->validate();

        ExpenseCategoryItem::create([
            'expense_category_id' => $this->categoryId,
            'name' => $this->name,
            'description' => $this->description,
            'user_id' => auth()->id(),
        ]);

        $this->resetInputFields();
        $this->showNewCategoryItemModal = false;
        $flasher->addSuccess('Expense item created successfully!');
    }

    // Update an existing item
    public function updateCategory(FlasherInterface $flasher)
    {
        $this->validate();

        $item = ExpenseCategoryItem::findOrFail($this->itemIdToEdit);
        $item->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->resetInputFields();
        $this->showEditModal = false;
        $flasher->addSuccess('Expense item updated successfully!');
    }

    // Delete an item
    public function delete($itemId, FlasherInterface $flasher)
    {
        ExpenseCategoryItem::destroy($itemId);
        $flasher->addSuccess('Expense item deleted successfully!');
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->reset([
            'name',
            'description',
            'itemIdToEdit',
        ]);
    }

    // Render the component
    public function render()
    {
        return view('livewire.components.expensetypes', [
            'category' => $this->category,
            'items' => ExpenseCategoryItem::where('expense_category_id', $this->categoryId)
                ->paginate(10), // Paginate here instead of storing in a property
        ]);
    }
}