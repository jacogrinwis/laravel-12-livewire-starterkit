<?php

use \App\Models\Method;
use Livewire\Volt\Component;

new class extends Component {
    public $methods;

// public function with()
// {
//     $this->methods = Method::with(['carrier', 'zone'])->get();
// }
}; ?>

<div>
    <livewire:method-create />
    <livewire:method-edit />
    <livewire:method-delete />

    <livewire:components.data-table
        :model="App\Models\Method::class"
        :eagerLoad="['carrier', 'zone']" 
        :columns="[
            'name' => 'Name',
            'carrier.name' => 'Carrier',
            'zone.name' => 'Zone', 
            'formattedPrice' => 'Price',
            'formattedMinSize' => 'Min Size',
            'formattedMaxSize' => 'Max Size',
            'options' => 'Options',
            'formattedInsuranceValue' => 'Insurance Value',
            'created_at' => 'Created',
            'updated_at' => 'Updated'
        ]"
        :searchable="['name', 'carrierName', 'zoneName', 'price', 'options', 'insurance_value']"
        :sortable="['name', 'carrierName', 'zoneName', 'price', 'options', 'insurance_value', 'created_at', 'updated_at']"
        :showEvent="'show-method'"
        :showAction="false"
        :editEvent="'edit-method'"
        :deleteEvent="'delete-method'"
        :showCreateButton="true"
        :createButtonText="'Create Method'"
        :createModalName="'create-method'"
    />
</div>
