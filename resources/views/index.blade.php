@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">

            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-xl font-semibold mb-2">Управление пользователями</h2>
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-2">Создать пользователя</a>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Список пользователей</a>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-xl font-semibold mb-2">Управление ролями и разрешениями</h2>
                <a href="{{ route('roles.create') }}" class="btn btn-primary mb-2">Создать роль</a>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Список ролей</a>
            </div>
        </div>
    </div>
@endsection
