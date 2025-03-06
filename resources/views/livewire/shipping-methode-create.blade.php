<?php

use Livewire\Volt\Component;
use App\Models\ShippingZone;
use App\Models\ShippingCarrier;
use App\Models\ShippingMethode;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;

new class extends Component {
    #[Validate('required|numeric')]
    public $shippingZoneId;

    #[Validate('required|numeric')]
    public $shippingCarrierId;

    public $shippingCarriers;

    #[Validate('required|string|max:255|unique:shipping_methodes,name|min:3')]
    public $name;

    #[Validate('required')]
    public $maxLength;

    #[Validate('required|numeric')]
    public $maxWidth;

    #[Validate('numeric')]
    public $maxHeight = '';

    #[Validate('required|numeric')]
    public $weight;

    #[Validate('required|numeric')]
    public $price;

    #[Validate('required')]
    public $option = "none";

    #[Validate('numeric|nullable')]
    public $insuranceValue = null;

    public function createShippingMethode()
    {
        $this->maxLength = toPoint($this->maxLength);
        $this->maxWidth = toPoint($this->maxWidth);
        $this->maxHeight = toPoint($this->maxHeight);
        $this->weight = toPoint($this->weight);
        $this->price = toPoint($this->price);
        
        if ($this->option === 'insurance' && is_string($this->insuranceValue)) {
            $this->insuranceValue = toPoint($this->insuranceValue);
            $this->validate([
                'insuranceValue' => 'required|numeric'
            ]);
        }

        $this->validate();
        
        ShippingMethode::create([
            'shipping_carrier_id' => $this->shippingCarrierId,
            'name' => $this->name,
            'max_length' => $this->maxLength,
            'max_width' => $this->maxWidth,
            'max_height' => $this->maxHeight,
            'weight' => $this->weight,
            'price' => $this->price,
            'option' => $this->option,
            'insurance_value' => $this->option === 'insurance' ? $this->insuranceValue : null,
        ]);

        if ($this->option === 'insurance') {
            $data['insurance_value'] = $this->insuranceValue;
        }
        
        $this->reset([
            'shippingZoneId',
            'shippingCarrierId',
            'name',
            'maxLength',
            'maxWidth',
            'maxHeight',
            'weight',
            'price',
            'option',
            'insuranceValue',
        ]);
        
        Flux::modal('create-shipping-methode')->close();
        
        $this->dispatch('reload-datatable', 'shipping-methodes-table');
    }

    public function updatedShippingZoneId()
    {
        $this->shippingCarrierId = null;
    }

    #[Computed]
    public function filteredShippingCarriers()
    {
        if (!$this->shippingZoneId) {
            return collect();
        }
        
        return ShippingCarrier::where('shipping_zone_id', $this->shippingZoneId)
            ->get();
    }

    public function with(): array
    {
        return [
            'shippingZones' => ShippingZone::all(),
        ];
    }
}; ?>

<div>
    <flux:modal name="create-shipping-methode" class="w-full">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create Methode</flux:heading>
                <flux:subheading>Make details for the methode.</flux:subheading>
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
            <flux:select wire:model.change="shippingCarrierId" label="Carrier">
                <flux:select.option value="">Choose Carrier...</flux:select.option>    
                @foreach ($this->filteredShippingCarriers as $carrier)
                    <flux:select.option value="{{ $carrier->id }}">
                        {{ $carrier->name }}
                    </flux:select.option>  
                @endforeach
            </flux:select>
            @endif

            @if ($shippingCarrierId)
                <flux:input wire:model="name" label="Name" placeholder="Name" />
                
                <flux:field>
                    <flux:input.group label="Max-length">
                        <flux:input wire:model="maxLength" placeholder="Max-length" />
                        <flux:input.group.suffix>cm</flux:input.group.suffix>
                    </flux:input.group>
                    <flux:error name="maxLength" />
                </flux:field>

                <flux:field>
                    <flux:input.group label="Max-width">
                        <flux:input wire:model="maxWidth" placeholder="Max-width" />
                        <flux:input.group.suffix>cm</flux:input.group.suffix>
                    </flux:input.group>
                </flux:field>

                <flux:field>
                    <flux:input.group label="Max-height">
                        <flux:input wire:model="maxHeight" placeholder="Max-height" />
                        <flux:input.group.suffix>cm</flux:input.group.suffix>
                    </flux:input.group>
                    <flux:error name="maxHeight" />
                </flux:field>
        
                <flux:field>
                    <flux:input.group label="Weight">
                        <flux:input wire:model="weight" placeholder="Weight" />

                        <flux:input.group.suffix>gram</flux:input.group.suffix>
                    </flux:input.group>
                    <flux:error name="weight" />
                </flux:field>
            
                <flux:field>
                    <flux:input.group label="Price">
                        <flux:input.group.prefix>€</flux:input.group.prefix>
                        <flux:input wire:model="price" placeholder="price" />
                    </flux:input.group>
                    <flux:error name="price" />
                </flux:field>
                
                <flux:field>
                    <flux:radio.group wire:model.live="option" label="Options">
                        <flux:radio value="none" label="None" checked />
                        <flux:radio value="track_and_trace" label="Track & Trace" />
                        <flux:radio value="insurance" label="Insurance" />
                    </flux:radio.group>
                    <flux:error name="option" />
                </flux:field>

                @if ($option === 'insurance')
                    <flux:input.group label="Insurance value">
                        <flux:input.group.prefix>€</flux:input.group.prefix>
                        <flux:input wire:model="insuranceValue" placeholder="Insurance value" />
                    </flux:input.group>
                @endif
            @endif

            <div class="flex">
                <flux:spacer />

                <flux:button wire:click="createShippingMethode" type="submit" variant="primary">Save</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
