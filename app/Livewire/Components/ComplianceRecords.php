<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Auditlog;
use App\Models\Contractor;
use Livewire\WithFileUploads;
use App\Models\ComplianceRecord;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Storage;

class ComplianceRecords extends Component
{
    use WithFileUploads;
    public $showModal = false;
    public $modalType = null; 
    public $showStatusModal = false;
    public $issue_date;
    public $compliance_record_id;
    public $compliancerecordIdToEdit;
    public $compliancerecordIdToUpdateStatus;
    public $updatedStatus;
    public $document_name;
    public $document_path;
    public $doc_status;
    public $expiry_date;
    public $submitted_date;
    public $contractor_id;

    public function render()
    {
        $compliancerecords = ComplianceRecord::with('contractor')->paginate(10);
        $contractors = Contractor::all();
        return view('livewire.components.compliance-records', compact('contractors','compliancerecords'));
    }
    public function openModal()
    {
        $this->resetInputFields();
        $this->modalType = 'add';
        $this->showModal = true;
    }

    public function save(FlasherInterface $flasher){
        $this->validate([
            'contractor_id'=> 'required|exists:contractors,id',
            'document_name' =>'required',
            'document_path' => 'required|file|mimes:pdf,jpg,png,docx|max:2048',
            'issue_date'=>'required|date',
            'expiry_date' =>'required|date',
           'submitted_date' =>'required|date',
        ]);
        $filePath = $this->document_path->store('uploads/documents', 'public');

        ComplianceRecord::create([
            'document_name' => $this->document_name,
            'document_path' => $filePath,
            'doc_status' => 'pending review',
            'issue_date' => $this->issue_date,
            'expiry_date' => $this->expiry_date,
           'submitted_date' => $this->submitted_date,
            'contractor_id' => $this->contractor_id,
        ]);
        Auditlog::create([
            'contractor_id' => $this->contractor_id,
            'action' => 'Uploaded',
            'date' => now(),
            'user_id' => auth()->id(), 
        ]);

        $this->resetInputFields();
        $this->showModal = false;
        $flasher->addSuccess('Compliance record added successfully');
      
    }
    public function openEditModal($compliancerecordId){
        $this->resetInputFields();
        
        $this->compliancerecordIdToEdit = $compliancerecordId;
        $compliancerecord = ComplianceRecord::find($compliancerecordId);
        $this->document_name = $compliancerecord->document_name;
        $this->document_path = $compliancerecord->document_path;
        $this->issue_date = $compliancerecord->issue_date;
        $this->expiry_date = $compliancerecord->expiry_date;
        $this->submitted_date = $compliancerecord->submitted_date;
        $this->contractor_id = $compliancerecord->contractor_id;
        $this->modalType = 'edit';
        $this->showModal = true;
    }
    public function update(FlasherInterface $flasher){
        $this->validate([
            'document_name' =>'required',
           'document_path' => 'required|file|mimes:pdf,jpg,png,docx|max:2048',
            'issue_date'=>'required|date',
            'expiry_date' =>'required|date',
           'submitted_date' =>'required|date',
        ]);
        $compliancerecord = ComplianceRecord::find($this->compliancerecordIdToEdit);
        if ($this->document_path) {
        $filePath = $this->document_path->store('uploads/documents', 'public');
        $compliancerecord->document_path = $filePath;
        }
        $compliancerecord->update([
            'document_name' => $this->document_name,
            'issue_date' => $this->issue_date,
            'expiry_date' => $this->expiry_date,
           'submitted_date' => $this->submitted_date,
        ]);
        $this->resetInputFields();
        $this->showModal = false;
        $flasher->addSuccess('Compliance record updated successfully');
    }

    public function download($compliancerecordId)
    {
        $compliancerecord = ComplianceRecord::find($compliancerecordId);

        if ($compliancerecord && Storage::disk('public')->exists($compliancerecord->document_path)) {
            return response()->download(storage_path('app/public/' . $compliancerecord->document_path));
        }

        // Handle the case where the file doesn't exist.  You could flash a message, redirect, etc.
        return redirect()->back()->with('error', 'File not found.');  
    }

    public function openStatusModal($compliancerecordId, FlasherInterface $flasher){
        $this->compliancerecordIdToUpdateStatus = $compliancerecordId;
        $compliancerecord = ComplianceRecord::find($compliancerecordId);
        if($compliancerecord){
            $this->updatedStatus = $compliancerecord->doc_status;
            $this->showStatusModal = true;
        }else{
            $flasher->addError('Compliance record not found.');
        }
    }
    public function updateStatus(FlasherInterface $flasher){
        $this->validate([
            'updatedStatus' =>'required|in:pending review,valid,expired'
        ]);
        $compliancerecord = ComplianceRecord::find($this->compliancerecordIdToUpdateStatus);
        $compliancerecord->update([
            'doc_status' => $this->updatedStatus,
        ]);
        Auditlog::create([
            'contractor_id' => $this->contractor_id,
            'action' => 'Approved',
            'date' => now(),
            'user_id' => auth()->id(), 
        ]);

        $this->resetInputFields();
        $this->showStatusModal = false;
        $flasher->addSuccess('Compliance record status updated successfully');
    }
    public function delete($compliancerecordId, FlasherInterface $flasher){
        ComplianceRecord::destroy($compliancerecordId);
        $flasher->addSuccess('Compliance record deleted successfully');
    }
    private function resetInputFields(){
        $this->compliancerecordIdToEdit = null;
        $this->compliancerecordIdToUpdateStatus = null;
        $this->updatedStatus = null;
        $this->document_name = '';
        $this->document_path = '';
        $this->issue_date = '';
        $this->expiry_date = '';
        $this->submitted_date = '';
        $this->contractor_id = '';
        $this->modalType = null;
        
    }
    
}
