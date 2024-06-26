<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Добавить пользователя') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4 bg-amber-50">
        <h1 class="text-2xl font-bold mb-4 text-gray-900">Добавить пользователя</h1>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Имя</label>
                <input type="text" id="name" name="name" class="form-control bg-amber-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <div class="form-group mb-3">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                <input type="email" id="email" name="email" class="form-control bg-amber-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <div class="form-group mb-3">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Пароль</label>
                <input type="password" id="password" name="password" class="form-control bg-amber-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <div class="form-group mb-3">
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Подтвердите пароль</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control bg-amber-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <div class="form-group mb-3">
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Роль</label>
                <select id="role" name="role" class="form-control bg-amber-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Создать пользователя</button>
        </form>
    </div>
</x-app-layout>
