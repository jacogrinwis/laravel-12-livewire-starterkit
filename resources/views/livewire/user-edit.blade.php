<?php

use App\Models\User;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

new class extends Component {
    #[Rule(['required', 'min:3', 'max:250'])]
    public string $name;
 
    #[Rule(['required', 'email', 'unique:users,email'])]
    public string $email;
 
    #[Rule(['required'])]
    public string $role;

    #[Rule(['required', 'numeric'])]
    public float $userId;

    #[On('edit-user')]
    public function edit($id)
    {
        $user = User::find($id);

        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;

        Flux::modal('edit-user')->show();
    }
 
    public function update() {
        $this->validate();
 
        $user = User::find($this->userId);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->role = $this->role;
        $user->save();
 
        $this->reset(['name', 'email', 'role']);

        Flux::modal('edit-user')->close();

        $this->dispatch('reload-datatable', 'users-table');
    }
}; ?>

<flux:modal name="edit-user" class="w-full">
    <form wire:submit="save">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create User</flux:heading>
                <flux:subheading>Make details for the user.</flux:subheading>
            </div>

            <flux:input wire:model="name" label="Name" placeholder="Name" />

            <flux:input wire:model="email" type="email" label="Email" placeholder="Email" />

            {{-- <flux:input wire:model="password" type="password" label="Password" placeholder="Password" /> --}}

            <flux:select wire:model="role" label="Role" placeholder="Choose role...">
                <flux:select.option value="VIEWER">Viewer</flux:select.option>
                <flux:select.option value="EDITOR">Editor</flux:select.option>
                <flux:select.option value="ADMIN">Admin</flux:select.option>
            </flux:select>

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Update</flux:button>
            </div>
        </div>
    </form>
</flux:modal>
