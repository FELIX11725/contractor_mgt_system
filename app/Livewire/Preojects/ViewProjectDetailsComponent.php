<?php

namespace App\Livewire\Preojects;

use App\Models\Phase;
use App\Models\Budget;
use App\Models\Project;
use Livewire\Component;
use App\Models\Milestone;
use App\Models\Projectmilestone;

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
    public $milestoneType = 'project'; // 'project' or 'phase'
    public $newBudgetModal_isOpen = false;
    public $showMilestoneForm = false;

    public $phase_id;

    public function mount($project)
{
    $this->project = Project::findOrFail($project);
    $this->budgets = $this->fetchBudgets(); 
}

    public function closeNewBudgetModal()
    {
        $this->newBudgetModal_isOpen = false;
    }

    public function saveBudget()
    {
        // dd($this->budget);
        // Validate the input fields
        $this->validate([
            'budgetName' => "required",
            'budgetDescription' => "nullable",
            'budgetPhaseId' => "required|exists:phases,id",
        ]);
    
        // Create the budget
        Budget::create([
            'budget_name' => $this->budgetName ?? null, // Match the column name in the `budgets` table
            'description' => $this->budgetDescription ?? null, // Match the column name in the `budgets` table
            'phase_id' => $this->budgetPhaseId, // Match the column name in the `budgets` table
        ]);
    
        // Show success message
        flash()->addSuccess("Budget saved");
    
        // Reset the form fields
        $this->reset([
            'budgetName',
            'budgetPhaseId',
            'budgetDescription',
            'newBudgetModal_isOpen',
        ]);
    
        // Refresh the budgets list
        $this->budgets = $this->fetchBudgets();
    }

    public function fetchBudgets()
    {
        // Get all phase IDs associated with the project
        $phaseIds = $this->project->phases->pluck('id');
    
        // Fetch budgets where phase_id is in the list of phase IDs
        return Budget::whereIn('phase_id', $phaseIds)
                     ->with('phase')
                     ->get();
    }
public function viewBudgetDetails($budgetId)
{
    // Logic to view budget details
    $this->budgetId = $budgetId;
    // You can open a modal or navigate to a different view here
}

public function approveBudget($budgetId)
{
    // Logic to approve the budget
    $budget = Budget::findOrFail($budgetId);
    $budget->update(['status' => 'approved']);
    flash()->addSuccess("Budget approved successfully");
    $this->budgets = $this->fetchBudgets(); // Refresh the budgets list
}

    public $phase_name, $end_date, $start_date;
    public $milestone_name;
    public $showPhaseForm = false;

    public function openPhaseModal()
{
    $this->showPhaseForm = true;
}

public function closePhaseModal()
{
    $this->showPhaseForm = false;
    $this->reset(['phase_name', 'start_date', 'end_date']); // Reset form fields
}

    public function openMilestoneModal()
{
    $this->showMilestoneForm = true;
}

public function closeMilestoneModal()
{
    $this->showMilestoneForm = false;
    $this->reset(['milestone_name', 'milestoneType', 'phase_id']); // Reset form fields
}

    public function createPhase()
    {
        $this->validate([
            'phase_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Phase::create([
            'name' => $this->phase_name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phase_status' => 'pending',  // Default status
            'project_id' => $this->project->id
        ]);

        $this->closePhaseModal(); // Close the modal after saving
    flash()->addSuccess('Phase created successfully!');
    }

    public function createMilestone()
    {
        $this->validate([
            'milestone_name' => 'required|string|max:255',
            'milestoneType' => 'required|in:project,phase',
            'phase_id' => 'required_if:milestoneType,phase|exists:phases,id',
        ]);
    
        Milestone::create([
            'milestone_name' => $this->milestone_name,
            'due_date' => now()->addDays(7),
            'project_id' => $this->project->id,
            'phase_id' => $this->milestoneType === 'phase' ? $this->phase_id : null,
        ]);
    
        $this->closeMilestoneModal();
        flash()->addSuccess('Milestone created successfully!');
    }

    public function calculateTimelineWidth($startDate, $endDate)
    {
        $start = \Carbon\Carbon::parse($startDate);
        $end = \Carbon\Carbon::parse($endDate);
        $totalDays = $end->diffInDays($start);

        $projectStart = \Carbon\Carbon::parse($this->project->start_date);
        $projectEnd = \Carbon\Carbon::parse($this->project->end_date);
        $projectDuration = $projectStart->diffInDays($projectEnd);

        return ($totalDays / $projectDuration) * 100;
    }

    public function calculateMilestonePosition($milestoneDate)
    {
        $milestone = \Carbon\Carbon::parse($milestoneDate);
        $projectStart = \Carbon\Carbon::parse($this->project->start_date);
        $daysSinceStart = $milestone->diffInDays($projectStart);

        $projectEnd = \Carbon\Carbon::parse($this->project->end_date);
        $projectDuration = $projectStart->diffInDays($projectEnd);

        return ($daysSinceStart / $projectDuration) * 100;
    }

    public function calculatePhaseProgress($phaseStatus)
    {
        // Map phase_status to progress percentage
        return match ($phaseStatus) {
            'completed' => 100,
            'active' => 50,
            'pending' => 0,
            default => 0,
        };
    }

    public function calculateOverallProgress()
    {
        // Calculate overall progress based on phase statuses
        $phases = Phase::where('project_id', $this->project->id)->get();
        $totalPhases = $phases->count();
        $completedPhases = $phases->where('phase_status', 'completed')->count();

        return $totalPhases > 0 ? round(($completedPhases / $totalPhases) * 100) : 0;
    }

   public function render()
{
    // Fetch budgets
    $this->budgets = $this->fetchBudgets();

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
                'due_date' => $phase->end_date,
                'details' => $phase->description,
                'phase_status' => $phase->phase_status,
                'progress' => $this->calculatePhaseProgress($phase->phase_status),
                'milestones' => $phase->milestones->map(function ($milestone) {
                    return [
                        'type' => 'milestone',
                        'id' => $milestone->id,
                        'name' => $milestone->name,
                        'due_date' => $milestone->due_date,
                        'details' => $milestone->description,
                        'phase_id' => $milestone->phase_id, 
                    ];
                }),
            ];
        });

    $milestones = Milestone::where('project_id', $this->project->id)
        ->whereNull('phase_id')
        ->orderBy('due_date')
        ->get()
        ->map(function ($milestone) {
            return [
                'type' => 'milestone',
                'id' => $milestone->id,
                'name' => $milestone->name,
                'due_date' => $milestone->due_date,
                'details' => $milestone->description,
                'phase_id' => null,
            ];
        });

    // Merge phases and milestones, order by start date and due date
    $timelineItems = $phases->merge($milestones)
        ->sortBy(function ($item) {
            return [$item['start_date'] ?? $item['due_date'], $item['due_date'] ?? $item['start_date']];
        });

    // Calculate overall project progress
    $overallProgress = $this->calculateOverallProgress();

    return view('livewire.preojects.view-project-details-component', [
        'timelineItems' => $timelineItems,
        'overallProgress' => $overallProgress,
        'phases' => $phases,
        'budgets' => $this->budgets,
    ]);
}
}