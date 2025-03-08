<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\Carrier;

new class extends Component {
    public string $carrierId;

    #[On('delete-carrier')]
    public function confirmDelete($id)
    {
        $this->carrierId = $id;

        Flux::modal('delete-carrier')->show();
    }

    public function destroy()
    {
        Carrier::find($this->carrierId)->delete();

        Flux::modal('delete-carrier')->close();

         $this->dispatch('reload-datatable', 'shipping-table');
    }
}; ?>

<div>
    <flux:modal name="delete-carrier" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Carrier?</flux:heading>

                <flux:subheading>
                    <p>You're about to delete this carrier.</p>
                    <p>This action cannot be reversed.</p>
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button wire:click="destroy" type="submit" variant="danger">Delete carrier</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
