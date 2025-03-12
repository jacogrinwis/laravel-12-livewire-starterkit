<?php

use App\Models\Zone;
use Livewire\Volt\Component;

new class extends Component {
    //
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
