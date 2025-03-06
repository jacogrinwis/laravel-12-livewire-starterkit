<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <livewire:shipping-methode-create />
    <livewire:shipping-methode-edit />
    <livewire:shipping-methode-delete />

    <livewire:components.data-table
        :model="App\Models\ShippingMethode::class"
        :columns="[
            'shipping_zone_name' => 'Zone',
            'shipping_carrier_name' => 'Carrier',
            'name' => 'Name',
            'formatted_max_size' => 'Max-size',
            'formatted_weight' => 'Weight',
            'formatted_price' => 'Price',
            'option' => 'Option',
            'formatted_insurance_value' => 'Insurance value',
            'created_at' => 'Created',
            'updated_at' => 'Updated'
        ]"
        :searchable="[
            'shipping_zone_name',
            'shipping_carrier_name',
            'name',
            'max_length',
            'max_width',
            'max_height',
            'weight',
            'price',
            'option',
            'insurance_value',
        ]"
        :sortable="[
            'shipping_zone_name',
            'shipping_carrier_name',
            'name',
            'max_length',
            'max_width',
            'max_height',
            'weight',
            'price',
            'option',
            'insurance_value',
            'created_at',
            'updated_at',
        ]"
        :showEvent="'show-shipping-methode'"
        :showAction="false"
        :editEvent="'edit-shipping-methode'"
        :deleteEvent="'delete-shipping-methode'"
        :showCreateButton="true"
        :createButtonText="'Create Methode'"
        :createModalName="'create-shipping-methode'"
    />
</div>
