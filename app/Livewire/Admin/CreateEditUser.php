<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class CreateEditUser extends Component
{
    public $userId;
    public $form = [
        'name' => '',
        'email' => '',
        'phone' => ''
    ];

    protected $listeners = ['getUser'];

    public function getUser($id)
    {
        $user = User::find($id);
        $this->form['name'] = $user->name;
        $this->form['email'] = $user->email;
        $this->form['phone'] = $user->phone;
        $this->userId = $id;
    }

    public function createUpdate()
    {
        $this->validate([
            'form.name' => 'required|string|max:255',
            'form.email' => 'required|string|email|max:255',
            'form.phone' => 'nullable|string|max:20',
        ]);

        if (isset($this->userId)) {
            $user = User::find($this->userId);
            $user->update($this->form);
            $this->dispatch('user-updated', $this->userId);
            $this->userId = null;
        } else {
            User::create($this->form);
            $this->dispatch('user-updated');
        }
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->form = [
            'name' => '',
            'email' => '',
            'phone' => ''
        ];
        $this->userId = null;
    }

    public function render()
    {
        return view('livewire.admin.create-edit-user');
    }
}
