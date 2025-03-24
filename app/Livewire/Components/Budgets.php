<?php

namespace App\Livewire\Components;

use App\Models\Budget;
use App\Models\Project;
use Livewire\Component;

class Budgets extends Component
{
    public $project;
    public $activeTab = 'ProfileTab';
    public $newBudgetModal_isOpen = false;
    public $budgetName;
    public $budgetDescription;
    public $budgetPhaseId;

    protected $listeners = ['budgetCreated' => '$refresh']; // Refresh component when a budget is created


    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function saveBudget()
    {
        $this->validate([
            'budgetName' => 'required',
            'budgetDescription' => 'nullable|string', // Or your desired validation
            'budgetPhaseId' => 'nullable|exists:phases,id', // Ensure phase ID exists
        ]);

        Budget::create([
            'project_id' => $this->project->id,
            'phase_id' => $this->budgetPhaseId,
            'budget_name' => $this->budgetName,
            'description' => $this->budgetDescription,
        ]);

        $this->closeNewBudgetModal();
        $this->emit('budgetCreated'); // Emit event to refresh the component
    }

    public function closeNewBudgetModal()
    {
        $this->newBudgetModal_isOpen = false;
        $this->reset(['budgetName', 'budgetDescription', 'budgetPhaseId']); // Reset the input fields
    }

    public function render()
    {
        $budgets = Budget::whereHas('phase', function ($query) {  // Use whereHas
            $query->where('project_id', $this->project->id);  
        })->with('phase')->get();
    
        return view('livewire.components.budgets', compact('budgets'));
    }
}