<?php
namespace App\Livewire\Components;

use App\Models\Phase;
use App\Models\Budget;
use Livewire\Component;
use App\Models\Milestone;
use App\Models\Projectplan;
use Livewire\WithPagination;
use Flasher\Prime\FlasherInterface;

class Budgets extends Component
{
    use WithPagination;
    public $planMethod; // 'milestones' or 'phases'
    public $itemNames = []; // Names of milestones or phases
    public $unbudgetedItems = []; // Track unbudgeted milestones or phases
    public $currentItemIndex = 0;
    public $currentItemName;
    public $expenseItems = [
        ['name' => '', 'amount' => '']
    ];
    public $perPage = 5;
    public $allItemsBudgeted = false;
    public $projects;
    public $project_plan_id;
    public $selectedProjectId = null;
    public $budgetSubmitted = false; // Track if budget is submitted
    public $budgetApproved = false; // Track if budget is approved
    public $budgetsForSelectedProject = [];
    public $editingBudget = null; // Budget model being edited
    public $editExpenseItem;
    public $editEstimatedAmount;
    public $showAddExtraExpenseModal = false; // Track modal visibility
    public $extraExpenseItem;
    public $extraEstimatedAmount;

    public function mount()
    {
        $this->projects = Projectplan::with('project')->paginate($this->perPage)->items();
    }

    public function selectProject($projectId)
    {
        $this->selectedProjectId = $projectId;
        $this->resetBudgetState(); // Reset state when switching projects

        $projectPlan = Projectplan::find($this->selectedProjectId);
        if ($projectPlan) {
            $this->planMethod = $projectPlan->plan_method;

            // Fetch all milestones and phases for the project
            $milestones = $projectPlan->milestones->pluck('name')->toArray();
            $phases = $projectPlan->phases->pluck('name')->toArray();

            // Combine milestones and phases into a single array
            $this->itemNames = array_merge($milestones, $phases);

            $this->loadBudgetsForSelectedProject(); // Load existing budgets
            $this->unbudgetedItems = $this->getUnbudgetedItems(); // Recalculate unbudgeted items

             if (!empty($this->unbudgetedItems)) {
                $this->currentItemName = $this->unbudgetedItems[$this->currentItemIndex];
                $this->loadBudgetItems();
            } else {
                $this->allItemsBudgeted = true; // All items are budgeted
            }

        } else {
            // Handle project not found
        }
    }

    private function resetBudgetState()
    {
        $this->planMethod = null;
        $this->itemNames = [];
        $this->unbudgetedItems = [];
        $this->currentItemIndex = 0;
        $this->currentItemName = null;
        $this->expenseItems = [['name' => '', 'amount' => '']];
        $this->allItemsBudgeted = false;
        $this->budgetSubmitted = false;
        $this->budgetApproved = false;
    }

    public function addExpenseItem()
    {
        $this->expenseItems[] = ['name' => '', 'amount' => ''];
    }

    public function removeExpenseItem($index)
    {
        if (count($this->expenseItems) > 1) {
            unset($this->expenseItems[$index]);
            $this->expenseItems = array_values($this->expenseItems);
        }
    }

    public function previousItem()
    {
        if ($this->currentItemIndex > 0) {
            $this->currentItemIndex--;
            $this->currentItemName = $this->unbudgetedItems[$this->currentItemIndex];
            $this->loadBudgetItems();
        }
    }

    public function submitBudget(FlasherInterface $flasher)
    {
        $this->validate([
            'expenseItems.*.name' => 'required|string',
            'expenseItems.*.amount' => 'required|numeric',
        ]);
        
        foreach ($this->expenseItems as $item) {
            $amount = str_replace(',', '', $item['amount']);
            if (!is_numeric($amount)) {
                $flasher->addError('Invalid amount format for expense: ' . $item['name']);
                return; 
            }
    
            Budget::create([
                'project_plan_id' => $this->selectedProjectId,
                'project_plan_item_name' => $this->currentItemName,
                'expense_item' => $item['name'],
                'estimated_amount' => $amount,
                'approved' => false, // Budget is not approved yet
            ]);
        }
        $this->expenseItems = [['name' => '', 'amount' => '']];
        $this->loadBudgetsForSelectedProject(); // Refresh the budgets table data
        $this->unbudgetedItems = $this->getUnbudgetedItems(); // Recalculate after submitting

        if (!empty($this->unbudgetedItems)) {
            $this->currentItemIndex = 0; // Start from the beginning of the unbudgeted items. Could change this for a smoother flow and less "jumping around"
            $this->currentItemName = $this->unbudgetedItems[$this->currentItemIndex];
            $this->loadBudgetItems();
             $flasher->addSuccess('Budget submitted for ' . $this->currentItemName . '.  Please budget for the next item.'); // Or similar message for next item.
        } else {
            $this->allItemsBudgeted = true;
            $flasher->addSuccess('All milestones and phases have been budgeted for.');
        }
    }

