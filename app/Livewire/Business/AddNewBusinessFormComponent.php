<?php

namespace App\Livewire\Business;

use App\Models\User;
use App\Models\staff;
use App\Models\branch;
use Livewire\Component;
use App\Models\business;
use Illuminate\Support\Str;
use App\Mail\StaffWelcomeEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AddNewBusinessFormComponent extends Component
{
    public $business_name;
    public $business_email;
    public $business_phone;
    public $business_address;
    public $business_location;
    public $staff_name;
    public $staff_email;
    public $staff_phone;
    public $staff_position;

    protected $rules = [
        'business_name' => 'required|string|max:255',
        'business_email' => 'required|email|unique:businesses,business_email',
        'business_phone' => 'nullable|string|max:20',
        'business_address' => 'required|string',
        'business_location' => 'nullable|string',
        
        'staff_name' => 'required|string|max:255',
        'staff_email' => 'required|email|unique:users,email',
        'staff_phone' => 'nullable|string|max:20',
        'staff_position' => 'required|string|max:255',
    ];

    public function createBusiness()
    {
        $this->validate();

        // Start transaction
        DB::transaction(function () {
            // Create the business
            $business = business::create([
                'business_name' => $this->business_name,
                'business_email' => $this->business_email,
                'business_phone' => $this->business_phone,
                'business_address' => $this->business_address,
                'business_location' => $this->business_location,
                'business_status' => 'active',
                'created_by' => Auth::id(),
            ]);

            // Create the default main branch
            $branch = branch::create([
                'business_id' => $business->id,
                'branch_name' => 'Main Branch',
                'branch_code' => 'MAIN-' . strtoupper(substr($business->business_name, 0, 3)) . '-' . $business->id,
                'branch_phone' => $this->business_phone,
                'branch_email' => $this->business_email,
                'branch_address' => $this->business_address,
                'is_main' => true,
            ]);

            // Generate random password
            $password = Str::random(10);

            // Create user account for staff
            $user = User::create([
                'name' => $this->staff_name,
                'email' => $this->staff_email,
                'password' => Hash::make($password),
                'is_admin' => false,
            ]);

            // Create staff record
            staff::create([
                'user_id' => $user->id,
                'business_id' => $business->id,
                'branch_id' => $branch->id,
                'position' => $this->staff_position,
                'phone' => $this->staff_phone,
                'is_primary' => true,
            ]);

            // Send welcome email with password
            Mail::to($user->email)->send(new StaffWelcomeEmail([
                'name' => $user->name,
                'email' => $user->email,
                'password' => $password,
                'business_name' => $business->business_name,
                'login_url' => route('login'),
            ]));
        });

        flash()->addSuccess('Business created successfully with default branch and staff account. Welcome email sent.');

        // Reset form
        $this->reset();
    }
    public function render()
    {
        return view('livewire.business.add-new-business-form-component');
    }
}
