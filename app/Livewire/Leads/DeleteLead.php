<?php

namespace App\Livewire\Leads;

use App\Models\Lead;
use Livewire\Component;

class DeleteLead extends Component
{
    public $selectedLeadId;

    public function mount($id)
    {
        $this->selectedLeadId = $id;
    }

    public function deleteLead()
    {
        Lead::find($this->selectedLeadId)->delete();
        $this->dispatch('close-panel');
    }

    public function closePanel()
    {
        $this->dispatch('close-panel');
    }

    public function render()
    {
        return view('livewire.leads.delete-lead');
    }
}
