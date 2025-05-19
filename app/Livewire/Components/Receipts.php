<?php

namespace App\Livewire\Components;

use App\Models\Project;
use App\Models\Receipt;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class Receipts extends Component
{
    use WithFileUploads, WithPagination;
    
    public $projects;
    public $selectedProject;
    public $amount;
    public $description;
    public $receipt_photo;
    public $viewingReceipt = false;
    public $currentReceipt;
    
    protected $rules = [
        'selectedProject' => 'required|exists:projects,id',
        'amount' => 'required|numeric|min:1',
        'description' => 'required|string|min:5|max:500',
        'receipt_photo' => 'nullable|image|max:2048', // 2MB max
    ];
    
    public function mount()
    {
        $this->projects = Project::orderBy('project_name')->get();
    }
    
    public function saveReceipt()
    {
        $this->validate();
        
        // Clean the amount by removing commas
        $cleanedAmount = str_replace(',', '', $this->amount);
        
        // Generate receipt number (format: REC-YYYYMMDD-XXXX)
        $receiptNumber = 'REC-' . now()->format('Ymd') . '-' . str_pad(
            Receipt::whereDate('created_at', today())->count() + 1, 
            4, 
            '0', 
            STR_PAD_LEFT
        );
        
        // Handle file upload
        $photoPath = null;
        if ($this->receipt_photo) {
            $photoPath = $this->receipt_photo->store('receipts', 'public');
        }
        
        // Create the receipt record
        Receipt::create([
            'project_id' => $this->selectedProject,
            'amount' => $cleanedAmount,
            'description' => $this->description,
            'receipt_number' => $receiptNumber,
            'photo_path' => $photoPath,
            'user_id' => auth()->id(),
        ]);
        
        // Reset form fields
        $this->reset(['selectedProject', 'amount', 'description', 'receipt_photo']);
        
        // Show success message
        session()->flash('message', 'Receipt successfully recorded.');
    }
    
    public function viewReceipt($receiptId)
    {
        $this->currentReceipt = Receipt::with('project')->findOrFail($receiptId);
        $this->viewingReceipt = true;
    }
    
    public function closeModal()
    {
        $this->viewingReceipt = false;
        $this->currentReceipt = null;
    }
    
    public function deleteReceipt($receiptId)
    {
        $receipt = Receipt::findOrFail($receiptId);
        
        // Delete associated photo if exists
        if ($receipt->photo_path) {
            Storage::disk('public')->delete($receipt->photo_path);
        }
        
        $receipt->delete();
        
        session()->flash('message', 'Receipt successfully deleted.');
    }
     public function downloadReceipt($receiptId)
    {
        $receipt = Receipt::with('project')->findOrFail($receiptId);
        
        $pdf = Pdf::loadView('livewire.components.receipt-pdf', [
            'receipt' => $receipt
        ]);
        
        return response()->streamDownload(
            fn () => print($pdf->output()),
            "receipt-{$receipt->receipt_number}.pdf"
        );
    }
    
    public function render()
    {
        $receipts = Receipt::with('project')
            ->latest()
            ->paginate(10);
            
        return view('livewire.components.receipts', [
            'receipts' => $receipts,
        ]);
    }
}