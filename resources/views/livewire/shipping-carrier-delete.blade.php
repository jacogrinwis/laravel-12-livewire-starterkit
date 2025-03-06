<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\ShippingCarrier;

new class extends Component {
    public string $shippingCarrierId;

    #[On('delete-shipping-carrier')]
    public function confirmDelete($id)
    {
        $this->shippingCarrierId = $id;

        Flux::modal('delete-shipping-carrier')->show();
    }

    #[On('destroy-shipping-carrier')]
    public function destroyPost()
    {
        ShippingCarrier::find($this->shippingCarrierId)->delete();

        Flux::modal('delete-shipping-carrier')->close();

         $this->dispatch('reload-datatable', 'shipping-carrier-table');
    }
}; ?>

<div>
    <flux:modal name="delete-shipping-carrier" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Shipping Carrier?</flux:heading>

                <flux:subheading>
                    <p>You're about to delete this shipping carrier.</p>
                    <p>This action cannot be reversed.</p>
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button wire:click="destroyPost" type="submit" variant="danger">Delete carrier</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
