<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\ShippingZone;

new class extends Component {
    public string $shippingZoneId;

    #[On('delete-shipping-zone')]
    public function confirmDelete($id)
    {
        $this->shippingZoneId = $id;

        Flux::modal('delete-shipping-zone')->show();
    }

    #[On('destroy-shipping-zone')]
    public function destroyPost()
    {
        ShippingZone::find($this->shippingZoneId)->delete();

        Flux::modal('delete-shipping-zone')->close();

         $this->dispatch('reload-datatable', 'shipping-zone-table');
    }
}; ?>

<div>
    <flux:modal name="delete-shipping-zone" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Shipping Zone?</flux:heading>

                <flux:subheading>
                    <p>You're about to delete this shipping zone.</p>
                    <p>This action cannot be reversed.</p>
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button wire:click="destroyPost" type="submit" variant="danger">Delete zone</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
