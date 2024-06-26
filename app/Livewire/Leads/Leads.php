<?php

namespace App\Livewire\Leads;

use App\Models\Lead;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Leads extends Component
{
    use WithPagination;

    public $changesId;
    public $displayPanel;
    public $currentLeadId;
    public $searchTerm = '';

    public $filter = [
        "orderBy" => "DESC",
        "sortBy" => 'created_at',
        "search" => '',
        "paginate" => 5,
        "status" => ''
    ];

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
    public function updatedLead($id = null)
    {
        if (isset($id)) {
            $this->changesId = $id;
        }
    }

    public function resetFilter()
    {
        $this->filter = [
            "orderBy" => "DESC",
            "sortBy" => 'created_at',
            "search" => '',
            "paginate" => 5,
            "status" => ''
        ];
        $this->resetPage();
    }



    public function updateLeadStatus($id, $status)
    {
        $lead = Lead::find($id);
        $lead->status = $status;
        $lead->save();

        $this->changesId = $id;
    }

    public function render()
    {
        $query = Lead::query();

        if ($this->filter['search']) {
            $query->where('phone', 'like', '%' . $this->filter['search'] . '%');
        }

        if ($this->filter['status']) {
            $query->where('status', $this->filter['status']);
        }

        $query->orderBy($this->filter['sortBy'], $this->filter['orderBy']);

        $leads = $query->paginate($this->filter['paginate']);

        return view('livewire.leads.leads', [
            'leads' => $leads
        ]);
    }
}
