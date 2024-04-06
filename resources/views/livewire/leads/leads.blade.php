{{--<div>--}}
{{--    <div class="">--}}
{{--       @foreach($leads as $lead)--}}
{{--            <div class="@if($this->changesId == $lead->id) bg-green-300 @endif grid grid-cols-6 gap-1 px-5 py-6">--}}
{{--                <div class="col-span-1">--}}
{{--                    {{$lead->id}}--}}
{{--                </div>--}}
{{--                <div class="col-span-1">--}}
{{--                    {{$lead->name}}--}}
{{--                </div>--}}
{{--                <div class="col-span-1">--}}
{{--                    {{$lead->email}}--}}
{{--                </div>--}}
{{--                <div class="col-span-1">--}}
{{--                    {{$lead->phone}}--}}
{{--                </div>--}}
{{--                <div class="col-span-1">--}}
{{--                    {{$lead->comment}}--}}
{{--                </div>--}}
{{--                <div class="col-span-1">--}}
{{--                    <button class="btn btn-purple" wire:click = "getDataForEdit({{$lead->id}})">--}}
{{--                        Изменить--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--               </div>--}}
{{--       @endforeach--}}
{{--    </div>--}}
{{--</div>--}}

<div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Почта</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Телефон</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ФИО</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Комментарий</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach($leads as $lead)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $lead->id }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $lead->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $lead->phone }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $lead->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $lead->comment }}</td>
                <td class="col-span-1">
                    <button class="btn btn-purple" wire:click = "getDataForEdit({{$lead->id}})">
                        Изменить
                    </button>
                </td>
                <td class="col-span-1">
                    <button class="btn btn-red" wire:click = "tryDelete({{$lead->id}})">
                        Удалить
                    </button>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
    @if($displayPanel)
        @livewire('leads.delete-lead', ["id"=>$currentLeadId]);
    @endif
</div>
