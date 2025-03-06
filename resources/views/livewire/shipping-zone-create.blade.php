<?php

use Livewire\Volt\Component;
use App\Models\ShippingZone;

new class extends Component {
    public $name;
    public $code;

    public function createShippingZone()
    {
        $this->validate([
            'name' => 'required',
            'code' => 'required', 
        ]);
        
        ShippingZone::create([
            'name' => $this->name,
            'code' => $this->code,
        ]);
        
        $this->reset(['name', 'code']);
        
        Flux::modal('create-shipping-zone')->close();
        
        $this->dispatch('reload-datatable', 'shipping-zone-table');
    }
}; ?>

<div>
    <flux:modal name="create-shipping-zone" class="w-full">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create Zone</flux:heading>
                <flux:subheading>Make details for the zone.</flux:subheading>
            </div>

            <flux:input wire:model="name" label="Name" placeholder="Your name" />

            <flux:input wire:model="code" label="Code" placeholder="Your code" />

            <div class="flex">
                <flux:spacer />

                <flux:button wire:click="createShippingZone" type="submit" variant="primary">Save</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
