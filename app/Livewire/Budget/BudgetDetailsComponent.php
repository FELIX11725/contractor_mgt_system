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
    public function mount($budget){
        // dd($budget);
        $this->budget = Budget::with(['project','phase'])->find($budget);
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

public function updatedNewCategoryRate(){
    $this->calculatetotal();
}

public function updatedNewCategoryQuantity(){
    $this->calculatetotal();
}
public function calculatetotal(){
    if($this->newCategoryQuantity == "" || $this->newCategoryRate ==   "")
    {
        $this->newCategoryAmount = null;
    }
    else{
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
        'expense_category_item_id' =>$this->selectedExpenseCategory,
        'rate' => $this->newCategoryRate,
        'quantity' => $this->newCategoryQuantity,
        'estimated_amount' => $this->newCategoryAmount,
        'budget_id' => $this->budget->id,
        // Add other necessary fields
    ]);

    // Close the modal and reset the fields
    $this->closeNewBudgetItemModal();
}
    public function render()
    {
        return view('livewire.budget.budget-details-component',[
            'budgetItems' => BudgetItem::with('expenseCategoryItem')->where('budget_id', $this->budget->id)->paginate(10),
        ]);
    }
}
