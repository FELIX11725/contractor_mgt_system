<?php

namespace App\Livewire\Components;

use App\Models\Budget;
use App\Models\Expense;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;
use Flasher\Prime\FlasherInterface;

class Expenses extends Component
{
    use WithPagination;

    public $showPayModal = false;
    public $modalBudgetId;
    public $modalAmountPaid;
    public $selectedProjectId = null;
    public $budgets;
    public $projects;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        if ($this->selectedProjectId) {
            $this->budgets = Budget::with(['project', 'expenses'])
                ->whereHas('project', function ($query) {
                    $query->where('project_id', $this->selectedProjectId);
                })->get();
        } elseif ($this->selectedProjectId === null) {
            $this->budgets = Budget::with(['project', 'expenses'])->get(); 
        }
        return view('livewire.components.expenses');
    }

    public function updatedSelectedProjectId()
    {
        $this->budgets = collect(); 
        $this->resetPage(); 
    }


    public function mount()
    {
        $this->projects = Project::all();
        $this->budgets = collect(); 
    }

    public function openPayModal($budgetId)
    {
        $this->modalBudgetId = $budgetId;
        $this->showPayModal = true;
    }


public function getFilteredBudgetsProperty()
{
    // If a project is selected, filter budgets by project ID
    if ($this->selectedProjectId) {
        return $this->budgets->where('project.id', $this->selectedProjectId);
    }

    // If no project is selected, return all budgets
    return $this->budgets;
}

    public function submitModalAmountPaid(FlasherInterface $flasher)
    {
        $this->validate([
            'modalAmountPaid' => 'required|numeric|min:0',
        ]);

        $budget = Budget::findOrFail($this->modalBudgetId);
        $expense = $budget->expense ?? new Expense();

        $expense->budget_id = $budget->id;
        $expense->project_id = $budget->projectPlans->project_id;
        $expense->project_plan_id = $budget->project_plan_id;
        $expense->amount_paid = $this->modalAmountPaid;
        $expense->payment_method = 'cash';
        $expense->payment_date = now();
        $expense->expense_status = 'not approved';
        $expense->save();
        
        $budget->save();

        $this->showPayModal = false;
        $flasher->addSuccess('Amount paid updated successfully.');

        $this->render();

        
    }
}
