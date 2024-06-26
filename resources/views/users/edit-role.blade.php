<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Редактировать разрешения пользователя') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-white">Редактировать разрешения пользователя</h1>
        <form action="{{ route('users.update-permissions', $user->id) }}" method="POST">
            @csrf
            <style>
                .form-checkbox {
                    width: 4% !important;
                    margin-right: 0.5rem
                }
            </style>
            <div class="form-group mb-3">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Разрешения</label>
                @foreach($permissions as $permission)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" id="permission-{{ $permission->id }}" name="permissions[]" value="{{ $permission->name }}"
                               @if($user->permissions->pluck('name')->contains($permission->name)) checked @endif
                               class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out padding:10px">
                        <label for="permission-{{ $permission->id }}" class="ml-2 block text-sm leading-5 text-gray-900 dark:text-white">
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5
            py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Обновить разрешения</button>
        </form>
    </div>
</x-app-layout>
