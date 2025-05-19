<?php

namespace App\Livewire\Preojects;

use App\Models\Phase;
use App\Models\Budget;
use App\Models\Project;
use Livewire\Component;
use App\Models\Auditlog;
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
    public $showStatusModal = false;
    public $currentMilestoneId;
    public $currentMilestoneStatus;
    public $newStatus = 'pending';
    public $completionDate;
    public $currentMilestoneName;
    public $statusNotes;
    public $progressFilter = 'all';
    protected $chartData = [];

protected $listeners = ['milestoneUpdated', 'syncProgress' => '$refresh'];
public function getTotalMilestonesProperty()
{
    return $this->project->milestones->count();
}

public function getCompletedMilestonesProperty()
{
    return $this->project->milestones->where('milestone_status', 'completed')->count();
}

public function getInProgressMilestonesProperty()
{
    return $this->project->milestones->whereIn('milestone_status', ['active', '50_complete', '80_complete', '95_complete'])->count();
}
public function getPendingMilestonesProperty()
{
    return $this->project->milestones->where('milestone_status', 'pending')->count();
}
public function getFilteredMilestonesProperty()
{
    return $this->project->milestones
        ->when($this->progressFilter === 'completed', fn($query) => $query->where('milestone_status', 'completed'))
        ->when($this->progressFilter === 'in_progress', fn($query) => $query->whereIn('milestone_status', ['active', '50_complete', '80_complete', '95_complete']))
        ->when($this->progressFilter === 'pending', fn($query) => $query->where('milestone_status', 'pending'));
}
// Computed property: Updates automatically when milestones change
public function getOverallProgressProperty()
{
    if ($this->project->milestones->isEmpty()) {
        return 0;
    }

    $totalWeight = $this->project->milestones->sum('weight') ?: $this->project->milestones->count();
    $completedWeight = $this->project->milestones->sum(function ($milestone) {
        return $this->getMilestoneProgress($milestone) * ($milestone->weight ?? 1);
    });

    $progress = ($totalWeight > 0) 
        ? round(($completedWeight / $totalWeight) * 100) 
        : 0;

    // Ensure 100% if project is marked completed (even if milestones are not fully tracked)
    return ($this->project->project_status === 'completed') ? 100 : min($progress, 100);
}

protected function getMilestoneProgress($milestone)
{
    return match ($milestone->milestone_status) {
        'pending'    => 0,
        'active'     => 10,
        '50_complete' => 50,
        '80_complete' => 80,
        '95_complete' => 95,
        'completed'  => 100,
        default      => 0,
    };
}


public function openStatusModal($milestoneId)
{
    $milestone = Milestone::findOrFail($milestoneId);
    $this->currentMilestoneId = $milestoneId;
    $this->currentMilestoneName = $milestone->milestone_name;
    $this->currentMilestoneStatus = $milestone->milestone_status;
    $this->newStatus = $milestone->milestone_status;
    $this->completionDate = $milestone->completion_date ?? now()->format('Y-m-d');
    $this->showStatusModal = true;
}
public function closeStatusModal()
{
    $this->reset([
        'showStatusModal',
        'currentMilestoneId',
        'currentMilestoneName',
        'currentMilestoneStatus',
        'newStatus',
        'completionDate',
        'statusNotes'
    ]);
}

