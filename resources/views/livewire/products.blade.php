<?php

use App\Models\Product;
use Livewire\Volt\Component;
use App\Support\Format;

new class extends Component {
    //
}; ?>

<div>
    <livewire:product-show />
    <livewire:product-create />
    <livewire:product-edit />
    <livewire:product-delete />

    <livewire:components.data-table
        :model="App\Models\Product::class"
        :columns="[
            'name' => 'Name',
            'price' => 'Price',
            'length' => 'Size',
            'weight' => 'Weight',
            'user.name' => 'User',
            'created_at' => 'Created',
            'updated_at' => 'Updated'
        ]"
        :eagerLoad="['user']"
        :searchable="['name', 'price', 'length', 'width', 'height', 'weight', 'user_id', 'created_at', 'updated_at']"
        :sortable="['name', 'slug', 'price', 'length', 'weight', 'user_id', 'created_at', 'updated_at']"
        :formatters="[
            'price' => 'currency',
            'weight' => 'weight',
            'length' => 'size'
        ]"
        :showEvent="'show-product'"
        :showAction="true"
        :editEvent="'edit-product'"
        :deleteEvent="'delete-product'"
        :showCreateButton="true"
        :createButtonText="'Create Product'"
        :createModalName="'create-product'"
    />
</div>
