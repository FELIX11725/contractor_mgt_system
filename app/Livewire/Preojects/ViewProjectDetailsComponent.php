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

    public $phase_name, $end_date, $start_date;
    public $milestone_name;

    public function createPhase()
    {
        // Validate inputs
        $this->validate([
            'phase_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',  // Ensure end date is after or equal to start date
        ]);

        // Create new Phase
        Phase::create([
            'name' => $this->phase_name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phase_status' => 'pending',  // Default status
            'project_id' => $this->project->id
        ]);

        // Reset form fields
        $this->reset(['phase_name', 'start_date', 'end_date']);

        // Optionally, hide the form
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


    public function calculateTimelineWidth($startDate, $endDate)
    {
        // Make sure to parse the dates correctly using Carbon
        $start = \Carbon\Carbon::parse($startDate);
        $end = \Carbon\Carbon::parse($endDate);

        // Calculate the number of days the phase lasts
        $totalDays = $end->diffInDays($start);

        // Calculate the total project duration to scale the width correctly
        $projectStart = \Carbon\Carbon::parse($this->project->start_date);
        $projectEnd = \Carbon\Carbon::parse($this->project->end_date);
        $projectDuration = $projectStart->diffInDays($projectEnd);

        // Return the width as a percentage of the total project duration
        return ($totalDays / $projectDuration) * 100;
    }

    public function calculateMilestonePosition($milestoneDate)
    {
        // Make sure to parse the milestone date using Carbon
        $milestone = \Carbon\Carbon::parse($milestoneDate);

        // Calculate the position of the milestone relative to the project start date
        $projectStart = \Carbon\Carbon::parse($this->project->start_date);
        $daysSinceStart = $milestone->diffInDays($projectStart);

        // Calculate the total project duration
        $projectEnd = \Carbon\Carbon::parse($this->project->end_date);
        $projectDuration = $projectStart->diffInDays($projectEnd);

        // Return the milestone's position as a percentage along the project timeline
        return ($daysSinceStart / $projectDuration) * 100;
    }




    public function render()
    {
        // Get phases and milestones, then merge them into a single collection
        $phases = Phase::with('milestones')
            ->where('project_id', $this->project->id)
            ->orderBy('start_date')
            ->get()
            ->map(function ($phase) {
                return [
                    'type' => 'phase',
                    'id' => $phase->id,
                    'name' => $phase->name,
                    'start_date' => $phase->start_date,
                    'due_date' => $phase->due_date,
                    'details' => $phase->description,
                ];
            });

        $milestones = Milestone::where('project_id', $this->project->id)
            ->orderBy('due_date')
            ->get()
            ->map(function ($milestone) {
                return [
                    'type' => 'milestone',
                    'id' => $milestone->id,
                    'name' => $milestone->name,
                    'start_date' => $milestone->start_date,
                    'due_date' => $milestone->due_date,
                    'details' => $milestone->description,
                ];
            });

        // Merge phases and milestones, order by start date and due date
        $timelineItems = $phases->merge($milestones)
            ->sortBy(function ($item) {
                return [$item['start_date'], $item['due_date']];
            });

        return view('livewire.preojects.view-project-details-component', [
            'timelineItems' => $timelineItems,
        ]);
    }
}
