<div>
    <div>
        <form class="max-w-full mx-auto flex space-x-4 items-center">
            <div class="relative flex-1 mb-3">
                <label for="filter.search" class="block mb-2 text-sm font-medium text-gray-900">Поиск по номеру телефона</label>
                <input
                    type="text"
                    class="block min-h-[auto] w-full rounded border px-3 py-2 leading-[1.6] outline-none transition-all duration-200
                     ease-linear focus:placeholder:opacity-100 focus:ring-2 focus:ring-blue-500 bg-amber-100"
                    id="filter.search"
                    placeholder="Введите номер"
                    wire:model.live="filter.search"
                />
            </div>

            <div class="flex-1 mb-3">
                <label for="filter.sortBy" class="block mb-2 text-sm font-medium text-gray-900">Сортировать по</label>
                <select id="filter.sortBy" class="bg-amber-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                 focus:border-blue-500 block w-full p-2.5"
                        wire:model.live="filter.sortBy">
                    <option value="created_at">Дате создания</option>
                    <option value="updated_at">Дате изменения</option>
                    <option value="phone">По телефону</option>
                </select>
            </div>

            <div class="flex-1 mb-3">
                <label for="filter.orderBy" class="block mb-2 text-sm font-medium text-gray-900">Порядок сортировки</label>
                <select id="filter.orderBy" class="bg-amber-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                 focus:border-blue-500 block w-full p-2.5"
                        wire:model.live="filter.orderBy">
                    <option value="ASC">В порядке возрастания</option>
                    <option value="DESC">В порядке убывания</option>
                </select>
            </div>

            <div class="flex-1 mb-3">
                <label for="filter.paginate" class="block mb-2 text-sm font-medium text-gray-900">Количество строк на странице</label>
                <select id="filter.paginate" wire:model.live="filter.paginate" class="bg-amber-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                 focus:border-blue-500 block w-full p-2.5">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                </select>
            </div>

            <div class="flex-1 mb-3">
                <label for="filter.status" class="block mb-2 text-sm font-medium text-gray-900">Фильтр по статусу</label>
                <select id="filter.status" class="bg-amber-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                 focus:border-blue-500 block w-full p-2.5"
                        wire:model.live="filter.status">
                    <option value="">Нет</option>
                    <option value="Новый">Новый</option>
                    <option value="В работе">В работе</option>
                    <option value="Ожидание ответа">Ожидание ответа</option>
                    <option value="Успешно закрыт">Успешно закрыт</option>
                    <option value="Неудачная попытка">Неудачная попытка</option>
                </select>
            </div>

            <div class="flex-1 mb-3 flex items-end">
                <button
                    type="button"
                    class="w-full inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal shadow-primary-3
                     transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2
                      focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none text-gray-900"
                    wire:click="resetFilter">
                    Сбросить фильтры
                </button>
            </div>
        </form>
    </div>

    <table class="min-w-full divide-y divide-gray-200 table-fixed w-full">
        <thead class="bg-amber-50 text-gray-900">
        <tr>
            <th scope="col" class="w-12 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
            <th scope="col" class="w-36 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Почта</th>
            <th scope="col" class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Телефон</th>
            <th scope="col" class="w-24 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ФИО</th>
            <th scope="col" class="w-20 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Комментарий</th>
            <th scope="col" class="w-28 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Статус</th>
            <th scope="col" class="w-48 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата создания</th>
            <th scope="col" class="w-48 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата обновления</th>
            <th scope="col" class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
        </tr>
        </thead>
        <tbody class="bg-amber-50 divide-y divide-gray-200">
        @foreach($leads as $lead)
            <tr class="
            @if($currentLeadId === $lead->id && $displayPanel)
                @elseif($changesId === $lead->id) bg-green-100
            @endif">
                <td class="px-6 py-4 whitespace-nowrap">{{ $lead->id }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $lead->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $lead->phone }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $lead->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $lead->comment }}</td>
                <td class="px-6 py-4">

                    @can('edit lead')
                        <select wire:change="updateLeadStatus({{ $lead->id }}, $event.target.value)" class="form-select bg-amber-100
         border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-40 p-2 ">
                            <option value="Новый" @if($lead->status == 'Новый') selected @endif>Новый</option>
                            <option value="В работе" @if($lead->status == 'В работе') selected @endif>В работе</option>
                            <option value="Ожидание ответа" @if($lead->status == 'Ожидание ответа') selected @endif>Ожидание ответа</option>
                            <option value="Успешно закрыт" @if($lead->status == 'Успешно закрыт') selected @endif>Успешно закрыт</option>
                            <option value="Неудачная попытка" @if($lead->status == 'Неудачная попытка') selected @endif>Неудачная попытка</option>
                        </select>

                    @else
                        <span>{{ $lead->status }}</span>
                    @endcan
                </td>

                <td class="px-6 py-4 whitespace-nowrap">{{ $lead->created_at }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $lead->updated_at }}</td>
                <td class="px-6 py-4 whitespace-nowrap">

                    @if(auth()->user()->hasRole(['admin', 'sales agent']))
                        <div class="flex flex-col space-y-2">
                            <button class="btn btn-purple" wire:click="getDataForEdit({{ $lead->id }})">
                                Изменить
                            </button>
                            <button class="btn btn-red" wire:click="tryDelete({{ $lead->id }})">
                                Удалить
                            </button>
                        </div>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$leads->links()}}
    @if($displayPanel)
        @livewire('leads.delete-lead', ["id" => $currentLeadId])
    @endif
</div>
