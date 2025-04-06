<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Models\UsersRoles;
use App\Models\RolesPermission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User Management Permissions
$this->createPermission('create-users');
$this->createPermission('view-users');
$this->createPermission('edit-users');
$this->createPermission('delete-users');
$this->createPermission('manage-user-roles');

// Role Management Permissions
$this->createPermission('create-roles');
$this->createPermission('view-roles');
$this->createPermission('edit-roles');
$this->createPermission('delete-roles');
$this->createPermission('assign-permissions');

// Contractor Management Permissions
$this->createPermission('create-contractors');
$this->createPermission('view-contractors');
$this->createPermission('edit-contractors');
$this->createPermission('delete-contractors');
$this->createPermission('approve-contractors');
$this->createPermission('manage-contractor-documents');

// Project Management Permissions
$this->createPermission('create-projects');
$this->createPermission('view-projects');
$this->createPermission('edit-projects');
$this->createPermission('delete-projects');
$this->createPermission('assign-contractors');

// Bidding/Tendering Permissions
$this->createPermission('create-bids');
$this->createPermission('view-bids');
$this->createPermission('edit-bids');
$this->createPermission('delete-bids');
$this->createPermission('evaluate-bids');

// Contract Management Permissions
$this->createPermission('create-contracts');
$this->createPermission('view-contracts');
$this->createPermission('edit-contracts');
$this->createPermission('delete-contracts');
$this->createPermission('approve-contracts');

// Work Order Permissions
$this->createPermission('create-work-orders');
$this->createPermission('view-work-orders');
$this->createPermission('edit-work-orders');
$this->createPermission('delete-work-orders');
$this->createPermission('approve-work-orders');

// Payment Management Permissions
$this->createPermission('create-payments');
$this->createPermission('view-payments');
$this->createPermission('edit-payments');
$this->createPermission('delete-payments');
$this->createPermission('approve-payments');

// Reporting Permissions
$this->createPermission('view-reports');
$this->createPermission('generate-reports');
$this->createPermission('export-data');

// System Settings Permissions
$this->createPermission('manage-system-settings');
$this->createPermission('manage-notifications');
$this->createPermission('view-audit-logs');

        // Create admin role and assign all permissions (optional)
        $this->createAdminRoleWithAllPermissions();
    }

    protected function createPermission($name, $description = null)
    {
        Permission::firstOrCreate([
            'name' => $name,
        ]);
    }

    protected function createAdminRoleWithAllPermissions()
    {
        $role = Role::firstOrCreate([
            'name' => 'admin',
            'business_id' => 1,
            'branch_id' => 1,
        ]);

        // Assign all permissions to admin role
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            RolesPermission::firstOrCreate([
                'role_id' => $role->id,
                'permission_id' => $permission->id,
            ]);
        }

        // Assign admin role to admin user
        $user = User::where('email', 'admin@ccms.net')->first();
        if ($user) {
            UsersRoles::firstOrCreate([
                'user_id' => $user->id,
                'role_id' => $role->id,
            ]);
        }
    }
}