    public function nextItem()
    {
        if ($this->currentItemIndex < count($this->unbudgetedItems) - 1) {
            $this->currentItemIndex++;
            $this->currentItemName = $this->unbudgetedItems[$this->currentItemIndex];
            $this->loadBudgetItems();
        }
    }

    public function loadBudgetItems()
    {
        $this->expenseItems = Budget::where('project_plan_item_name', $this->currentItemName)->get()->toArray();
        if (empty($this->expenseItems)) {
            $this->expenseItems = [['name' => '', 'amount' => '']];
        }
    }

    public function loadBudgetsForSelectedProject()
    {
        if ($this->selectedProjectId) {
            // Get the grouped budgets
            $groupedBudgets = Budget::with('projectPlans')
                ->where('project_plan_id', $this->selectedProjectId)
                ->orderBy('created_at')
                ->get()
                ->groupBy('project_plan_item_name');

            // Transform the grouped collection into an array Livewire can handle
            $this->budgetsForSelectedProject = $groupedBudgets->map(function ($group, $itemName) {
                return [
                    'item_name' => $itemName,  // Add the item name
                    'budgets' => $group->toArray(), // Convert the group to an array
                ];
            })->toArray(); // Convert the entire collection to an array

        } else {
            $this->budgetsForSelectedProject = []; // Empty array if no project selected
        }
    }

    public function getUnbudgetedItems()
    {
        $unbudgeted = [];
        foreach ($this->itemNames as $itemName) {
            $budgeted = Budget::where('project_plan_item_name', $itemName)->exists();
            if (!$budgeted) {
                $unbudgeted[] = $itemName;
            }
        }
        return $unbudgeted;
    }

    public function editBudget(Budget $budget)
    {
        $this->editingBudget = $budget;
        $this->editExpenseItem = $budget->expense_item;
        $this->editEstimatedAmount = $budget->estimated_amount;
    }

    public function updateBudget(FlasherInterface $flasher)
    {
        $this->validate([
            'editExpenseItem' => 'required|string',
            'editEstimatedAmount' => 'required|numeric',
        ]);

        $this->editingBudget->update([
            'expense_item' => $this->editExpenseItem,
            'estimated_amount' => $this->editEstimatedAmount,
        ]);

        $this->editingBudget = null; // Close the modal
         $this->loadBudgetsForSelectedProject(); // Refresh the table data

        $flasher->addSuccess('Budget updated successfully.');
    }

    public function cancelEdit()
    {
        $this->editingBudget = null;
    }

    public function approveEntireBudget(FlasherInterface $flasher)
    {
        Budget::where('project_plan_id', $this->selectedProjectId)
            ->update(['approved' => true]);

        $this->budgetApproved = true;
        $flasher->addSuccess('Entire budget approved successfully.');
    }

    public function openAddExtraExpenseModal($itemName)
    {
        $this->currentItemName = $itemName;
        $this->showAddExtraExpenseModal = true;
    }

    public function closeAddExtraExpenseModal()
    {
        $this->showAddExtraExpenseModal = false;
        $this->extraExpenseItem = null;
        $this->extraEstimatedAmount = null;
    }

    public function addExtraExpense(FlasherInterface $flasher)
    {
        $this->validate([
            'extraExpenseItem' => 'required|string',
            'extraEstimatedAmount' => 'required|numeric',
        ]);

        $amount = str_replace(',', '', $this->extraEstimatedAmount);
        if (!is_numeric($amount)) {
            $flasher->addError('Invalid amount format.');
            return;
        }

        Budget::create([
            'project_plan_id' => $this->selectedProjectId,
            'project_plan_item_name' => $this->currentItemName,
            'expense_item' => $this->extraExpenseItem,
            'estimated_amount' => $amount,
            'approved' => false,
        ]);

        $this->closeAddExtraExpenseModal();
        $this->loadBudgetsForSelectedProject(); // Refresh the table data
        $flasher->addSuccess('Extra expense added successfully.');
    }

    public function render()
    {
        $projectsPaginator = Projectplan::with('project')->paginate($this->perPage);
        return view('livewire.components.budgets', [
            'projectsPaginator' => $projectsPaginator
        ]);
    }
}