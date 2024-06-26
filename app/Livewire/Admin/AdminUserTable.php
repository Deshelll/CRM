<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class AdminUserTable extends Component
{
    use WithPagination;

    public $changesId;
    public $displayPanel;
    public $currentUserId;
    public $searchTerm = '';

    public $filter = [
        "orderBy" => "DESC",
        "sortBy" => 'created_at',
        "search" => '',
        "paginate" => 10,
        "status" => ''
    ];

    public $roles;

    protected $listeners = [
        'userDeleted' => 'refreshUsers',
        'closePanel' => 'closePanel'
    ];

    public function mount()
    {
        $this->displayPanel = false;
        $this->currentUserId = null;
        $this->roles = Role::all();
    }

    public function tryDelete($id)
    {
        $this->displayPanel = true;
        $this->currentUserId = $id;
    }

    #[On('close-panel')]
    public function closePanel()
    {
        $this->displayPanel = false;
        $this->currentUserId = null;
    }

    #[On('user-deleted')]
    public function userDeleted($id = null)
    {
        if (isset($id)) {
            $this->changesId = $id;
        }
        $this->refreshUsers();
    }

    public function refreshUsers()
    {
        $this->displayPanel = false;
        $this->currentUserId = null;
    }

    public function resetFilter()
    {
        $this->filter = [
            "orderBy" => "DESC",
            "sortBy" => 'created_at',
            "search" => '',
            "paginate" => 10,
            "status" => ''
        ];
        $this->resetPage();
    }

    public function updateRole($userId, $roleName)
    {
        $user = User::find($userId);

        if ($roleName) {
            $user->syncRoles($roleName);
        } else {
            $user->syncRoles([]);
        }

        $this->changesId = $userId;
    }

    public function getDataForEdit($userId)
    {
        $this->dispatch('getUser', $userId);
    }

    public function render()
    {
        $query = User::query();

        if ($this->filter['search']) {
            $query->where('name', 'like', '%' . $this->filter['search'] . '%');
        }

        if ($this->filter['status']) {
            $query->whereHas('roles', function ($q) {
                $q->where('name', $this->filter['status']);
            });
        }

        $query->orderBy($this->filter['sortBy'], $this->filter['orderBy']);

        $users = $query->paginate($this->filter['paginate']);

        return view('livewire.admin.admin-user-table', [
            'users' => $users,
            'roles' => $this->roles,
        ]);
    }
}
