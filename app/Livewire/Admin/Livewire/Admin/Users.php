<?php

namespace App\Livewire\Admin\Livewire\Admin;

use App\Models\AdminUser;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $filter = [
        "orderBy" => "DESC",
        "sortBy" => 'created_at',
        "search" => '',
        "paginate" => 10
    ];

    public function resetFilter()
    {
        $this->filter = [
            "orderBy" => "DESC",
            "sortBy" => 'created_at',
            "search" => '',
            "paginate" => 10
        ];
        $this->resetPage();
    }

    public function render()
    {
        $users = AdminUser::search($this->filter['search'])
            ->sortByColumn($this->filter['sortBy'], $this->filter['orderBy'])
            ->paginate($this->filter['paginate']);

        return view('livewire.admin.users', [
            'users' => $users
        ]);
    }
}
