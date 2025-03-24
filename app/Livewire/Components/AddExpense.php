<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Expense;
use App\Models\ExpenseCategoryItem;
use App\Models\BudgetItem;
use Illuminate\Support\Facades\Validator;

class AddExpense extends Component
{
    // State properties
    public $date_of_pay;
    public $category_id;
    public $amount;
    public $description;
    public $expenses = [];

    // Fetch financial categories for the dropdown
    public $financialCategories;

    public function mount()
    {
        // Load financial categories when the component is initialized
        $this->financialCategories = ExpenseCategoryItem::all();
    }

    // Add an expense to the list
    public function addExpense()
    {
        // Validate the input fields
        $this->validate([
            'category_id' => 'required|exists:expense_category_items,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
        ]);

        // Find the corresponding budget item for the selected category
        $budgetItem = BudgetItem::where('expense_category_item_id', $this->category_id)->first();

        if ($budgetItem) {
            // Add the expense to the list with the budget_items_id
            $this->expenses[] = [
                'budget_items_id' => $budgetItem->id,
                'category_id' => $this->category_id,
                'amount' => $this->amount,
                'description' => $this->description,
            ];

            // Clear the input fields
            $this->reset(['category_id', 'amount', 'description']);
        } else {
            // Handle the case where no budget item is found for the selected category
            session()->flash('error', 'No budget item found for the selected category.');
        }
    }

    // Save all expenses to the database
    public function createExpense()
    {
        // Validate the date of payment
        $this->validate([
            'date_of_pay' => 'required|date',
        ]);

        // Save each expense to the database
        foreach ($this->expenses as $expense) {
            Expense::create([
                'budget_items_id' => $expense['budget_items_id'],
                'amount_paid' => $expense['amount'],
                'date_of_pay' => $this->date_of_pay,
                'description' => $expense['description'],
            ]);
        }

        // Clear the expenses list and reset the form
        $this->reset(['expenses', 'date_of_pay']);

        // Show a success message
        session()->flash('success', 'Expenses saved successfully!');
    }

    // Close the modal or reset the form
    public function closeNewExpenseModal()
    {
        $this->reset(['date_of_pay', 'category_id', 'amount', 'description', 'expenses']);
    }

    public function render()
    {
        return view('livewire.components.add-expense');
    }
}