<?php

namespace App\Livewire\Components;

use App\Models\Budget;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Flasher\Prime\FlasherInterface;
use Illuminate\Database\Eloquent\Collection;

class Viewbudgets extends Component
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
        $this->selectedBudget = Budget::findOrFail($id);
        $this->originalBudgetData = $this->selectedBudget->toArray(); 

        $this->showEditModal = true;
    }

    public function openViewModal($id)
    {
        $this->budgetId = $id;
        $this->selectedBudget = Budget::findOrFail($id);
        $this->showViewModal = true;
    }

    public function confirmDelete($id)
    {
        $this->budgetId = $id;
        $this->showDeleteModal = true;
    }

    public function deleteBudget(FlasherInterface $flasher)
    {
        // Find the budget to be deleted
        $budget = Budget::find($this->budgetId);
    
        // Check if the budget has any related records
        if ($budget->expenses()->exists() || $budget->projectPlans()->exists()) { // Replace 'relatedRecords' with the actual relation method name
            $flasher->addError('Cannot delete budget with associated records.');
            return;
        }
    
        // If no related records, proceed with deletion
        $budget->delete();
        $this->showDeleteModal = false;
        $flasher->addSuccess('Budget deleted successfully!');
    }

    public function updateBudget(FlasherInterface $flasher)
    {
        Budget::findOrFail($this->selectedBudget);
        $this->selectedBudget->update([
            'selectedBudget.expense_item' => $this->selectedBudget['expense_item'],
            'selectedBudget.estimated_amount' => $this->selectedBudget['estimated_amount'],
        ]); 

        $this->showEditModal = false;
        $flasher->addSuccess('Budget updated successfully!');

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
    // Fetch the budget data
    $budgetData = $this->budgetData;

    // Load the view and pass data to it
    $pdf = Pdf::loadView('livewire.components.budget-pdf', [
        'budgetData' => $budgetData,
        'currentProject' => $this->currentProject,
    ]);

    // Download the PDF
    return response()->streamDownload(function () use ($pdf) {
        echo $pdf->stream();
    }, 'budget-report.pdf');
}

public function getBudgetDataProperty()
{
    if (!$this->currentProject) {
        return collect(); // Return empty collection if no project is selected
    }

    $planMethod = $this->currentProject->projectplan?->plan_method;

    $items = match ($planMethod) {
        'milestones' => $this->currentProject->projectplan?->milestones->pluck('name') ?? collect(),
        'phases' => $this->currentProject->projectplan?->phases->pluck('name') ?? collect(),
        default => collect(),
    };

    // Fetch paginated budgets
    $paginatedBudgets = Budget::whereIn('project_plan_item_name', $items)
        ->when($this->search, fn($query) => $query->where('expense_item', 'like', '%' . $this->search . '%'))
        ->paginate(10); // Paginate the query

    // Group the paginated results
    $groupedBudgets = $paginatedBudgets->groupBy('project_plan_item_name');

    // Return the paginator with grouped data
    return $paginatedBudgets->setCollection($groupedBudgets);
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

        // $planMethod = $this->currentProject->projectplan?->plan_method;

        // $items = match ($planMethod) {
        //     'milestones' => $this->currentProject->projectplan?->milestones->pluck('name') ?? collect(),
        //     'phases' => $this->currentProject->projectplan?->phases->pluck('name') ?? collect(),
        //     default => collect(),
        // };

        return view('livewire.components.viewbudgets', [
            'budgetData' => $this->budgetData,
        ]);
    }
}