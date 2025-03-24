<?php

namespace App\Livewire\Components;

use App\Models\Expense;
use App\Models\Project;
use Livewire\Component;
use App\Models\BudgetItem;
use Illuminate\Support\Facades\DB;
use App\Models\ExpenseCategoryItem;
use Illuminate\Support\Facades\Validator;

class AddExpense extends Component
{
    // State properties
    public $date_of_pay;
    public $category_id;
    public $amount;
    public $description;
    public $expenses = [];

    public $projects = [], $budgets = [];
    public $project, $budget, $budgetProject;

    // Fetch financial categories for the dropdown
    public $financialCategories;

    public function mount()
    {
        // Load financial categories when the component is initialized
        $this->financialCategories = ExpenseCategoryItem::all();
        $this->date_of_pay = date("Y-m-d");
        $this->projects = Project::with('budgets')->get();
    }

    public function updatedProject()
    {
        if ($this->project) {
            $this->budgetProject = Project::with('budgets')->find($this->project);
            $this->budgets = $this->budgetProject->budgets;
        }
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
        // $budgetItem = BudgetItem::where('expense_category_item_id', $this->category_id)->first();

        // if ($budgetItem) {
        // Add the expense to the list with the budget_items_id
        $this->expenses[] = [
            'category_id' => $this->category_id,
            'amount' => $this->amount,
            'description' => $this->description,
        ];

        // Clear the input fields
        $this->reset(['category_id', 'amount', 'description']);
        // } else {
        //     // Handle the case where no budget item is found for the selected category
        //     session()->flash('error', 'No budget item found for the selected category.');
        // }
    }

    // Save all expenses to the database
    public function createExpense()
    {
        // Validate the date of payment
        $this->validate([
            'date_of_pay' => 'required|date',
            'project' => "required|exists:projects,id",
            'budget' => "required|exists:budgets,id",
        ]);


        DB::transaction(function () {
            foreach ($this->expenses as $expense) {

                $budgetItem = BudgetItem::where('expense_category_item_id', $expense['category_id'])
                    ->where('budget_id', $this->budget)
                    ->first();

                Expense::create([
                    'budget_items_id' => $budgetItem->id,
                    'amount_paid' => $expense['amount'],
                    'date_of_pay' => $this->date_of_pay,
                    'description' => $expense['description'],
                ]);
            }
        });
        // Save each expense to the database


        // Clear the expenses list and reset the form
        $this->reset(['expenses', 'project', 'budget']);

        $this->date_of_pay = date("Y-m-d");
        // Show a success message
        flash()->addSuccess('Expenses saved successfully!');
    }

    // Close the modal or reset the form
    public function closeNewExpenseModal()
    {
        $this->reset(['date_of_pay', 'category_id', 'amount', 'description', 'expenses']);
        $this->date_of_pay = date("Y-m-d");
    }

    public function render()
    {
        return view('livewire.components.add-expense');
    }
}
