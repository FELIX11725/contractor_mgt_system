<?php

namespace App\Livewire\Preojects;

use Livewire\Component;
use App\Models\Project;
use App\Models\Budget;
use App\Models\Phase;
use App\Models\Milestone;

class ViewProjectDetailsComponent extends Component
{
    public $project;
    public $activeTab = "PlansTab";

    public $budgetName;
    public $budgetDescription;
    public $budgetEstimatedAmount;
    public $budgetPhaseId;
    public $budgetProjectPlanId;
    public $budgetId;
    public $budgets;
    public $showBudgetForm = false;

    public $newBudgetModal_isOpen = false;

    public $phase_id;

    public function mount($project)
    {
        $this->project = Project::findOrFail($project);

        // $this->loadBudgets();
    }

    public function closeNewBudgetModal()
    {
        $this->newBudgetModal_isOpen = false;
    }

    public function saveBudget()
    {

        $this->validate([
            'budgetName' => "required",
            'budgetDescription' => "nullable",
            'budgetPhaseId' => "required|exists:phases,id",
        ]);

        $phase = Phase::findOrFail($this->budgetPhaseId);

        Budget::create([
            'name' => $this->budgetName ?? null,
            'description' => $this->budgetDescription ?? null,
            'phase_id' => $this->budgetPhaseId,
            'project_plan_id' => $phase->project_plan_id,
        ]);

        flash()->addSuccess("Budget saved");

        $this->reset([
            'budgetName',
            "budgetPhaseId",
            "budgetDescription",
            "newBudgetModal_isOpen",
        ]);
    }

    public $showPhaseForm = false;
    public $showMilestoneForm = false;

    public $phase_name;
    public $milestone_name;

    public function createPhase()
    {
        Phase::create([
            'name' => $this->phase_name,
            'phase_status' => "pending",
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'project_id' => $this->project->id,
        ]);
        $this->phase_name = "";
        $this->showPhaseForm = false;
    }

    public function createMilestone()
    {
        Milestone::create([
            'milestone_name' => $this->milestone_name,
            'due_date' => now()->addDays(7),
            'project_id' => $this->project->id,
            'phase_id' => $this->phase_id ?? null,
        ]);
        $this->milestone_name = "";
        $this->showMilestoneForm = false;
    }




    public function render()
    {

        return view('livewire.preojects.view-project-details-component', [
            'phases' => Phase::with('milestones')->get(),
        ]);
    }
}
