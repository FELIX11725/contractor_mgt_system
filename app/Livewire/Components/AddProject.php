<?php

namespace App\Livewire\Components;

use App\Models\Project;
use Livewire\Component;
use App\Models\Auditlog;
use App\Models\Milestone;
use App\Models\ProjectType;
use Flasher\Prime\FlasherInterface;

class AddProject extends Component
{
    public $project_name;
    public $location;
    public $project_type_id;
    public $project_description = ''; 
    public $start_date;
    public $end_date;
    public $showModal = false;
    public $new_project_type;
    public $projectTypes;

    public function mount()
    {
        $this->projectTypes = ProjectType::all();
    }

    public function render()
    {
        return view('livewire.components.add-project');
    }

    public function save(FlasherInterface $flasher)
    {
        // Validate the input
        $this->validate([
            'project_name' => 'required',
            'location' => 'nullable',
            'project_type_id' => 'required|exists:project_types,id',
            'project_description' => 'required|string|min:10', 
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
    
        // Create the project
        $project = Project::create([
            'project_name' => $this->project_name,
            'location' => $this->location,
            'project_type_id' => $this->project_type_id,
            'project_description' => strip_tags($this->project_description),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'project_status' => 'pending',
        ]);
    
        // Create default milestones
        Milestone::create([
            'project_id' => $project->id,
            'milestone_name' => 'Start Project',
            'due_date' => $this->start_date,
            'description' => 'Initial phase of the project',
            'milestone_status' => 'pending',
        ]);
    
        Milestone::create([
            'project_id' => $project->id,
            'milestone_name' => 'End Project',
            'due_date' => $this->end_date,
            'description' => 'Final phase of the project',
            'milestone_status' => 'pending',
        ]);
        // Log the action
        Auditlog::create([
            'user_id' => auth()->id(),
            'action' => 'Created a new project',
            'description' => 'Project: '.$this->project_name,
            'ip_address' => request()->ip(),
        ])->save();
    
        // Flash success message
        flash()->addSuccess('Project created successfully with default milestones!');
    
        // Reset the form
        $this->reset([
            'project_name',
            'location',
            'project_type_id',
            'project_description',
            'start_date',
            'end_date',
        ]);
    
        // Redirect to the projects page
        return redirect()->route('projects');
    }
    

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset('new_project_type');
    }

    public function addProjectType(FlasherInterface $flasher)
    {
        $this->validate([
            'new_project_type' => 'required|unique:project_types,name',
        ]);

        $projectType = ProjectType::create([
            'name' => $this->new_project_type,
        ]);

        $this->projectTypes = ProjectType::all(); 
        $this->project_type_id = $projectType->id; 
        $this->closeModal();
        flash()->addSuccess('Project type added successfully!');
    }
}