<?php

namespace App\Livewire\Components;

use App\Models\User;
use App\Models\staff;
use Livewire\Component;
use App\Models\Contractor;
use Illuminate\Support\Str;
use App\Mail\WelcomeNewUser;
use Livewire\WithPagination;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Contractors extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedStaff = [];
    public $selectAll = false;
    public $perPage = 10;
    public $action = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'contractor_email' => 'required|email|max:255',
        'contractor_phone' => 'required|numeric',
        'contractor_address' => 'required|string|max:255',
    ];

    public function render()
    {
        $staff = staff::with(['user'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%')
                      ->orWhere('position', 'like', '%' . $this->search . '%');
                });
            })->get();
            // ->orderBy('created_at', 'desc')
            // ->paginate($this->perPage);

        return view('livewire.components.contractors', compact('staff'));
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedStaff = $this->staff->pluck('id')->map(fn($id) => (string)$id)->toArray();
        } else {
            $this->selectedStaff = [];
        }
    }

    public function performAction(FlasherInterface $flasher)
    {
        if ($this->action === 'deleteSelectedStaff' && !empty($this->selectedStaff)) {
            $this->deleteSelected();
            
        }
    }

    public function deleteSelected()
    {
        Staff::whereIn('id', $this->selectedStaff)->delete();
        $this->selectedStaff = [];
        flash()->addSuccess('Selected staff members deleted successfully!');
    }

    public function deselectAll()
    {
        $this->selectedStaff = [];
        $this->selectAll = false;
    }

    public function activate($staffId)
    {
        $staff = Staff::findOrFail($staffId);

        //check if the staff member already has a user account
    
        $password = Str::random(12);
        $user = User::withTrashed()->firstOrCreate([
            'email' => $staff->email,
        ],[
            'name' => $staff->first_name . ' ' . $staff->last_name,
            'password' => Hash::make($password),
            'business_id' =>auth()->user()->business_id,
            'branch_id' => auth()->user()->branch_id,
            'staff_id' => $staff->id,
            'deleted_at' => null,
        ]);

        if ($user->wasRecentlyCreated) {
            // Assign the user to the staff member
            $staff->update([
                'user_id' => $user->id,
            ]);
            Mail::to($staff->email)->send(new WelcomeNewUser($user, $password));
            flash()->addSuccess('User account created successfully!');   
        } else {
            $user->restore();
            flash()->addSuccess('User account reactivated');
            return;
        }

       

        // Here you would typically send a welcome email with the password
    }

    public function deactivate($staffId)
    {
        $staff = Staff::findOrFail($staffId);
        
        if ($staff) {
            $staff->user->delete();
        flash()->addSuccess('Staff deactivated successfully!');

        } else {
            flash()->addError('Staff member does not have an associated user account.');
        }

    }

    public function openStaffProfile($staffId)
    {
        return redirect()->route('contractors.profile', $staffId);
    }  
    
    
}