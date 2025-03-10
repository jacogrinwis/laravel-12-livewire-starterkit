<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\Method;

new class extends Component {
    public string $methodId;

    #[On('delete-method')]
    public function confirmDelete($id)
    {
        $this->methodId = $id;

        Flux::modal('delete-method')->show();
    }

    public function destroy()
    {
        Method::find($this->methodId)->delete();

        Flux::modal('delete-method')->close();

         $this->dispatch('reload-datatable', 'shipping-table');
    }
}; ?>

<div>
    <flux:modal name="delete-method" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Method?</flux:heading>

                <flux:subheading>
                    <p>You're about to delete this method.</p>
                    <p>This action cannot be reversed.</p>
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button wire:click="destroy" type="submit" variant="danger">Delete method</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
