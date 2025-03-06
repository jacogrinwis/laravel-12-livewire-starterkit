<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <livewire:shipping-carrier-create />
    <livewire:shipping-carrier-edit />
    <livewire:shipping-carrier-delete />

    <livewire:components.data-table
        :model="App\Models\ShippingCarrier::class"
        :columns="[
            'name' => 'Name',
            'shipping_zone_name' => 'Zone',
            'shipping_zone_code' => 'Code',
            'created_at' => 'Created',
            'updated_at' => 'Updated'
        ]"
        :searchable="['name', 'shipping_zone_name', 'shipping_zone_code']"
        :sortable="['name', 'shipping_zone_name', 'shipping_zone_code', 'created_at', 'updated_at']"
        :showEvent="'show-shipping-carrier'"
        :showAction="false"
        :editEvent="'edit-shipping-carrier'"
        :deleteEvent="'delete-shipping-carrier'"
        :showCreateButton="true"
        :createButtonText="'Create Carier'"
        :createModalName="'create-shipping-carrier'"
    />
</div>
