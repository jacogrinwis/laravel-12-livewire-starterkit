<?php
 
use App\Models\User;
use Livewire\Volt\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Hash;
 
new class extends Component
{
    #[Rule(['required', 'unique:users', 'min:3', 'max:250'])]
    public string $name = '';
 
    #[Rule(['required', 'email', 'unique:users'])]
    public string $email = '';

    #[Rule(['required'])]
    public string $password = '';
 
    #[Rule(['required'])]
    public string $role = '';
 
    public function save() {
        $this->validate();
 
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make('password'),
            'role' => $this->role,
        ]);
 
        $this->reset(['name', 'email', 'password', 'role']);

        Flux::modal('create-user')->close();

        $this->dispatch('reload-datatable', 'users-table');
    }
}
?>

<flux:modal name="create-user" class="w-full">
    <form wire:submit="save">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create User</flux:heading>
                <flux:subheading>Make details for the user.</flux:subheading>
            </div>

            <flux:input wire:model="name" label="Name" placeholder="Name" />

            <flux:input wire:model="email" type="email" label="Email" placeholder="Email" />

            <flux:input wire:model="password" type="password" label="Password" placeholder="Password" />

            <flux:select wire:model="role" label="Role" placeholder="Choose role...">
                <flux:select.option value="VIEWER">Viewer</flux:select.option>
                <flux:select.option value="EDITOR">Editor</flux:select.option>
                <flux:select.option value="ADMIN">Admin</flux:select.option>
            </flux:select>

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Save</flux:button>
            </div>
        </div>
    </form>
</flux:modal>
