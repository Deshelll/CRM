<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminUser;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', [
            'search' => '',
            'sortBy' => 'created_at',
            'orderBy' => 'DESC',
            'paginate' => 10,
        ]);

        $users = AdminUser::query()
            ->searchName($filter['search'])
            ->sortByColumn($filter['sortBy'], $filter['orderBy'])
            ->paginateResults($filter['paginate']);

        return view('admin.index', compact('users', 'filter'));
    }
}
