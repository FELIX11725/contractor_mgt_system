<?php

namespace App\Livewire\Components;

use App\Models\Project;
use Livewire\Component;
use App\Models\Milestone;
use Flasher\Prime\FlasherInterface;

class AddMilestone extends Component
{
    public $milestone_name;
    public $project_id;
    public $due_date;
    public $description;
    
    public function render()
    {
        $milestones = Milestone::with('project')->paginate(10);
        $projects = Project::all();
        return view('livewire.components.add-milestone',compact('milestones', 'projects'));
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
            'description' => strip_tags($this->description),
            'milestone_status' => 'pending', 
        ]);

        flash()->addSuccess('Milestone created successfully!');

        return $this->redirect(route('milestones'));
    }

}
