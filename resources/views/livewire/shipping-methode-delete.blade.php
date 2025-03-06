<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\ShippingMethode;

new class extends Component {
    public string $shippingMethodeId;

    #[On('delete-shipping-methode')]
    public function confirmDelete($id)
    {
        $this->shippingMethodeId = $id;

        Flux::modal('delete-shipping-methode')->show();
    }

    #[On('destroy-shipping-methode')]
    public function destroy()
    {
        ShippingMethode::find($this->shippingMethodeId)->delete();

        Flux::modal('delete-shipping-methode')->close();

         $this->dispatch('reload-datatable', 'shipping-methode-table');
    }
}; ?>

<div>
    <flux:modal name="delete-shipping-methode" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Shipping Methode?</flux:heading>

                <flux:subheading>
                    <p>You're about to delete this shipping methode.</p>
                    <p>This action cannot be reversed.</p>
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button wire:click="destroy" type="submit" variant="danger">Delete methode</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
