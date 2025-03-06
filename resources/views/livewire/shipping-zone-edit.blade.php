<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\ShippingZone;

new class extends Component {
    public $name;
    public $code;
    public $shippingZoneId;

    #[On('edit-shipping-zone')]
    public function editShippingZone($id)
    {
        $shippingZone = ShippingZone::find($id);

        $this->shippingZoneId = $id;
        $this->name = $shippingZone->name;
        $this->code = $shippingZone->code;

        Flux::modal('edit-shipping-zone')->show();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'code' => 'required',
        ]);

        $shippingZone = ShippingZone::find($this->shippingZoneId);
        $shippingZone->name = $this->name;
        $shippingZone->code = $this->code;
        $shippingZone->save();

        Flux::modal('edit-shipping-zone')->close();

        $this->dispatch('reload-datatable', 'shipping-zones-table');
    }
}; ?>

<div>
    <flux:modal name="edit-shipping-zone" class="w-full">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Zone</flux:heading>
                <flux:subheading>Edit details for the zone.</flux:subheading>
            </div>

            <flux:input wire:model="name" label="Name" placeholder="Your name" />

            <flux:input wire:model="code" label="Code" placeholder="Your code" />

            <div class="flex">
                <flux:spacer />

                <flux:button wire:click="update" type="submit" variant="primary">Update</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
