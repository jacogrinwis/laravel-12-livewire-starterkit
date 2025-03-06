<?php

use Livewire\Volt\Component;
use App\Models\ShippingZone;
use App\Models\ShippingCarrier;

new class extends Component {
    public string $name;
    public string $shippingZoneId;

    public function createShippingCarrier()
    {
        $this->validate([
            'name' => 'required',
            'shippingZoneId' => 'required', 
        ]);
        
        ShippingCarrier::create([
            'name' => $this->name,
            'shipping_zone_id' => $this->shippingZoneId,
        ]);
        
        $this->reset(['name', 'shippingZoneId']);
        
        Flux::modal('create-shipping-carrier')->close();
        
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
    <flux:modal name="create-shipping-carrier" class="w-full">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create Carrier</flux:heading>
                <flux:subheading>Make details for the carrier.</flux:subheading>
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

                <flux:button wire:click="createShippingCarrier" type="submit" variant="primary">Save</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
