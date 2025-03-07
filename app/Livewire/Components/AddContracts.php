<?php

namespace App\Livewire\Components;

use App\Models\Project;
use Livewire\Component;
use App\Models\Contract;
use App\Models\Contractor;
use App\Models\ContractType;
use Barryvdh\DomPDF\Facade\Pdf;
use Flasher\Prime\FlasherInterface;

class AddContracts extends Component
{
    public $project_id;
    public $contractor_id;
    public $start_date;
    public $end_date;
    public $contract_type_id;
    public $total_amount;
    public $description;

    public $contractTypes = [];
    public $showContractTypeForm = false;
    public $new_contract_type;

    protected $rules = [
        'project_id' => 'required|exists:projects,id',
        'contractor_id' => 'required|exists:contractors,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'contract_type_id' => 'required|exists:contract_types,id',
        'total_amount' => 'required|numeric',
        'description' => 'nullable|string|min:10',
        
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

    public function addContractType(FlasherInterface $flasher)
    {
        $this->validate([
            'new_contract_type' => 'required|string|unique:contract_types,name',
        ]);

        $contractType = ContractType::create([
            'name' => $this->new_contract_type,
        ]);

        $this->contractTypes[] = $contractType;
        // $this->contractTypes = collect($this->contractTypes)->push($contractType)->all();
        $this->contract_type_id = $contractType->id;
        $this->hideAddContractTypeForm();

        $flasher->addSuccess('Contract type added successfully.');
    }

    public function save(FlasherInterface $flasher)
    {
        
        $this->validate();

        $contract = Contract::create([
            'project_id' => $this->project_id,
            'contractor_id' => $this->contractor_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'contract_type_id' => $this->contract_type_id,
            'total_amount' => $this->total_amount,
            'contract_status' => 'pending', // Default status
            'description' => strip_tags($this->description),
           
        ]);
        // $this->generatePdf($contract);
        $flasher->addSuccess('Contract created successfully.');

        return redirect()->route('contracts');
      


       
        
    }

   

    public function render()
    {
        return view('livewire.components.add-contracts', [
            'projects' => Project::all(),
            'contractors' => Contractor::all(),
        ]);
    }
}