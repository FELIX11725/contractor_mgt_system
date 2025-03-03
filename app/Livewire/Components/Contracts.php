<?php

namespace App\Livewire\Components;

use App\Models\Project;
use Livewire\Component;
use App\Models\Contract;
use App\Models\Contractor;
use App\Models\ContractType;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Flasher\Prime\FlasherInterface;

class Contracts extends Component
{
    use WithPagination;

public $contractIdToView;
public $description;
    public $contractor_id;
    public $total_amount;
    public $contract_type_id;
    public $project_id;
    public $start_date;
    public $end_date;
    public $contract_status;
    public $showModal = false;
    public $modalType = null; 
    public $showStatusModal = false;
    public $showContractTypeModal = false;

    public $contractIdToEdit;
    public $contractIdToUpdateStatus;
    public $searchQuery = '';
    public $selectedContracts = [];
    public $selectAll = false;
    public $new_contract_type;

    public $updatedStatus;

    public function render()
    {
        // Fetch contracts with search and pagination
        $contracts = Contract::with('project', 'contractor')
            ->when($this->searchQuery, function ($query) {
                $query->whereHas('project', function ($q) {
                    $q->where('project_name', 'like', '%' . $this->searchQuery . '%');
                })->orWhereHas('contractor', function ($q) {
                    $q->where('first_name', 'like', '%' . $this->searchQuery . '%')
                      ->orWhere('last_name', 'like', '%' . $this->searchQuery . '%');
                });
            })
            ->paginate(10);

        // Fetch related data
        $projects = Project::all();
        $contractors = Contractor::all();
        $contractTypes = ContractType::all();

        return view('livewire.components.contracts', compact('contracts', 'projects', 'contractors', 'contractTypes'));
    }

    // Open modal for add/edit/view
    public function openModal($type, $contractId = null)
    {
        $this->modalType = $type;
        $this->resetInputFields();

        if ($type === 'edit' && $contractId) {
            $this->openEditModal($contractId);
        } elseif ($type === 'view' && $contractId) {
            $this->openViewModal($contractId);
        }

        $this->showModal = true;
    }
    public function generatePdf($contractId)
{
    // Fetch the contract data
    $contract = Contract::findOrFail($contractId);

    // Load the view and pass data to it
    $pdf = Pdf::loadView('livewire.components.template', compact('contract'));

    // Download the PDF
    return response()->streamDownload(function () use ($pdf) {
        echo $pdf->stream();
    }, 'contract-agreement.pdf');
}

    // Open modal in "edit" mode
    public function openEditModal($contractId)
    {
        $contract = Contract::findOrFail($contractId);
        $this->contractIdToEdit = $contractId;
        $this->contractor_id = $contract->contractor_id;
        $this->project_id = $contract->project_id;
        $this->start_date = $contract->start_date;
        $this->end_date = $contract->end_date;
        $this->total_amount = $contract->total_amount;
        $this->contract_type_id = $contract->contract_type_id;
        $this->description = $contract->description;
        $this->modalType = 'edit';
        $this->showModal = true;
    }

    // Open modal in "view" mode
    public function openViewModal($contractId)
    {
        $contract = Contract::findOrFail($contractId);
        $this->contractIdToView = $contractId;
        $this->contractor_id = $contract->contractor_id;
        $this->project_id = $contract->project_id;
        $this->start_date = $contract->start_date;
        $this->end_date = $contract->end_date;
        $this->total_amount = $contract->total_amount;
        $this->contract_type_id = $contract->contract_type_id;
        $this->description = $contract->description;
        $this->modalType = 'view';
        $this->showModal = true;
    }

    // Save or update contract
    public function save(FlasherInterface $flasher)
    {
        $this->validate([
            'contractor_id' => 'required|exists:contractors,id',
            'project_id' => 'required|exists:projects,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'total_amount' => 'required|numeric',
            'contract_type_id' => 'required|exists:contract_types,id',
            'description' => 'nullable|string|min:10',
        ]);

        if ($this->modalType === 'edit' && $this->contractIdToEdit) {
            // Update existing contract
            $contract = Contract::findOrFail($this->contractIdToEdit);
            $contract->update([
                'contractor_id' => $this->contractor_id,
                'project_id' => $this->project_id,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'total_amount' => $this->total_amount,
                'contract_type_id' => $this->contract_type_id,
                'description' => $this->description,
            ]);
            $flasher->addSuccess('Contract updated successfully!');
        } else {
            // Create new contract
            Contract::create([
                'contractor_id' => $this->contractor_id,
                'project_id' => $this->project_id,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'total_amount' => $this->total_amount,
                'contract_type_id' => $this->contract_type_id,
                'contract_status' => 'active',
                'description' => $this->description,
            ]);
            $flasher->addSuccess('Contract created successfully!');
        }

        $this->resetInputFields();
        $this->showModal = false;
    }

    // Open modal for adding a new contract type
    public function openContractTypeModal()
    {
        $this->showContractTypeModal = true;
    }

    // Add a new contract type
    public function addContractType(FlasherInterface $flasher)
    {
        $this->validate([
            'new_contract_type' => 'required|string|max:255|unique:contract_types,name',
        ]);

        $contractType = ContractType::create([
            'name' => $this->new_contract_type,
        ]);

        $this->contractTypes[] = $contractType; 
        $this->contract_type_id = $contractType->id;
        $this->showContractTypeModal = false;
        $this->new_contract_type = ''; 
        $flasher->addSuccess('Contract type added successfully!');
    }

    // Open status update modal
    public function openStatusModal($contractId)
    {
        $this->contractIdToUpdateStatus = $contractId;
        $contract = Contract::find($contractId);
        if ($contract) {
            $this->updatedStatus = $contract->contract_status;
            $this->showStatusModal = true;
        }
    }

    // Update contract status
    public function updateStatus(FlasherInterface $flasher)
    {
        $this->validate([
            'updatedStatus' => 'required|in:pending,active,completed',
        ]);

        $contract = Contract::findOrFail($this->contractIdToUpdateStatus);
        $contract->update([
            'contract_status' => $this->updatedStatus,
        ]);

        $this->showStatusModal = false;
        $flasher->addSuccess('Contract status updated successfully!');
    }

    // Delete a contract
    public function delete($contractId, FlasherInterface $flasher)
    {
        Contract::destroy($contractId);
        $flasher->addSuccess('Contract deleted successfully!');
    }

    // Handle select all functionality
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedContracts = Contract::pluck('id')->toArray();
        } else {
            $this->selectedContracts = [];
        }
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->contractor_id = '';
        $this->project_id = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->total_amount = '';
        $this->contract_type_id = '';
        $this->updatedStatus = '';
        $this->contractIdToEdit = null;
        $this->contractIdToUpdateStatus = null;
        $this->modalType = null;
    }
}