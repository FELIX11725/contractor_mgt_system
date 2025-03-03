<?php

namespace App\Livewire\Components;

use App\Models\Phase;
use App\Models\Project;
use Livewire\Component;
use App\Models\Projectplan;
use App\Models\Projectmilestone;
use Flasher\Prime\FlasherInterface;

class Viewplans extends Component
{
    public $projectPlans;
    public $selectedId; // To store the ID of the selected milestone/phase
    public $selectedType; // To store whether it's a milestone or phase
    public $newStatus; // To store the new status to be updated
    public $currentStatus; // To store the current status of the selected milestone/phase

    // Fetch project plans with milestones and phases
    public function render()
    {
       
        $this->projectPlans = Projectplan::with(['milestones', 'phases'])->get();
        return view('livewire.components.viewplans', [
            'projectPlans' => $this->projectPlans,
            
        ]);
    }

    // Open the modal and set the selected ID, type, and current status
    public function openUpdateStatusModal($id, $type)
    {
        $this->selectedId = $id;
        $this->selectedType = $type;

        // Get the current status
        if ($type === 'milestone') {
            $milestone = Projectmilestone::find($id);
            $this->newStatus = $milestone->milestone_status; // Pre-fill the select with the current status
        } else {
            $phase = Phase::find($id);
            $this->newStatus = $phase->phase_status; // Pre-fill the select with the current status
        }


        $this->dispatch('open-modal');
    }

    // Update the status of the selected milestone or phase
    public function updateStatus(FlasherInterface $flasher)
    {

         if ($this->selectedType === 'milestone') {
            $milestone = Projectmilestone::find($this->selectedId);
            if ($milestone) {
                $newStatus = match ($milestone->milestone_status) {
                    'pending' => 'active',
                    'active' => 'completed',
                    'completed' => 'pending',
                    default => 'pending', // Handle unexpected status values
                };

                $milestone->update(['milestone_status' => $newStatus]);
                 $this->newStatus = $newStatus; // Update the Livewire property 
            }
        } elseif ($this->selectedType === 'phase') {
            $phase = Phase::find($this->selectedId);
            if ($phase) {
                 $newStatus = match ($phase->phase_status) {
                    'pending' => 'active',
                    'active' => 'completed',
                    'completed' => 'pending',
                    default => 'pending', // Handle unexpected status values
                };
                $phase->update(['phase_status' =>  $newStatus]);
                $this->newStatus = $newStatus; // Update the Livewire property

            }
        }
        // Close the modal and update the status in the database

        $this->dispatch('close-modal');
        $flasher->addSuccess('Status updated successfully');
        


    }
}