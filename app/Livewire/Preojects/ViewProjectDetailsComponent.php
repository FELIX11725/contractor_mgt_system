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
    public $milestoneType = 'project';
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
            'budget_name' => $this->budgetName ?? null, 
            'description' => $this->budgetDescription ?? null,
            'phase_id' => $this->budgetPhaseId,
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

    // Create the phase
    $phase = Phase::create([
        'name' => $this->phase_name,
        'start_date' => $this->start_date,
        'end_date' => $this->end_date,
        'phase_status' => 'pending',  
        'project_id' => $this->project->id
    ]);

    // Check if the project already has the default milestones
    $existingMilestones = Milestone::where('project_id', $this->project->id)
        ->whereIn('milestone_name', ['Start Project', 'End Project'])
        ->count();

    // If the default milestones don't exist, create them
    if ($existingMilestones == 0) {
        Milestone::create([
            'project_id' => $this->project->id,
            'milestone_name' => 'Start Project',
            'due_date' => $this->start_date,
            'description' => 'Start of the project',
            'milestone_status' => 'pending',
        ]);

        Milestone::create([
            'project_id' => $this->project->id,
            'milestone_name' => 'End Project',
            'due_date' => $this->end_date,
            'description' => 'End of the project',
            'milestone_status' => 'pending',
        ]);
    }

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

   public function calculateMilestoneProgress($milestoneStatus)
{
    // Map milestone_status to progress percentage
    return match ($milestoneStatus) {
        'completed' => 100,
        'in_progress' => 50,
        'pending' => 0,
        default => 0,
    };
}

public function calculateOverallProgress()
{
    // Calculate overall progress based on milestones instead of phases
    $milestones = Milestone::where('project_id', $this->project->id)->get();
    $totalMilestones = $milestones->count();
    $completedMilestones = $milestones->where('status', 'completed')->count();

    return $totalMilestones > 0 ? round(($completedMilestones / $totalMilestones) * 100) : 0;
}

public function render()
{
    // Fetch budgets
    $this->budgets = $this->fetchBudgets();

    // Get milestones only (excluding phases)
    $milestones = Milestone::where('project_id', $this->project->id)
        ->orderBy('due_date')
        ->get()
        ->map(function ($milestone) {
            return [
                'type' => 'milestone',
                'id' => $milestone->id,
                'name' => $milestone->milestone_name, // Corrected property name
                'due_date' => $milestone->due_date,
                'details' => $milestone->description,
                'progress' => $this->calculateMilestoneProgress($milestone->milestone_status), // Ensure correct status field
            ];
        });

    // Sort milestones by due date
    $timelineItems = $milestones->sortBy('due_date');

    // Calculate overall project progress based on milestones
    $overallProgress = $this->calculateOverallProgress();

    return view('livewire.preojects.view-project-details-component', [
        'timelineItems' => $timelineItems,
        'overallProgress' => $overallProgress,
        'budgets' => $this->budgets,
        'milestones' => $milestones, // Add this line
    ]);
}
}