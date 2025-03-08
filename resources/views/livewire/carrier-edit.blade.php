<?php

use App\Models\Carrier;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

new class extends Component {
    #[Rule(['required', 'min:3', 'max:250'])]
    public string $name;

    #[Rule(['required', 'numeric'])]
    public float $carrierId;

    #[On('edit-carrier')]
    public function edit($id)
    {
        $carrier = Carrier::find($id);

        $this->carrierId = $id;
        $this->name = $carrier->name;

        Flux::modal('edit-carrier')->show();
    }
 
    public function update() {
        $this->validate();
 
        $carrier = Carrier::find($this->carrierId);
        $carrier->name = $this->name;
        $carrier->save();
 
        $this->reset(['name']);

        Flux::modal('edit-carrier')->close();

        $this->dispatch('reload-datatable', 'carriers-table');
    }
}; ?>

<flux:modal name="edit-carrier" class="w-full">
    <form wire:submit="update">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Carrier</flux:heading>
                <flux:subheading>Make details for the carrier.</flux:subheading>
            </div>

            <flux:input wire:model="name" label="Name" placeholder="Name" />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Update</flux:button>
            </div>
        </div>
    </form>
</flux:modal>
