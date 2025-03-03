<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Contractor;
use Flasher\Prime\FlasherInterface;

class AddContractor extends Component
{
    public $first_name;
    public $last_name;
    public $contractor_email;
    public $contractor_phone;
    public $contractor_address;
    public $date_of_birth;
    public $gender;
    public $nationality;
    public $marital_status;
    public $education_level;
    public $work_experience;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'contractor_email' => 'required|email|unique:contractors,contractor_email',
        'contractor_phone' => 'required|string|max:15',
        'contractor_address' => 'required|string|max:255',
        'date_of_birth' => 'nullable|date',
        'gender' => 'nullable|string|in:male,female,other',
        'nationality' => 'nullable|string|max:255',
        'marital_status' => 'nullable|string|in:single,married,divorced,widowed',
        'education_level' => 'nullable|string|max:255',
        'work_experience' => 'nullable|integer|min:0',
    ];

    public function render()
    {
        return view('livewire.components.add-contractor');
    }

    public function save(FlasherInterface $flasher)
    {
        $this->validate();

        Contractor::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'contractor_email' => $this->contractor_email,
            'contractor_phone' => $this->contractor_phone,
            'contractor_address' => $this->contractor_address,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'nationality' => $this->nationality,
            'marital_status' => $this->marital_status,
            'education_level' => $this->education_level,
            'work_experience' => $this->work_experience,
        ]);

        $this->reset();

        // redirect to contractors page
        return redirect()->route('contractors');
        $flasher->addSuccess('Contractor added successfully.');
    }
}