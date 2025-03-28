<?php

namespace App\Livewire\Components;

use App\Models\Budget;
use App\Models\Project;
use Livewire\Component;
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
    public $budgetId;

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

    public function confirmDelete($id)
    {
        $this->budgetId = $id;
        $this->showDeleteModal = true;
    }

    public function deleteBudget(FlasherInterface $flasher)
    {
        $budget = Budget::find($this->budgetId);
    
        if ($budget->expenses()->exists() || $budget->projectPlans()->exists()) {
            flash()->addError('Cannot delete budget with associated records.');
            return;
        }
    
        $budget->delete();
        $this->showDeleteModal = false;
        flash()->addSuccess('Budget deleted successfully!');
    }

    public function updateBudget(FlasherInterface $flasher)
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
        flash()->addSuccess('Budget updated successfully!');
    }

    public function mount()
    {
        $this->projects = Project::with(['projectplan', 'projectplan.phases', 'projectplan.milestones'])->get();

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

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'budget-report.pdf');
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