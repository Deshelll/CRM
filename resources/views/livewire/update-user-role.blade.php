<div>
    <select wire:model="selectedRole" class="form-select mt-1 block w-full">
        @foreach($roles as $role)
            <option value="{{ $role->name }}">{{ $role->name }}</option>
        @endforeach
    </select>
</div>
