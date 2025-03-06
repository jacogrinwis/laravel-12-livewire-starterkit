<?php

use App\Models\Post;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

new class extends Component {
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function edit($id)
    {
        $this->dispatch('edit-post', $id);
    }

    public function delete($id)
    {
        $this->dispatch('delete-post', $id);
    }
    
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        
        $this->resetPage();
    }

    #[On('reload-posts')]
    public function refreshPosts() {}

    #[Computed]
    public function showPosts() {
        return Post::where(function($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('body', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
    }
}; ?>

<div>
    <livewire:post-create />
    <livewire:post-edit />
    <livewire:post-delete />

    <livewire:components.data-table
        :model="App\Models\Post::class"
        :columns="[
            'title' => 'Title',
            'body' => 'Body',
            'slug' => 'Slug',
            'created_at' => 'Created',
            'updated_at' => 'Updated'
        ]"
        :searchable="['title', 'body']"
        :sortable="['title', 'body', 'created_at', 'updated_at']"
        :showEvent="'show-post'"
        :showAction="false"
        :editEvent="'edit-post'"
        :deleteEvent="'delete-post'"
        :showCreateButton="true"
        :createButtonText="'Create Post'"
        :createModalName="'create-post'"
    />
</div>
