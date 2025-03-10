<?php

use \App\Models\User;
use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <livewire:user-create />
    <livewire:user-edit />
    <livewire:user-delete />

    <livewire:components.data-table
        :model="App\Models\User::class"
        :columns="[
            'name' => 'Name',
            'email' => 'Email',
            'role' => 'Role',
            'created_at' => 'Created',
            'updated_at' => 'Updated'
        ]"
        :searchable="['name', 'email', 'role']"
        :sortable="['name', 'email', 'role', 'created_at', 'updated_at']"
        :showEvent="'show-user'"
        :showAction="false"
        :editEvent="'edit-user'"
        :deleteEvent="'delete-user'"
        :showCreateButton="true"
        :createButtonText="'Create Zone'"
        :createModalName="'create-user'"
    />
</div>
