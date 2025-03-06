<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\ShippingZone;
use App\Models\ShippingCarrier;

new class extends Component {
    public $name;
    public $shippingCarrierId;
    public $shippingZoneId;

    #[On('edit-shipping-carrier')]
    public function editShippingCarrier($id)
    {
        $shippingCarrier = ShippingCarrier::find($id);

        $this->shippingCarrierId = $id;
        $this->name = $shippingCarrier->name;
        $this->shippingZoneId = $shippingCarrier->shipping_zone_id;

        Flux::modal('edit-shipping-carrier')->show();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'shippingZoneId' => 'required',
        ]);

        $shippingCarrier = ShippingCarrier::find($this->shippingCarrierId);
        $shippingCarrier->name = $this->name;
        $shippingCarrier->shipping_zone_id = $this->shippingZoneId;
        $shippingCarrier->save();

        Flux::modal('edit-shipping-carrier')->close();

        $this->dispatch('reload-datatable', 'shipping-carriers-table');
    }

    public function with(): array
    {
        return [
            'shippingZones' => ShippingZone::all()
        ];
    }
}; ?>

<div>
    <flux:modal name="edit-shipping-carrier" class="w-full">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Carrier</flux:heading>
                <flux:subheading>Edit details for the carrier.</flux:subheading>
            </div>

            <flux:select wire:model.change="shippingZoneId" label="Zone">
                <flux:select.option value="">Choose Zone...</flux:select.option>    
                @foreach ($shippingZones as $zone)
                    <flux:select.option value="{{ $zone->id }}">
                        {{ $zone->name }}
                    </flux:select.option>  
                @endforeach
            </flux:select>

            @if ($shippingZoneId)
                <flux:input wire:model="name" label="Name" placeholder="Your name" />
            @endif

            <div class="flex">
                <flux:spacer />

                <flux:button wire:click="update" type="submit" variant="primary">Update</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
