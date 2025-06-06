<?php

namespace App\Livewire\Expenses;

use Livewire\Component;
use App\Models\Auditlog;
use Livewire\WithPagination;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\Auth;

class ExpenseCategoriesComponent extends Component
{
    use WithPagination;
    
    // for new/edit category
    public $name, $description, $category_id;
    
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
        $this->resetExcept(['search', 'sortDir', 'sortField']);
        $this->showCreateModal = true;
    }
    
    // Create new category
    public function store()
    {
        $this->validate();
        
        ExpenseCategory::create([
            'name' => $this->name,
            'description' => $this->description,
            'user_id' => Auth::user()->id,
        ]);
        // log the action
        Auditlog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Created expense category',
            'description' => 'Expense category name: ' . $this->name,
            'ip_address' => request()->ip(),
        ])->save();
        flash()->addSuccess('Expense category created successfully!');
        
        $this->showCreateModal = false;
        $this->resetExcept(['search', 'sortDir', 'sortField']);
       
    }
    
    // Open edit modal
    public function edit($id)
    {
        $this->resetValidation();
        $this->resetExcept(['search', 'sortDir', 'sortField']);
        
        $category = ExpenseCategory::findOrFail($id);
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->showEditModal = true;

        // log the action
        Auditlog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Editing expense category',
            'description' => 'Expense category name: ' . $this->name,
            'ip_address' => request()->ip(),
        ])->save();

        flash()->addInfo('Editing expense category: ' . $this->name);
    }
    
    // Update category
    public function update()
    {
        $this->validate();
        
        $category = ExpenseCategory::findOrFail($this->category_id);
        $category->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);
        
        $this->showEditModal = false;
        $this->resetExcept(['search', 'sortDir', 'sortField']);
        // log the action
        Auditlog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Updated expense category',
            'description' => 'Expense category name: ' . $this->name,
            'ip_address' => request()->ip(),
        ])->save();
        flash()->addSuccess('Expense category updated successfully!');
    }
    
    // Confirm delete
    public function confirmDelete($id)
    {
        $this->category_id = $id;
        $this->showDeleteModal = true;
    }
    
    // Delete category
    public function delete()
    {
        $category = ExpenseCategory::findOrFail($this->category_id);
        $category->delete();
        
        $this->showDeleteModal = false;
        $this->resetExcept(['search', 'sortDir', 'sortField']);
        // log the action
        Auditlog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Deleted expense category',
            'description' => 'Expense category name: ' . $category->name,
            'ip_address' => request()->ip(),
        ])->save();
        
        flash()->addSuccess('Expense category deleted successfully!');
    }
    
    // Cancel any modal
    public function cancel()
    {
        $this->showCreateModal = false;
        $this->showEditModal = false;
        $this->showDeleteModal = false;
        $this->resetValidation();
        $this->resetExcept(['search', 'sortDir', 'sortField']);
    }
    
    public function render()
    {
        return view('livewire.expenses.expense-categories-component', [
            'expenseCategories' => ExpenseCategory::query()
                ->when($this->search, function ($query) {
                    $query->where('name', "like", "%" . $this->search . "%")
                        ->orWhere('description',  "like", "%" . $this->search . "%");
                })
                ->where('user_id', Auth::user()->id)
                ->orderBy($this->sortField, $this->sortDir)
                ->paginate(10),
        ]);
    }
}