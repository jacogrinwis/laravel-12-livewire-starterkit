<?php

use App\Models\Zone;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

new class extends Component {
    #[Rule(['required', 'min:3', 'max:250'])]
    public string $name;
 
    #[Rule(['required', 'max:2'])]
    public string $countryCode;

    #[Rule(['required', 'numeric'])]
    public float $zoneId;

    #[On('edit-zone')]
    public function edit($id)
    {
        $zone = Zone::find($id);

        $this->zoneId = $id;
        $this->name = $zone->name;
        $this->countryCode = $zone->country_code;

        Flux::modal('edit-zone')->show();
    }
 
    public function update() {
        $this->validate();
 
        $zone = Zone::find($this->zoneId);
        $zone->name = $this->name;
        $zone->country_code = $this->countryCode;
        $zone->save();
 
        $this->reset(['name', 'countryCode']);

        Flux::modal('edit-zone')->close();

        $this->dispatch('reload-datatable', 'zones-table');
    }
}; ?>

<flux:modal name="edit-zone" class="w-full">
    <form wire:submit="update">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Zone</flux:heading>
                <flux:subheading>Make details for the zone.</flux:subheading>
            </div>

            <flux:input wire:model="name" label="Name" placeholder="Name" />

            <flux:input wire:model="countryCode" label="Country Code" placeholder="Country Code" />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Update</flux:button>
            </div>
        </div>
    </form>
</flux:modal>
