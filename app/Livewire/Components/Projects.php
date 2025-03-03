<?php

namespace App\Livewire\Components;

use App\Models\Project;
use App\Models\ProjectType;
use Livewire\Component;
use Livewire\WithPagination;
use Flasher\Prime\FlasherInterface;

class Projects extends Component
{
    use WithPagination;
    public $showModal = false;
    public $modalType = null; // 'add', 'edit', 'view'
    public $showProjectTypeModal = false;
    public $projectIdToEdit;
    public $projectIdToView;
    public $project_name;
    public $location;
    public $project_type_id;
    public $project_description = '';
    public $start_date;
    public $end_date;
    public $new_project_type;
    public $searchQuery = '';
    public $projectTypes;

    public function mount()
    {
        // Load project types for the dropdown
        $this->projectTypes = ProjectType::all();
    }

    public function render()
    {
        // Fetch projects with search and pagination
        $projectTypes = ProjectType::all();
        $projects = Project::when($this->searchQuery, function ($query) {
            $query->where('project_name', 'like', '%' . $this->searchQuery . '%')
                  ->orWhere('location', 'like', '%' . $this->searchQuery . '%');
        })->paginate(10);

        return view('livewire.components.projects', compact('projects','projectTypes'));
    }

    // Open modal for adding/editing/viewing projects
    public function openModal($type, $projectId = null)
    {
        $this->modalType = $type;
        $this->resetInputFields();

        if ($type === 'edit' && $projectId) {
            $this->openEditModal($projectId);
        } elseif ($type === 'view' && $projectId) {
            $this->openViewModal($projectId);
        }

        $this->showModal = true;
    }

    // Open modal in "edit" mode
    public function openEditModal($projectId)
    {
        $project = Project::findOrFail($projectId);
        $this->projectIdToEdit = $projectId;
        $this->project_name = $project->project_name;
        $this->location = $project->location;
        $this->project_type_id = $project->project_type_id;
        $this->project_description = $project->project_description;
        $this->start_date = $project->start_date;
        $this->end_date = $project->end_date;
        $this->modalType = 'edit';
    }

    // Open modal in "view" mode
    public function openViewModal($projectId)
    {
        $project = Project::findOrFail($projectId);
        $this->projectIdToView = $projectId;
        $this->project_name = $project->project_name;
        $this->location = $project->location;
        $this->project_type_id = $project->project_type_id;
        $this->project_description = $project->project_description;
        $this->start_date = $project->start_date;
        $this->end_date = $project->end_date;
        $this->modalType = 'view';
    }

    // Save or update project
    public function save(FlasherInterface $flasher)
    {
        $this->validate([
            'project_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'project_type_id' => 'required|exists:project_types,id',
            'project_description' => 'required|string|min:10',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($this->modalType === 'edit' && $this->projectIdToEdit) {
            // Update existing project
            $project = Project::findOrFail($this->projectIdToEdit);
            $project->update([
                'project_name' => $this->project_name,
                'location' => $this->location,
                'project_type_id' => $this->project_type_id,
                'project_description' => $this->project_description,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);
            $flasher->addSuccess('Project updated successfully!');
        } else {
            // Create new project
            Project::create([
                'project_name' => $this->project_name,
                'location' => $this->location,
                'project_type_id' => $this->project_type_id,
                'project_description' => $this->project_description,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'project_status' => 'pending',
            ]);
            $flasher->addSuccess('Project created successfully!');
        }

        $this->resetInputFields();
        $this->showModal = false;
    }

    // Open modal for adding a new project type
    public function openProjectTypeModal()
    {
        $this->showProjectTypeModal = true;
    }

    // Add a new project type
    public function addProjectType(FlasherInterface $flasher)
    {
        $this->validate([
            'new_project_type' => 'required|string|max:255|unique:project_types,name',
        ]);

        $projectType = ProjectType::create([
            'name' => $this->new_project_type,
        ]);

        $this->projectTypes = ProjectType::all(); // Refresh project types
        $this->project_type_id = $projectType->id; // Set the new project type as selected
        $this->showProjectTypeModal = false;
        $this->new_project_type = ''; // Reset input field
        $flasher->addSuccess('Project type added successfully!');
    }

    // Delete a project
    public function delete($projectId, FlasherInterface $flasher)
    {
        $project =Project::findOrFail($projectId);
        if($project->milestones()->exists() || $project->contracts()->exists()){
            $flasher->addError('Cannot delete project with associated milestones or contracts.');
            return;
        }
        Project::destroy($projectId);
        $flasher->addSuccess('Project deleted successfully!');
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->project_name = '';
        $this->location = '';
        $this->project_type_id = '';
        $this->project_description = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->projectIdToEdit = null;
        $this->projectIdToView = null;
    }
}