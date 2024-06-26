<div>
    <div class="mb-4 flex space-x-4">
        <a href="{{ route('users.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300
         font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Добавить пользователя
        </a>
        @can('add permissions')
            <a href="{{ route('admin.permissions') }}" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300
             font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                Изменить Разрешения
            </a>
        @endcan
    </div>

    <form class="max-w-full mx-auto flex space-x-4 items-center">
        <div class="relative flex-1 mb-3">
            <label for="filter.search" class="block mb-2 text-sm font-medium text-white">Поиск по имени</label>
            <input
                type="text"
                class="block min-h-[auto] w-full rounded border px-3 py-2 leading-[1.6] outline-none transition-all duration-200 ease-linear
                 focus:placeholder:opacity-100 focus:ring-2 focus:ring-blue-500 bg-amber-50 text-gray-900"
                id="filter.search"
                placeholder="Введите имя"
                wire:model.live="filter.search"
            />
        </div>

        <div class="flex-1 mb-3">
            <label for="filter.sortBy" class="block mb-2 text-sm font-medium text-white">Сортировать по</label>
            <select id="filter.sortBy" wire:model="filter.sortBy" class="bg-amber-50 border border-gray-300 text-gray-900 text-sm rounded-lg
             focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="created_at">Дате создания</option>
                <option value="updated_at">Дате изменения</option>
            </select>
        </div>

        <div class="flex-1 mb-3">
            <label for="filter.orderBy" class="block mb-2 text-sm font-medium text-white">Порядок сортировки</label>
            <select id="filter.orderBy" wire:model.live="filter.orderBy" class="bg-amber-50 border border-gray-300 text-gray-900 text-sm rounded-lg
            focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="ASC">В порядке возрастания</option>
                <option value="DESC">В порядке убывания</option>
            </select>
        </div>

        <div class="flex-1 mb-3">
            <label for="filter.paginate" class="block mb-2 text-sm font-medium text-white">Количество строк на странице</label>
            <select id="filter.paginate" wire:model.live="filter.paginate" class="bg-amber-50 border border-gray-300 text-gray-900 text-sm rounded-lg
            focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>
        </div>

        <div class="flex-1 mb-3">
            <label for="filter.status" class="block mb-2 text-sm font-medium text-white">Фильтр по ролям</label>
            <select id="filter.status" class="bg-amber-50 border border-gray-300 text-gray-900 text-sm rounded-lg
            focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    wire:model.live="filter.status">
                <option value="">Все роли</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex-1 mb-3 flex items-end">
            <button
                type="button"
                class="w-full inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal
                 text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2
                  focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600
                   active:shadow-primary-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
                wire:click="resetFilter"
            >
                Сбросить фильтры
            </button>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 table-fixed">
            <thead class="bg-amber-50 text-gray-900">
            <tr>
                <th scope="col" class="w-12 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th scope="col" class="w-36 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Почта</th>
                <th scope="col" class="w-24 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ФИО</th>
                <th scope="col" class="w-48 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Роль</th>
                <th scope="col" class="w-48 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата создания</th>
                <th scope="col" class="w-48 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата обновления</th>
                <th scope="col" class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
            </tr>
            </thead>
            <tbody class="bg-amber-50 divide-y divide-gray-200">
            @foreach($users as $user)
                <tr class="@if($currentUserId === $user->id && $displayPanel) bg-red-100 @elseif($changesId === $user->id) bg-green-100 @endif">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <select wire:change="updateRole({{ $user->id }}, $event.target.value)" class="form-select bg-amber-100 border-gray-300
                         text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-40 p-2">
                            <option value="">{{ $user->roles->pluck('name')->first() ?? 'Нет роли' }}</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->created_at }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->updated_at }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col space-y-2">
                            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800
                             focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600
                              dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 w-2/3" wire:click="getDataForEdit({{ $user->id }})">Изменить</button>
                            <form style="display:inline;">
                                @csrf
                                <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300
                                 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none
                                  dark:focus:ring-red-800 w-2/3" wire:click="tryDelete({{ $user->id }})">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
    @if($displayPanel)
        @livewire('admin.delete-user', ['id' => $currentUserId])
    @endif
    <div class="text-white font-bold flex justify-center text-xl">
        Работа с Пользователями
    </div>
    <livewire:admin.create-edit-user/>
</div>
