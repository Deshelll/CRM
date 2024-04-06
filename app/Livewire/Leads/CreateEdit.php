<?php

namespace App\Livewire\Leads;

use App\Livewire\Forms\LeadForm;
use App\Models\Lead;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateEdit extends Component
{
    public $id;
    public LeadForm $form;
    #[On('get-lead')]
    public function edit($id)
    {
        $this->form -> setLead(Lead::find($id));
        $this->id= $id;
    }

    public function createUpdate()
    {
        if (isset($this->id)){
        $this->form->update();
        $this->dispatch('lead-updated', $this->id);
        $this->id = null;
        }else{
            $this->form->create();
        }
        $this->form->reset();
        $this->dispatch('lead-updated');
    }

    public function resetForm()
    {
        $this->form->reset();
        $this->id= null;
    }

    public function render()
    {
        return view('livewire.leads.create-edit');
    }
}
