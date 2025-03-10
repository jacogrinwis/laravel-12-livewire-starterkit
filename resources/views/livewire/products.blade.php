<?php

use App\Models\Product;
use Livewire\Volt\Component;

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
            'slug' => 'slug',
            'formattedPrice' => 'Price',
            'formattedSize' => 'Size',
            'formattedWeight' => 'Weight',
            'user_id' => 'user_id',
            'created_at' => 'Created',
            'updated_at' => 'Updated'
        ]"
        :searchable="[
            'name', 
            'slug', 
            'formattedPrice', 
            'formattedSize', 
            'formattedWeight', 
            'user_id', 
            'created_at', 
            'updated_at'
        ]"
        :sortable="[
            'name', 
            'slug', 
            'formattedPrice', 
            'formattedSize', 
            'formattedWeight', 
            'user_id', 
            'created_at', 
            'updated_at'
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
