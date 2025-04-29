<?php

namespace App\Livewire\Components;

use App\Models\Role;
use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;
use App\Models\RolesPermission;
use Illuminate\Validation\Rule;




class RoleManager extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Modal properties
    public $showModal = false;
    public $modalTitle = 'Create Role';
    public $editMode = false;

    // Form properties
    #[Rule('required|string|max:255|unique:roles,name')]
    public $name = '';

    public $selectedPermissions = [];
    public $roleId = null;

    public $search = '';
    public $perPage = 10;
    public $confirmingDelete = false;
    public $roleToDelete = null;

    //rules
    protected function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->ignore($this->roleId),
            ],
            'selectedPermissions' => 'array',
        ];
    }
    public function render()
    {
        $roles = Role::with('permissions')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        $permissions = Permission::all()->groupBy(function ($item) {
            return explode('-', $item->name)[0];
        });

        return view('livewire.components.role-manager',[
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function openModal()
    {
        $this->resetForm();
        $this->modalTitle = 'Create Role';
        $this->editMode = false;
        $this->showModal = true;
    }

    public function editRole($roleId)
    {
        $role = Role::with('permissions')->findOrFail($roleId);
        
        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
        
        $this->modalTitle = 'Edit Role: ' . $role->name;
        $this->editMode = true;
        $this->showModal = true;
        flash()->addInfo('Editing role: ' . $role->name);
    }

    public function confirmDelete($roleId)
    {
        $this->roleToDelete = $roleId;
        $this->confirmingDelete = true;
    }

    public function deleteRole()
    {
        $role = Role::findOrFail($this->roleToDelete);
        
        // Prevent deletion of admin role
        if ($role->name === 'admin') {
            flash()->addError( 'Cannot delete admin role!');
            $this->confirmingDelete = false;
            return;
        }

        $role->delete();
        flash()->addSuccess( 'Role deleted successfully!');
        $this->confirmingDelete = false;
    }

    public function saveRole()
    {
        $this->validate();

        if ($this->editMode) {
            $role = Role::findOrFail($this->roleId);
            $this->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('roles', 'name')->ignore($role->id),
                ],
            ]);
            $role->update(['name' => $this->name]);
        } else {
            $role = Role::create([
                'name' => $this->name,
                'business_id' => auth()->user()->business_id,
                'branch_id' => auth()->user()->branch_id,
            ]);
        }

        // Sync permissions
        RolesPermission::where('role_id', $role->id)->delete();
        foreach ($this->selectedPermissions as $permissionId) {
            RolesPermission::create([
                'role_id' => $role->id,
                'permission_id' => $permissionId,
            ]);
        }

        $this->showModal = false;
        $this->resetForm();
        
        flash()->addSuccess( $this->editMode ? 'Role updated successfully!' : 'Role created successfully!');
    }

    public function resetForm()
    {
        $this->reset(['name', 'selectedPermissions', 'editMode', 'roleId']);
        $this->resetErrorBag();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->confirmingDelete = false;
        $this->resetForm();
    }
}
