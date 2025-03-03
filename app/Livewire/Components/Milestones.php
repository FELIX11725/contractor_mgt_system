<?php

namespace App\Livewire\Components;

use App\Models\Project;
use Livewire\Component;
use App\Models\Milestone;
use Livewire\WithPagination;
use Flasher\Prime\FlasherInterface;

class Milestones extends Component
{
    use WithPagination;

    public $showModal = false;
    public $modalType = null; 
    public $showStatusModal = false;
    public $milestoneIdToEdit;
    public $milestoneIdToUpdateStatus;
    public $milestoneIdToView;
    public $milestone_name;
    public $project_id;
    public $due_date;
    public $description;
    public $updatedStatus;
    public $searchQuery = '';
    public $selectedMilestones = []; 
public $selectAll = false;

    public function render()
    {
        $milestones = Milestone::with('project')
            ->when($this->searchQuery, function ($query) {
                $query->where('milestone_name', 'like', '%' . $this->searchQuery . '%')
                      ->orWhereHas('project', function ($q) {
                          $q->where('project_name', 'like', '%' . $this->searchQuery . '%');
                      });
            })
            ->paginate(10);
    
        $projects = Project::all();
        return view('livewire.components.milestones', compact('milestones', 'projects'));
    }
    public function updatedSelectAll($value)
{
    if ($value) {
        $this->selectedMilestones = Milestone::pluck('id')->toArray();
    } else {
        $this->selectedMilestones = [];
    }
}

    
    public function openModal($type, $milestoneId = null)
{
    $this->modalType = $type;
    $this->resetInputFields();

    if ($type === 'edit' && $milestoneId) {
        $this->openEditModal($milestoneId);
    } elseif ($type === 'view' && $milestoneId) {
        $this->openViewModal($milestoneId);
    }

    $this->showModal = true;
}
    public function openViewModal($milestoneId)
{
    $milestone = Milestone::findOrFail($milestoneId);
    $this->milestoneIdToView = $milestoneId;
    $this->milestone_name = $milestone->milestone_name;
    $this->project_id = $milestone->project_id;
    $this->due_date = $milestone->due_date;
    $this->description = $milestone->description;
    $this->modalType = 'view';
    $this->showModal = true;
}

    public function save(FlasherInterface $flasher)
    {
        $this->validate([
            'milestone_name' => 'required',
            'project_id' => 'required|exists:projects,id',
            'due_date' => 'required|date',
            'description' => 'required|string|min:10',
        ]);

        Milestone::create([
            'milestone_name' => $this->milestone_name,
            'project_id' => $this->project_id,
            'due_date' => $this->due_date,
            'description' => $this->description,
            'milestone_status' => 'pending',
        ]);

        $this->resetInputFields();
        $this->showModal = false;
        $flasher->addSuccess('Milestone created successfully!');
    }

    public function openEditModal($milestoneId)
    {
        $this->resetInputFields();
        
        $milestone = Milestone::findorFail($milestoneId);
        $this->milestoneIdToEdit = $milestone->id;  
        $this->milestone_name = $milestone->milestone_name;
        $this->project_id = $milestone->project_id;
        $this->due_date = $milestone->due_date;
        $this->description = $milestone->description;
        $this->modalType = 'edit';
        $this->showModal = true;
    }

    public function update(FlasherInterface $flasher)
    {
        $this->validate([
            'milestone_name' => 'required',
            'project_id' => 'required|exists:projects,id',
            'due_date' => 'required|date',
            'description' => 'required',
        ]);
        $milestone = Milestone::findOrFail($this->milestoneIdToEdit);
        $milestone->update([
            'milestone_name' => $this->milestone_name,
            'project_id' => $this->project_id,
            'due_date' => $this->due_date,
            'description' => $this->description,
        ]);
        $this->resetInputFields();
        $this->showModal = false;
        $flasher->addSuccess('Milestone updated successfully!');
    }

    public function openStatusModal($milestoneId)
    {
        $this->milestoneIdToUpdateStatus = $milestoneId;
        $milestone = Milestone::find($milestoneId);
        if ($milestone) {
            $this->updatedStatus = $milestone->milestone_status;
            $this->showStatusModal = true;
        }
    }

    public function updateStatus(FlasherInterface $flasher)
    {
        $this->validate([
            'updatedStatus' => 'required|in:pending,overdue,completed',
        ]);

        $milestone = Milestone::findOrFail($this->milestoneIdToUpdateStatus);
        $milestone->update([
            'milestone_status' => $this->updatedStatus,
        ]);

        $this->showStatusModal = false;
        $flasher->addSuccess('Milestone status updated successfully!');
    }

    public function delete($milestoneId, FlasherInterface $flasher)
    {
        Milestone::destroy($milestoneId);
        $flasher->addSuccess('Milestone deleted successfully!');
    }

    private function resetInputFields()
    {
        $this->milestone_name = '';
        $this->project_id = ''; 
        $this->due_date = '';
        $this->description = '';
        $this->updatedStatus = '';
        $this->milestoneIdToEdit = null;
        $this->milestoneIdToUpdateStatus = null;
        $this->modalType = null;
    }
}