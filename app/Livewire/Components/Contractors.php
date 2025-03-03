<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Contractor;
use Livewire\WithPagination;
use Flasher\Prime\FlasherInterface;

class Contractors extends Component
{
    use WithPagination;

    public $showModal = false;
    public $modalType = null;
    public $contractorIdToEdit;
    public $first_name;
    public $last_name;
    public $contractor_email;
    public $contractor_phone;
    public $contractor_address;
    public $searchQuery = '';
    public $selectedContractors = [];
    public $selectAll = false;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'contractor_email' => 'required|email|max:255',
        'contractor_phone' => 'required|numeric',
        'contractor_address' => 'required|string|max:255',
    ];

    public function render()
    {
        $contractors = Contractor::when($this->searchQuery, function ($query) {
            $query->where(function ($q) {
                $q->where('first_name', 'like', '%' . $this->searchQuery . '%')
                  ->orWhere('last_name', 'like', '%' . $this->searchQuery . '%')
                  ->orWhere('contractor_email', 'like', '%' . $this->searchQuery . '%')
                  ->orWhere('contractor_phone', 'like', '%' . $this->searchQuery . '%')
                  ->orWhere('contractor_address', 'like', '%' . $this->searchQuery . '%');
            });
        })->paginate(10);

        return view('livewire.components.contractors', compact('contractors'));
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedContractors = $this->contractors->pluck('id')->map(fn($id) => (string)$id)->toArray();
        } else {
            $this->selectedContractors = [];
        }
    }

    public function openModal()
    {
        $this->resetInputFields();
        $this->modalType = 'add';
        $this->showModal = true;
    }

    public function save(FlasherInterface $flasher)
    {
        $this->validate($this->rules + ['contractor_email' => 'unique:contractors,contractor_email']);

        Contractor::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'contractor_email' => $this->contractor_email,
            'contractor_phone' => $this->contractor_phone,
            'contractor_address' => $this->contractor_address,
        ]);

        $this->resetInputFields();
        $this->showModal = false;
        $flasher->addSuccess('Contractor created successfully!');
    }

    public function openEditModal($contractorId)
    {
        $this->resetInputFields();
        $contractor = Contractor::findOrFail($contractorId);
        $this->contractorIdToEdit = $contractor->id;
        $this->first_name = $contractor->first_name;
        $this->last_name = $contractor->last_name;
        $this->contractor_email = $contractor->contractor_email;
        $this->contractor_phone = $contractor->contractor_phone;
        $this->contractor_address = $contractor->contractor_address;
        $this->modalType = 'edit';
        $this->showModal = true;
    }
    public function openViewModal(){
        $this->resetInputFields();
        $contractor = Contractor::findOrFail($this->contractorIdToEdit);
        $this->first_name = $contractor->first_name;
        $this->last_name = $contractor->last_name;
        $this->contractor_email = $contractor->contractor_email;
        $this->contractor_phone = $contractor->contractor_phone;
        $this->contractor_address = $contractor->contractor_address;
        $this->modalType = 'view';
        $this->showModal = true;
    }

    public function update(FlasherInterface $flasher)
    {
        $this->validate($this->rules + [
            'contractor_email' => 'unique:contractors,contractor_email,' . $this->contractorIdToEdit,
        ]);

        $contractor = Contractor::findOrFail($this->contractorIdToEdit);
        $contractor->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'contractor_email' => $this->contractor_email,
            'contractor_phone' => $this->contractor_phone,
            'contractor_address' => $this->contractor_address,
        ]);

        $this->resetInputFields();
        $this->showModal = false;
        $flasher->addSuccess('Contractor updated successfully!');
    }

    public function delete($contractorId, FlasherInterface $flasher)
    {
        $contractor =Contractor::findOrFail($contractorId);
        if($contractor->contracts()->exists()){
            $flasher->addError('Cannot delete contractor with existing contracts.');
            return;  
        }
        Contractor::destroy($contractorId);
        $this->selectedContractors = array_diff($this->selectedContractors, [$contractorId]);
        $flasher->addSuccess('Contractor deleted successfully!');
    }

    public function search()
    {
        $this->resetPage();
    }

    private function resetInputFields()
    {
        $this->reset([
            'first_name',
            'last_name',
            'contractor_email',
            'contractor_phone',
            'contractor_address',
            'contractorIdToEdit',
            'modalType',
            'showModal'
        ]);
        $this->resetErrorBag();
    }

    public function setPage($pageNumber)
    {
        $this->gotoPage($pageNumber);
    }
}