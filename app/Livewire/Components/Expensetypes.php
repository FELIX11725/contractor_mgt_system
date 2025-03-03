<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Expensetype;
use Flasher\Prime\FlasherInterface;

class Expensetypes extends Component
{

    public $expense_type;
    public $expense_item;
    public $expensetype;

    public $showModal = false;
    public $modalType = null;
    public $expensetypeIdToEdit;
    public $selectAll = false;
    public $selectedRows = [];
    public $searchQuery = '';

    public function updatedSelectAll($value)
{
    if ($value) {
        $this->selectedRows = $this->expensetypes->pluck('id')->toArray();
    } else {
        $this->selectedRows = [];
    }
}   
public function render()
{
    $expensetypes = Expensetype::query()
        ->when($this->searchQuery, function ($query) {
            $query->where('expense_item', 'like', '%' . $this->searchQuery . '%')
                  ->orWhereHas('project', function ($q) {
                      $q->where('project_name', 'like', '%' . $this->searchQuery . '%');
                  });
        })
        ->paginate(10);

   
    

    return view('livewire.components.expensetypes', compact('expensetypes'));
}
    public function openModal() 
    {
        $this->resetInputFields(); 
        $this->modalType = 'add';
        $this->showModal = true;
    }

    public function save(FlasherInterface $flasher)
    {
        
        $this->validate([
            'expense_item' => 'required',
        ]);

        Expensetype::create([
          
            'expense_item' => $this->expense_item,
        ]);

        $this->resetInputFields();
        $this->showModal = false;
        $flasher->addSuccess('Expense item created successfully!'); 
    
}
public function openEditModal($expensetypeId)
    {
        $this->resetInputFields();
        $expensetype = Expensetype::findOrFail($expensetypeId);
        $this->expensetypeIdToEdit = $expensetype->id;
        $this->expense_item = $expensetype->expense_item;
        $this->modalType = 'edit'; 
        $this->showModal = true;
    }

    public function openViewModal($expensetypeId)
    {
        $expensetype = Expensetype::findOrFail($expensetypeId);
        $this->expensetypeIdToEdit = $expensetype->id;
        $this->expense_item = $expensetype->expense_item;
        $this->modalType = 'view';
        $this->showModal = true;
    }
    
    public function update(FlasherInterface $flasher)
    {
        if ($this->expensetypeIdToEdit) {
        $this->validate([
            'expense_item' => 'required',
        ]);

        $expensetype = Expensetype::findOrFail($this->expensetypeIdToEdit);
        $expensetype->update([
            'expense_item' => $this->expense_item,
        ]);

        $this->resetInputFields();
        $this->showModal = false;
        $flasher->addSuccess('Expense item updated successfully!'); 
    }
}
public function delete($expensetypeId, FlasherInterface $flasher)
    {
        Expensetype::destroy($expensetypeId);
        $flasher->addSuccess('Expense category deleted successfully!');
    }

    private function resetInputFields()
    {
        $this->expense_type = '';
        $this->expense_item = ''; 
        $this->expensetypeIdToEdit = null;
        $this->showModal = false;
        $this->modalType = null;
    }
}
