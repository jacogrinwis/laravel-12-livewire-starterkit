<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <livewire:carrier-create />
    <livewire:carrier-edit />
    <livewire:carrier-delete />

    <livewire:components.data-table
        :model="App\Models\Carrier::class"
        :columns="[
            'name' => 'Name',
            'created_at' => 'Created',
            'updated_at' => 'Updated'
        ]"
        :searchable="['name']"
        :sortable="['name', 'created_at', 'updated_at']"
        :showEvent="'show-carrier'"
        :showAction="false"
        :editEvent="'edit-carrier'"
        :deleteEvent="'delete-carrier'"
        :showCreateButton="true"
        :createButtonText="'Create Carrier'"
        :createModalName="'create-carrier'"
    />
</div>
