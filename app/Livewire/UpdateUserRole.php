<?php

namespace App\Livewire;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\Component;

class UpdateUserRole extends Component
{
    public $user;
    public $roles;
    public $selectedRole;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->roles = Role::all();
        $this->selectedRole = $user->roles->pluck('name')->first();
    }

    public function updatedSelectedRole($value)
    {
        $this->user->syncRoles([$value]);
        $this->emit('roleUpdated');
    }

    public function render()
    {
        return view('livewire.update-user-role');
    }
}
