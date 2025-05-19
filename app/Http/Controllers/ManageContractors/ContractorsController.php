<?php

namespace App\Http\Controllers\ManageContractors;

use App\Models\staff;
use App\Models\document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ContractorsController extends Controller
{
    public function index()
    {
        return view('pages.manage-contractors.contractors');
    }
    public function showProfile(staff $staff)
{
    return view('contractors.profile', compact('staff'));
}
 public function updateProfile(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'emergency_contact' => 'nullable|string|max:255',
            'tax_id' => 'nullable|string|max:255',
            'bank_account' => 'nullable|string|max:255',
        ]);

        $staff->update($validated);

        return back()->with('success', 'Profile updated successfully');
    }
    public function uploadDocument(Request $request, Staff $staff)
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
            'document_type' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'expiry_date' => 'nullable|date|after:issue_date',
        ]);

        $file = $request->file('document');
        $path = $file->store('staff-documents');

        $staff->documents()->create([
            'name' => $request->document_type,
            'file_path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date,
        ]);

        return back()->with('success', 'Document uploaded successfully');
    }
     public function downloadDocument(document $document)
    {
        return Storage::download($document->file_path, $document->original_name);
    }

    public function deleteDocument(document $document)
    {
        Storage::delete($document->file_path);
        $document->delete();
        
        return back()->with('success', 'Document deleted successfully');
    }

}
