<div>
    <form wire:submit="createUpdate">
        <div class="grid grid-cols-4 gap-1 py-3">
            <div class="col-span-2">
                <input type="text" placeholder="Имя Фамилия" wire:model="form.name">
            </div>
            <div class="col-span-2">
                <input type="text" placeholder="email@email.com" wire:model="form.email">
            </div>
            <div class="col-span-2">
                <input type="text" placeholder="79995554343" wire:model="form.phone">
            </div>
            <div class="col-span-2">
                <input type="text" placeholder="Комментарий" wire:model="form.comment">
            </div>
        </div>
        <div class="flex flex-wrap-nowrap gap-3">
            <button
                type="submit" class="brn__lead btn-blue">
                @isset($id) Обновить@elseСоздать@endisset
            </button>
            <button
                type="button" class="brn__lead btn-red" wire:click="resetForm">
                Отменить
            </button>
        </div>
    </form>
</div>
