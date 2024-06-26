<div>
    <form wire:submit="createUpdate">
        <div class="grid grid-cols-3 gap-1 py-3">
            <div class="col-span-3">
                <input class="bg-amber-100 text-gray-900 w-full" type="text" placeholder="Имя Фамилия" wire:model="form.name">
            </div>
            <div class="col-span-3">
                <input class="bg-amber-100 text-gray-900 w-full" type="text" placeholder="email@email.com" wire:model="form.email">
            </div>
        </div>
        <div class="flex flex-wrap-nowrap gap-3">
            <button type="submit" class="brn__lead btn-blue w-full">
                @isset($userId) Обновить @else Создать @endisset
            </button>
            <button type="button" class="brn__lead btn-red w-full" wire:click="resetForm">
                Отменить
            </button>
        </div>
    </form>
</div>
