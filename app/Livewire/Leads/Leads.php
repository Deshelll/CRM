<?php

namespace App\Livewire\Leads;

use App\Models\Lead;
use Livewire\Attributes\On;
use Livewire\Component;

class Leads extends Component
{

    public $changesId;
    public $displayPanel;
    public $currentLeadId;

    public function mount()
    {
        $this->displayPanel = false;
        $this->currentLeadId = null;
    }

    public function tryDelete($id)
    {
        $this->displayPanel = true;
        $this->currentLeadId = $id;
    }

    #[On('close-panel')]
    public function closePanel()
    {
        $this->displayPanel = false;
        $this->currentLeadId = null;
    }

    public function getDataForEdit($id)
    {
        $this->dispatch('get-lead', $id);
    }

    #[On('lead-updated')]
    public function updatedLead($id=null)
    {
        if (isset($id))
        {
            $this->changesId = $id;
        }
    }

    public function render()
    {
        return view('livewire.leads.leads', [
            'leads'=>Lead::all()
        ]);
    }
}
