<?php

namespace App\Livewire\Components;

use App\Models\Phase;
use App\Models\Project;
use Livewire\Component;
use App\Models\Milestone;
use App\Models\ProjectPlan;
use App\Models\Projectmilestone;
use Flasher\Prime\FlasherInterface;

class Projectplans extends Component
{
    public $projects;
    public $selectedProject;
    public $planMethod = '';
    public $numberOfItems;
    public $itemNames = [];




    public function mount()
    {
        $this->projects = Project::all();
    }

    public function updatedSelectedProject($value)
    {
        // Reset other fields when project changes
        $this->reset(['planMethod', 'numberOfItems', 'itemNames']);
    }
    

    public function updatedPlanMethod($value)
    {

        // Reset number of items and item names when plan method changes
        $this->reset(['numberOfItems', 'itemNames']);
    }

    public function submit(FlasherInterface $flasher)
    {
        // Validate the form data
        $this->validate([
            'selectedProject' => 'required|exists:projects,id',
            'planMethod' => 'required|in:milestones,phases',
            'numberOfItems' => 'required|integer|min:1',
            'itemNames' => 'required|array|size:' . $this->numberOfItems,
            'itemNames.*' => 'required|string|max:255',
        ]);
    
        // Create the project plan
        $projectPlan = Projectplan::create([
            'project_id' => $this->selectedProject,
            'plan_method' => $this->planMethod,
        ]);
    
        // Create milestones or phases based on the plan method
        if ($this->planMethod === 'milestones') {
            foreach ($this->itemNames as $name) {
                Projectmilestone::create([
                    'project_plan_id' => $projectPlan->id,
                    'name' => $name,
                    'milestone_status' => 'pending',
                ]);
            }
        } elseif ($this->planMethod === 'phases') {
            foreach ($this->itemNames as $name) {
                Phase::create([
                    'project_plan_id' => $projectPlan->id,
                    'name' => $name,
                    'phase_status' => 'pending',
                ]);
            }
        }
    
        // Update project status instead of creating a new record
        Project::where('id', $this->selectedProject)->update([
            'project_status' => 'active',
        ]);
    
        // Reset the form
        $this->reset(['selectedProject', 'planMethod', 'numberOfItems', 'itemNames']);
    
        // Show success message
        flash()->addSuccess('Project plan created successfully!');
        //redirect to viewplans
        return redirect()->route('viewplans');
    }
    


    public function render()
    {
        return view('livewire.components.projectplans', [
            'projects' => $this->projects,
        ]);
    }
}