<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use App\Models\Post;

new class extends Component {
    public string $postId;

    #[On('delete-post')]
    public function confirmDelete($id)
    {
        $this->postId = $id;

        Flux::modal('delete-post')->show();
    }

    #[On('destroy-post')]
    public function destroyPost()
    {
        Post::find($this->postId)->delete();

        Flux::modal('delete-post')->close();

        // $this->dispatch('reload-posts');
        $this->dispatch('reload-datatable', 'posts-table');
    }
}; ?>

<div>
    <flux:modal name="delete-post" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete post?</flux:heading>

                <flux:subheading>
                    <p>You're about to delete this post.</p>
                    <p>This action cannot be reversed.</p>
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button wire:click="destroyPost" type="submit" variant="danger">Delete post</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
