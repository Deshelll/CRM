<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class DeleteUser extends Component
{
    public $selectedUserId;

    public function mount($id)
    {
        $this->selectedUserId = $id;
    }

    public function deleteUser()
    {
        User::find($this->selectedUserId)->delete();
        $this->dispatch('userDeleted');
    }

    public function closePanel()
    {
        $this->dispatch('closePanel');
    }

    public function render()
    {
        return view('livewire.admin.delete-user');
    }
}
