<?php

namespace App\Livewire\Components;

use App\Models\staff;
use Livewire\Component;
use App\Models\Contractor;
use Flasher\Prime\FlasherInterface;

class AddContractor extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $position;
    public $branch_id;
    public $business_id;
 


    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',       
        'phone' => 'required|string|max:20',
        'position' => 'required|string|max:255',
    ];

    public function render()
    {
        return view('livewire.components.add-contractor');
    }

    public function save()
    {
        //  dd($this->first_name, $this->last_name, $this->email, $this->phone, $this->position);
        $this->validate(); 
        // if ($this->create_user_account) {
        //     $user = User::create([
        //         'name' => $this->first_name . ' ' . $this->last_name,
        //         'email' => $this->email,
        //         'password' => Hash::make(Str::random(12)),
        //     ]);
        // }

        staff::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'position' => $this->position,
            'created_by' => auth()->id(),
            'business_id' => auth()->user()->business_id,
            'branch_id' => auth()->user()->branch_id,
        ]);

        $this->reset();

        flash()->addSuccess('Staff member added successfully.');
        // return redirect()->route('staff.index');
    }
}