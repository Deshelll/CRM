<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(auth()->user()->hasRole(['admin', 'sales agent', 'support operator']))
        @can('view leads')
            <div class="py-12">
                <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
                    <div class="bg-amber-50 overflow-hidden shadow-sm sm:rounded-lg">
                        <livewire:leads.leads/>
                    </div>
                </div>
            </div>
        @endcan

        @can('edit lead')
            <div class="py-2">
                <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
                    <div class="bg-amber-50 overflow-hidden shadow-sm sm:rounded-lg ">
                        <div class="text-gray-900 font-bold flex justify-center text-xl">
                            Работа с лидом
                        </div>

                        <livewire:leads.create-edit/>
                    </div>
                </div>
            </div>
    @endcan
    @endif
</x-app-layout>
