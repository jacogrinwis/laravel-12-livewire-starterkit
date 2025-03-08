<?php
 
use App\Models\Zone;
use Livewire\Volt\Component;
use Livewire\Attributes\Rule;
 
new class extends Component
{
    #[Rule(['required', 'unique:zones', 'min:3', 'max:250'])]
    public string $name = '';
 
    #[Rule(['required', 'max:2'])]
    public string $countryCode = '';
 
    public function save() {
        $this->validate();
 
        Zone::create([
            'name' => $this->name,
            'country_code' => $this->countryCode,
        ]);
 
        $this->reset(['name', 'countryCode']);

        Flux::modal('create-zone')->close();

        $this->dispatch('reload-datatable', 'zones-table');
    }
}
?>

<flux:modal name="create-zone" class="w-full">
    <form wire:submit="save">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create Zone</flux:heading>
                <flux:subheading>Make details for the zone.</flux:subheading>
            </div>

            <flux:input wire:model="name" label="Name" placeholder="Name" />

            <flux:input wire:model="countryCode" label="Country Code" placeholder="Country Code" />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Save</flux:button>
            </div>
        </div>
    </form>
</flux:modal>
