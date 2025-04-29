<?php

namespace App\Livewire\Components;

use App\Models\Project;
use Livewire\Component;
use App\Models\Contract;
use App\Models\Staff; 
use App\Models\ContractType;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Flasher\Prime\FlasherInterface;

class AddContracts extends Component
{
    use WithFileUploads;

    public $project_id;
    public $contractor_id;
    public $start_date;
    public $end_date;
    public $contract_type_id;
    public $total_amount;
    public $description;
    public $payment_schedule;
    public $attachments = [];

    public $contractTypes = [];
    public $showContractTypeForm = false;
    public $new_contract_type;

    protected $rules = [
        'project_id' => 'required|exists:projects,id',
        'contractor_id' => 'required|exists:staff,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'contract_type_id' => 'required|exists:contract_types,id',
        'total_amount' => 'required|numeric|min:0',
        'description' => 'nullable|string|min:10',
        'payment_schedule' => 'nullable|string|max:255',
        'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,png|max:10240',
    ];

    public function mount()
    {
        $this->contractTypes = ContractType::all();
    }

    public function showAddContractTypeForm()
    {
        $this->showContractTypeForm = true;
    }

    public function hideAddContractTypeForm()
    {
        $this->showContractTypeForm = false;
        $this->new_contract_type = '';
    }

    public function removeAttachment($key)
    {
        unset($this->attachments[$key]);
    }

    public function addContractType(FlasherInterface $flasher)
    {
        $this->validate([
            'new_contract_type' => 'required|string|unique:contract_types,name',
        ]);

        $contractType = ContractType::create([
            'name' => $this->new_contract_type,
        ]);

        $this->contractTypes[] = $contractType;
        $this->contract_type_id = $contractType->id;
        $this->hideAddContractTypeForm();

        flash()->addSuccess('Contract type added successfully.');
    }

    public function save()
    {
        $this->validate();

        // Create the contract
        $contract = Contract::create([
            'project_id' => $this->project_id,
            'contractor_id' => $this->contractor_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'contract_type_id' => $this->contract_type_id,
            'total_amount' => $this->total_amount,
            'contract_status' => 'pending',
            'description' => strip_tags($this->description),
            'payment_schedule' => $this->payment_schedule,
        ]);

        // Handle file uploads
        if ($this->attachments) {
            foreach ($this->attachments as $attachment) {
                $path = $attachment->store('contracts/documents', 'public');
                
                // $contract->documents()->create([
                //     'file_path' => $path,
                //     'file_name' => $attachment->getClientOriginalName(),
                //     'file_type' => $attachment->getClientMimeType(),
                //     'file_size' => $attachment->getSize(),
                // ]);
            }
        }

        flash()->addSuccess('Contract created successfully.');
        return redirect()->route('contracts');
    }

    public function render()
    {
        return view('livewire.components.add-contracts', [
            'projects' => Project::all(),
            'contractors' => Staff::where('position', 'contractor')->with('user')->get(),
        ]);
    }
}