public function updateMilestoneStatus()
{
    // Validate input
    $this->validate([
        'newStatus' => 'required|in:pending,active,50_complete,80_complete,95_complete,completed',
        'completionDate' => 'nullable|date|required_if:newStatus,50_complete,80_complete,95_complete,completed',
        'statusNotes' => 'nullable|string|max:500',
    ]);

    // Update the milestone
    $milestone = Milestone::findOrFail($this->currentMilestoneId);
    $milestone->update([
        'milestone_status' => $this->newStatus,
        'completion_date' => in_array($this->newStatus, ['50_complete', '80_complete', '95_complete', 'completed']) 
            ? $this->completionDate 
            : null,
        'notes' => $this->statusNotes,
    ]);

    // Refresh project data
    $this->project = $this->project->fresh();

    // Determine the new project status based on milestones
    $milestones = $this->project->milestones;
    $newProjectStatus = $this->calculateProjectStatus($milestones);

    // Update the project status if it changed
    if ($this->project->project_status !== $newProjectStatus) {
        $this->project->update(['project_status' => $newProjectStatus]);
        $this->project = $this->project->fresh(); // Refresh again
    }

    // Log the action
    Auditlog::create([
        'user_id' => auth()->id(),
        'action' => 'Updated milestone status',
        'description' => "Updated milestone '{$milestone->milestone_name}' to '{$this->newStatus}'",
        'ip_address' => request()->ip(),
    ]);

    // Close modal and notify
    // $this->emitSelf('syncProgress');
    $this->closeStatusModal();
    $this->dispatch('milestoneUpdated');
    flash()->addSuccess('message', 'Milestone status updated successfully!');

    
}

/**
 * Calculate the project status based on milestone statuses.
 */
protected function calculateProjectStatus($milestones)
{
    if ($milestones->isEmpty()) {
        return 'pending'; // Default if no milestones exist
    }

    // Check if ALL milestones are completed
    $allCompleted = $milestones->every(function ($milestone) {
        return $milestone->milestone_status === 'completed';
    });

    if ($allCompleted) {
        return 'completed';
    }

    // Check if ANY milestone is in progress (or partially complete)
    $anyInProgress = $milestones->contains(function ($milestone) {
        return in_array($milestone->milestone_status, ['active', '50_complete', '80_complete', '95_complete']);
    });

    if ($anyInProgress) {
        return 'in_progress';
    }

    // Default: all pending
    return 'pending';
}



    public function mount($project)
{
    $this->project = Project::findOrFail($project);
    $this->budgets = $this->fetchBudgets(); 
    $this->generateChartData();
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
        // Log the action
        Auditlog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Created budget',
            'description' => 'Budget ID: ' . $this->budgetId,
            'ip_address' => request()->ip(),
        ])->save();
    
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
    // Log the action
    Auditlog::create([
        'user_id' => auth()->id(),
        'action' => 'Created a new phase',
        'description' => 'Phase: '.$this->phase_name,
        'ip_address' => request()->ip(),
    ])->save();

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
        // Log the action
        Auditlog::create([
            'user_id' => auth()->id(),
            'action' => 'Created a new milestone',
            'description' => 'Milestone: '.$this->milestone_name,
            'ip_address' => request()->ip(),
        ])->save();
        
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
protected function generateChartData()
{
    $this->chartData = [
        'labels' => ['Pending', 'Active', '50% Complete', '80% Complete', '95% Complete', 'Completed'],
        'datasets' => [
            [
                'label' => 'Milestones',
                'data' => [
                    $this->pendingMilestones,
                    $this->project->milestones()->where('milestone_status', 'active')->count(),
                    $this->project->milestones()->where('milestone_status', '50_complete')->count(),
                    $this->project->milestones()->where('milestone_status', '80_complete')->count(),
                    $this->project->milestones()->where('milestone_status', '95_complete')->count(),
                    $this->completedMilestones
                ],
                'backgroundColor' => [
                    '#6B7280', // gray
                    '#F59E0B', // yellow
                    '#3B82F6', // blue
                    '#3B82F6', // blue
                    '#3B82F6', // blue
                    '#10B981'  // green
                ],
            ]
        ]
    ];
}


public function render()
{
    $this->generateChartData();
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
        'totalMilestones' => $this->totalMilestones,
        'completedMilestones' => $this->completedMilestones,
        'inProgressMilestones' => $this->inProgressMilestones,
        'pendingMilestones' => $this->pendingMilestones,
        'filteredMilestones' => $this->filteredMilestones,
        'overallProgress' => $overallProgress,
        'budgets' => $this->budgets,
        'milestones' => $milestones,
        'chartData' => $this->chartData,
    ]);
}
}