<?php

namespace App\Livewire\Components;

use App\Models\User;
use App\Models\Staff;
use Livewire\Component;
use App\Models\Contractor;
use Illuminate\Support\Str;
use App\Mail\WelcomeNewUser;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AddContractor extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $position;
    public $contractor_address;
    public $date_of_birth;
    public $gender;
    public $nationality;
    public $marital_status;
    public $education_level;
    public $work_experience;
    public $create_user_account = true;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|max:20',
        'position' => 'required|string|max:255',
        // Contractor specific fields
        'contractor_address' => 'nullable|string|max:255',
        'date_of_birth' => 'nullable|date',
        'gender' => 'nullable|string|max:50',
        'nationality' => 'nullable|string|max:100',
        'marital_status' => 'nullable|string|max:50',
        'education_level' => 'nullable|string|max:100',
        'work_experience' => 'nullable|string',
    ];

    public function render()
    {
        return view('livewire.components.add-contractor');
    }

    public function save()
    {
        $this->validate();

        // Create user account if needed
        $user = null;
        if ($this->create_user_account) {
            $password = Str::random(12); // Generate a random password
            $user = User::create([
                'name' => $this->first_name . ' ' . $this->last_name,
                'email' => $this->email,
                'password' => Hash::make($password),
                'branch_id' => auth()->user()->branch_id,
                'business_id' => auth()->user()->business_id,
                'staff_id' => null, // Set to null for now
            ]);
        }

        // Create staff record
        $staff = Staff::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'position' => $this->position,
            'created_by' => auth()->id(),
            'business_id' => auth()->user()->business_id,
            'branch_id' => auth()->user()->branch_id,
        ]);

        // If position is contractor, create contractor record
        if (strtolower($this->position) === 'contractor') {
            Contractor::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'contractor_email' => $this->email,
                'contractor_phone' => $this->phone,
                'contractor_address' => $this->contractor_address,
                'date_of_birth' => $this->date_of_birth,
                'gender' => $this->gender,
                'nationality' => $this->nationality,
                'marital_status' => $this->marital_status,
                'education_level' => $this->education_level,
                'work_experience' => $this->work_experience,
                'staff_id' => $staff->id, // Link to staff record
                'business_id' => auth()->user()->business_id,
                'branch_id' => auth()->user()->branch_id,
            ]);
        }
        // If user account was created, link it to the staff record
        if ($user) {
            $user->update(['staff_id' => $staff->id]);
        }
        // If the user account was created, send an email with the password
        if ($this->create_user_account) {
            Mail::to($this->email)->send(new WelcomeNewUser($user, $password));
        }

        $this->reset();

        flash()->addSuccess('Staff member added successfully.');
        return redirect()->route('contractors');
    }
}