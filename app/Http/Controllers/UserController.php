<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    private $selectedUserId;

    public function index(Request $request)
    {
        $search = $request->input('filter.search', '');
        $sortBy = $request->input('filter.sortBy', 'created_at');
        $orderBy = $request->input('filter.orderBy', 'DESC');
        $paginate = $request->input('filter.paginate', 10);

        $users = User::query()
            ->where('name', 'like', '%' . $search . '%')
            ->orderBy($sortBy, $orderBy)
            ->paginate($paginate);

        return view('admin.index', compact('users', 'search', 'sortBy', 'orderBy', 'paginate'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->assignRole($data['role']);

        return redirect()->route('admin.index')->with('success', 'Пользователь создан.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        if ($data['password']) {
            $user->update(['password' => bcrypt($data['password'])]);
        }

        $user->syncRoles([$data['role']]);

        return redirect()->route('admin.index')->with('success', 'Пользователь обновлен.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'Пользователь удален.');
    }

    public function editRole($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.edit-role', compact('user', 'roles', 'permissions'));
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->syncRoles([$data['role']]);

        return redirect()->route('admin.index')->with('success', 'Роль пользователя обновлена.');
    }

    public function updatePermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $permissions = $request->input('permissions', []);

        $user->syncPermissions($permissions);

        return redirect()->route('admin.index')->with('success', 'Разрешения пользователя обновлены.');
    }

    public function permissions()
    {
        $users = User::with('roles', 'permissions')->get();
        return view('admin.permissions', compact('users'));
    }
}
