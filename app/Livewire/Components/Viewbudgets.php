<?php

namespace App\Livewire\Components;

use App\Models\Budget;
use App\Models\Project;
use Livewire\Component;
use App\Models\Auditlog;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Flasher\Prime\FlasherInterface;
use Illuminate\Database\Eloquent\Collection;

class ViewBudgets extends Component
{
    use WithPagination;

    public $projects;
    public $currentProjectIndex = 0;
    public $currentProject;
    public $search = '';
    public $viewingBudget = false;
    public $editingBudget = false;
    public $deletingBudget = false;
    public $selectedBudget;
    public $showEditModal = false;
    public $originalBudgetData;
    public $showViewModal = false;
    public $showDeleteModal = false;
    public $showCreateBudgetModal = false;
    public $budgetId;
    public $allPhases; 
    public $budgetName = '';
    public $budgetDescription = '';
    public $budgetPhaseId = '';
    public $budgetEstimatedAmount = ''; 

    public function openEditModal($id)
    {
        $this->budgetId = $id;
        $this->selectedBudget = Budget::with(['phase', 'milestone'])->findOrFail($id);
        $this->originalBudgetData = $this->selectedBudget->toArray(); 
        $this->showEditModal = true;
    }

    public function openViewModal($id)
    {
        $this->budgetId = $id;
        $this->selectedBudget = Budget::with(['phase', 'milestone'])->findOrFail($id);
        $this->showViewModal = true;
    }

    public function openCreateBudgetModal()
    {
        $this->showCreateBudgetModal = true;
    }

    public function confirmDelete($id)
    {
        $this->budgetId = $id;
        $this->showDeleteModal = true;
    }

    public function deleteBudget()
    {
        $budget = Budget::find($this->budgetId);
    
        if ($budget->expenses()->exists() || $budget->projectPlans()->exists()) {
            flash()->addError('Cannot delete budget with associated records.');
            return;
        }
    
        $budget->delete();
        //log the action
        Auditlog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Deleted budget',
            'description' => 'Budget ID: ' . $this->budgetId,
            'ip_address' => request()->ip(),
        ])->save();
        $this->showDeleteModal = false;
        flash()->addSuccess('Budget deleted successfully!');
    }
    public function approveBudget($id)
{
    $budget = Budget::findOrFail($id);
    $budget->update(['approved' => true]);
    //log the action
    Auditlog::create([
        'user_id' => auth()->user()->id,
        'action' => 'Approved budget',
        'description' => 'Budget ID: ' . $id,
        'ip_address' => request()->ip(),
    ])->save();
    
    flash()->addSuccess('Budget approved successfully!');
}

public function rejectBudget($id)
{
    $budget = Budget::findOrFail($id);
    // We don't need to update the 'approved' field since we're just showing status in modal
    //log the action
    Auditlog::create([
        'user_id' => auth()->user()->id,
        'action' => 'Rejected budget',
        'description' => 'Budget ID: ' . $id,
        'ip_address' => request()->ip(),
    ])->save();
    flash()->addWarning('Budget rejected!');
}

    public function updateBudget()
    {
        $validated = $this->validate([
            'selectedBudget.budget_name' => 'required|string|max:255',
            'selectedBudget.description' => 'required|string',
            'selectedBudget.estimated_amount' => 'nullable|numeric',
        ]);
    
        $budget = Budget::findOrFail($this->selectedBudget->id);
        $budget->update($validated['selectedBudget']);
        
        // Update the selectedBudget property with the validated data
        $this->selectedBudget->budget_name = $validated['selectedBudget']['budget_name'];
        $this->selectedBudget->description = $validated['selectedBudget']['description'];
        $this->selectedBudget->estimated_amount = $validated['selectedBudget']['estimated_amount'];
        
        $this->showEditModal = false;
        //log the action
        Auditlog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Updated budget',
            'description' => 'Budget ID: ' . $this->selectedBudget->id,
            'ip_address' => request()->ip(),
        ])->save();
        flash()->addSuccess('Budget updated successfully!');
    }

    public function mount()
    {
        $this->projects = Project::with(['phases', 'milestones'])->get();
        // Extract all phases from all projects with their project information
    $this->allPhases = collect();
    foreach ($this->projects as $project) {
        if ($project->phases) {
            foreach ($project->phases as $phase) {
                // Add project information to each phase
                $phase->projectName = $project->name;
                $this->allPhases->push($phase);
            }
        }
    }

        if ($this->projects->isNotEmpty()) {
            $this->currentProject = $this->projects->first();
        }
    }

    public function downloadBudget()
    {
        $pdf = Pdf::loadView('livewire.components.budget-pdf', [
            'budgets' => $this->budgets,
            'currentProject' => $this->currentProject,
        ]);

        //log the action
        Auditlog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Downloaded budget report',
            'description' => 'Budget report downloaded',
            'ip_address' => request()->ip(),
        ])->save();
        flash()->addSuccess('Budget report downloaded successfully!');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'budget-report.pdf');
    }
    public function saveBudget()
    {
        // Validation needs to match your form fields
        $this->validate([
            'budgetName' => 'required|string|max:255',
            'budgetDescription' => 'nullable|string',
            'budgetPhaseId' => 'required|exists:phases,id',
            // Add estimated_amount validation if it exists in your form
        ]);
        
        // Create the budget with correct field names and phase ID
        $budget = Budget::create([
            'budget_name' => $this->budgetName,
            'description' => $this->budgetDescription,
            // Add estimated_amount if it exists in your form
            'phase_id' => $this->budgetPhaseId, // This should be the selected phase ID, not the project ID
        ]);
        //log the action
        Auditlog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Created budget',
            'description' => 'Budget ID: ' . $budget->id,
            'ip_address' => request()->ip(),
        ])->save();
        
        // Show success message
        flash()->addSuccess('Budget created successfully!');
        
        // Reset form fields
        $this->reset([
            'budgetName',
            'budgetDescription',
            'budgetPhaseId',
            // Reset estimated_amount if it exists
        ]);
        
        // Close the modal
        $this->showCreateBudgetModal = false;
    }

    public function getBudgetsProperty()
{
    if (!$this->currentProject) {
        return collect();
    }

    return Budget::query()
        ->where(function($query) {
            $query->whereHas('phase', function($phaseQuery) {
                $phaseQuery->where('project_id', $this->currentProject->id);
            });
           
        })
        ->when($this->search, function($query) {
            $query->where(function($q) {
                $q->where('budget_name', 'like', '%'.$this->search.'%')
                  ->orWhere('description', 'like', '%'.$this->search.'%');
            });
        })
        ->with(['phase', 'milestone'])
        ->paginate(10);
}
    public function goToProject($index)
    {
        $this->currentProjectIndex = $index;
        $this->currentProject = $this->projects[$index];
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.components.viewbudgets', [
            'budgets' => $this->budgets,
        ]);
    }
}