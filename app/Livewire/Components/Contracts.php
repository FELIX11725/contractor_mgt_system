<?php

namespace App\Livewire\Components;

use App\Models\Project;
use Livewire\Component;
use App\Models\Contract;
use App\Models\Staff; // Changed from Contractor to Staff
use App\Models\ContractType;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Flasher\Prime\FlasherInterface;

class Contracts extends Component
{
    use WithPagination, WithFileUploads;

    public $contractIdToView;
    public $description;
    public $contractor_id;
    public $total_amount;
    public $contract_type_id;
    public $project_id;
    public $start_date;
    public $end_date;
    public $showconfirmDelete =false;
    public $contract_status;
    public $payment_schedule;
    public $attachments = [];
    public $showModal = false;
    public $modalType = null; 
    public $showStatusModal = false;
    public $showContractTypeModal = false;
    public $showDocumentModal = false;

    public $contractIdToEdit;
    public $contractIdToUpdateStatus;
    public $searchQuery = '';
    public $selectedContracts = [];
    public $selectAll = false;
    public $new_contract_type;
    public $updatedStatus;
    public $contractDocuments = [];

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

    public function render()
    {
        $contracts = Contract::with(['project', 'contractor.user'])
            ->when($this->searchQuery, function ($query) {
                $query->whereHas('project', function ($q) {
                    $q->where('project_name', 'like', '%' . $this->searchQuery . '%');
                })->orWhereHas('contractor.user', function ($q) {
                    $q->where('name', 'like', '%' . $this->searchQuery . '%');
                });
            })
            ->paginate(10);

        $projects = Project::all();
        $contractors = Staff::where('position', 'contractor')->with('user')->get();
        $contractTypes = ContractType::all();

        return view('livewire.components.contracts', compact('contracts', 'projects', 'contractors', 'contractTypes'));
    }

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

    public function openEditModal($contractId)
    {
        $contract = Contract::with(['contractType'])->findOrFail($contractId);
        $this->contractIdToEdit = $contractId;
        $this->contractor_id = $contract->contractor_id;
        $this->project_id = $contract->project_id;
        $this->start_date = $contract->start_date;
        $this->end_date = $contract->end_date;
        $this->total_amount = $contract->total_amount;
        $this->contract_type_id = $contract->contract_type_id;
        $this->description = $contract->description;
        $this->payment_schedule = $contract->payment_schedule;
        $this->contract_status = $contract->contract_status;
        $this->modalType = 'edit';
        $this->showModal = true;
    }

    public function openViewModal($contractId)
    {
        $contract = Contract::with(['project', 'contractor.user', 'contractType'])->findOrFail($contractId);
        $this->contractIdToView = $contractId;
        $this->contractor_id = $contract->contractor_id;
        $this->project_id = $contract->project_id;
        $this->start_date = $contract->start_date;
        $this->end_date = $contract->end_date;
        $this->total_amount = $contract->total_amount;
        $this->contract_type_id = $contract->contract_type_id;
        $this->description = $contract->description;
        $this->payment_schedule = $contract->payment_schedule;
        $this->contract_status = $contract->contract_status;
        // $this->contractDocuments = $contract->documents;
        $this->modalType = 'view';
        $this->showModal = true;
    }

    public function save(FlasherInterface $flasher)
    {
        $this->validate();

        $contractData = [
            'project_id' => $this->project_id,
            'contractor_id' => $this->contractor_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'contract_type_id' => $this->contract_type_id,
            'total_amount' => $this->total_amount,
            'description' => strip_tags($this->description),
            'payment_schedule' => $this->payment_schedule,
            'contract_status' => $this->contract_status ?? 'pending',
        ];

        if ($this->modalType === 'edit' && $this->contractIdToEdit) {
            $contract = Contract::findOrFail($this->contractIdToEdit);
            $contract->update($contractData);
            $message = 'Contract updated successfully!';
        } else {
            $contract = Contract::create($contractData);
            $message = 'Contract created successfully!';
        }

        // Handle file uploads
        if ($this->attachments) {
            foreach ($this->attachments as $attachment) {
                $path = $attachment->store('contracts/documents', 'public');
                
                $contract->documents()->create([
                    'file_path' => $path,
                    'file_name' => $attachment->getClientOriginalName(),
                    'file_type' => $attachment->getClientMimeType(),
                    'file_size' => $attachment->getSize(),
                ]);
            }
        }

        flash()->addSuccess($message);
        $this->resetInputFields();
        $this->showModal = false;
    }

    public function generatePdf($contractId)
    {
        $contract = Contract::with(['project', 'contractor.user', 'contractType'])->findOrFail($contractId);
        $pdf = Pdf::loadView('livewire.components.template', compact('contract'));

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'contract-agreement-'.$contractId.'.pdf');
    }

    // public function downloadDocument($documentId)
    // {
    //     $document = Contract::findOrFail($documentId);
    //     return Storage::disk('public')->download($document->file_path, $document->file_name);
    // }

    public function openContractTypeModal()
    {
        $this->showContractTypeModal = true;
    }

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
        flash()->addSuccess('Contract type added successfully!');
    }

    public function openStatusModal($contractId)
    {
        $this->contractIdToUpdateStatus = $contractId;
        $contract = Contract::find($contractId);
        if ($contract) {
            $this->updatedStatus = $contract->contract_status;
            $this->showStatusModal = true;
        }
    }

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
        flash()->addSuccess('Contract status updated successfully!');
    }

    public function openconfirmDelete(){
        $this->showconfirmDelete = true;
    }

    public function delete($contractId)
    {
        $contract = Contract::with('documents')->findOrFail($contractId);
        
        // Delete associated documents
        foreach ($contract->documents as $document) {
            Storage::disk('public')->delete($document->file_path);
            $document->delete();
        }
        
        $contract->delete();
        flash()->addSuccess('Contract deleted successfully!');
    }

    public function removeAttachment($key)
    {
        unset($this->attachments[$key]);
    }

    private function resetInputFields()
    {
        $this->reset([
            'contractor_id',
            'project_id',
            'start_date',
            'end_date',
            'total_amount',
            'contract_type_id',
            'description',
            'payment_schedule',
            'contract_status',
            'updatedStatus',
            'contractIdToEdit',
            'contractIdToUpdateStatus',
            'modalType',
            'attachments',
        ]);
    }
}