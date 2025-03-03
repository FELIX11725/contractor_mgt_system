<?php

namespace App\Livewire\Components;

use App\Models\Project;
use App\Models\ProjectType;
use Livewire\Component;
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
        Project::create([
            'project_name' => $this->project_name,
            'location' => $this->location,
            'project_type_id' => $this->project_type_id,
            'project_description' => strip_tags($this->project_description),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'project_status' => 'pending',
        ]);
    
        // Flash success message
        $flasher->addSuccess('Project created successfully!');
    
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
        $flasher->addSuccess('Project type added successfully!');
    }
}