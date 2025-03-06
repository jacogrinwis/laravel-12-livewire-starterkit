<?php

use Livewire\Volt\Component;

new class extends Component {
    public string $name = "";
    public string $code = "";
}; ?>

<div>
    <livewire:shipping-zone-create />
    <livewire:shipping-zone-edit />
    <livewire:shipping-zone-delete />

    <livewire:components.data-table
        :model="App\Models\ShippingZone::class"
        :columns="[
            'name' => 'Name',
            'code' => 'Code',
            'created_at' => 'Created',
            'updated_at' => 'Updated'
        ]"
        :searchable="['name', 'code']"
        :sortable="['name', 'code', 'created_at', 'updated_at']"
        :showEvent="'show-shipping-zone'"
        :showAction="false"
        :editEvent="'edit-shipping-zone'"
        :deleteEvent="'delete-shipping-zone'"
        :showCreateButton="true"
        :createButtonText="'Create Shipping Zone'"
        :createModalName="'create-shipping-zone'"
    />
</div>
