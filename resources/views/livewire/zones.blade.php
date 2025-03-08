<?php

use App\Models\Zone;
use Livewire\Volt\Component;

new class extends Component {

    // public function with(): array
    // {
    //     return [
    //         'zones' => Zone::all(),
    //     ];
    // }
}; ?>

<div>
    <livewire:zone-create />
    <livewire:zone-edit />
    <livewire:zone-delete />

    <livewire:components.data-table
        :model="App\Models\Zone::class"
        :columns="[
            'name' => 'Name',
            'country_code' => 'Country Code',
            'created_at' => 'Created',
            'updated_at' => 'Updated'
        ]"
        :searchable="['name', 'country_code']"
        :sortable="['name', 'country_code', 'created_at', 'updated_at']"
        :showEvent="'show-zone'"
        :showAction="false"
        :editEvent="'edit-zone'"
        :deleteEvent="'delete-zone'"
        :showCreateButton="true"
        :createButtonText="'Create Zone'"
        :createModalName="'create-zone'"
    />
</div>

{{-- <div class="max-w-7xl space-y-5">
    <div class="flex justify-end">
        <flux:modal.trigger name="create-zone" class="w-full">
            <flux:button variant="primary" class="w-full sm:w-auto">Create Zone</flux:button>
        </flux:modal.trigger>
    </div>

    <livewire:zone-create />
    
    <div class=" @container">
        <div class="grid @lg:grid-cols-2 @4xl:grid-cols-3 gap-3">
            @foreach ($zones as $zone)
                <x-card>
                    <div class="flex gap-3">
                        <div class="flex gap-2 grow">
                            <flux:icon name="flag" variant="mini" class="shrink-0 mt-0.5 inline-block fill-zinc-400 dark:fill-zinc-400" />
                            <div>
                                <flux:heading size="lg">{{ $zone->name }}</flux:heading>
                                <flux:subheading>{{ $zone->country_code }}</flux:subheading>
                            </div>
                        </div>
                        <div>
                            <flux:dropdown position="left" align="center">
                                <flux:button icon-trailing="ellipsis-horizontal"></flux:button>
                                <flux:menu>
                                    <flux:menu.item icon="pencil">Edit</flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger">Delete</flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>
    </div>
</div> --}}
