<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\Zone;

new class extends Component {
    public string $zoneId;

    #[On('delete-zone')]
    public function confirmDelete($id)
    {
        $this->zoneId = $id;

        Flux::modal('delete-zone')->show();
    }

    public function destroy()
    {
        Zone::find($this->zoneId)->delete();

        Flux::modal('delete-zone')->close();

         $this->dispatch('reload-datatable', 'shipping-table');
    }
}; ?>

<div>
    <flux:modal name="delete-zone" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Zone?</flux:heading>

                <flux:subheading>
                    <p>You're about to delete this zone.</p>
                    <p>This action cannot be reversed.</p>
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button wire:click="destroy" type="submit" variant="danger">Delete zone</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
