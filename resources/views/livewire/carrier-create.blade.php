<?php

use App\Models\Carrier;
use Livewire\Volt\Component;
use Livewire\Attributes\Rule;

new class extends Component {
    #[Rule(['required', 'unique:carriers', 'min:3', 'max:250'])]
    public string $name = '';

    public function save() {
        $this->validate();

        Carrier::create(['name' => $this->name]);

        $this->reset(['name']);

        Flux::modal('create-carrier')->close();

        $this->dispatch('reload-datatable', 'carriers-table');
    }
}; ?>

<flux:modal name="create-carrier" class="w-full">
    <form wire:submit="save">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create Carrier</flux:heading>
                <flux:subheading>Make details for the carrier.</flux:subheading>
            </div>

            <flux:input wire:model="name" label="Name" placeholder="Name" />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Save</flux:button>
            </div>
        </div>
    </form>
</flux:modal>
