<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Изменение разрешений') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed">
                        <thead class="bg-amber-50 text-gray-900">
                        <tr>
                            <th scope="col" class="w-12 px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">ID</th>
                            <th scope="col" class="w-36 px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">ФИО</th>
                            <th scope="col" class="w-24 px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">Роль</th>
                            <th scope="col" class="w-48 px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">Разрешения</th>
                            <th scope="col" class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">Действия</th>
                        </tr>
                        </thead>
                        <tbody class="bg-amber-50 divide-y divide-gray-200 text-gray-900">
                        @foreach($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                <td class="px-6 py-4 whitespace-normal break-words w-48">{{ $user->permissions->pluck('name')->implode(', ') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('users.edit-role', $user->id) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Изменить разрешения</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
