<?php

use App\Models\Post;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Str;

new class extends Component {
    public $title;
    public $slug;
    public $body;
    public $postId;

    public function generateSlug()
    {
        if ($this->title) {
            $this->slug = Str::slug($this->title);
        }
    }

    #[On('edit-post')]
    public function editPost($id)
    {
        $post = Post::find($id);

        $this->postId = $id;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->body = $post->body;

        Flux::modal('edit-post')->show();
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug',
            'body' => 'required',
        ]);

        $post = Post::find($this->postId);
        $post->title = $this->title;
        $post->slug = Str::slug($this->slug);
        $post->body = $this->body;
        $post->save();

        Flux::modal('edit-post')->close();

        $this->dispatch('reload-datatable', 'posts-table');
    }
}; ?>

<div>
    <flux:modal name="edit-post" class="w-full">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Post</flux:heading>
                <flux:subheading>Edit details for the post.</flux:subheading>
            </div>

            <flux:input wire:model="title" label="Title" placeholder="Your title" />
            
            <flux:field>
                <flux:label>Slug</flux:label>
                <flux:input.group>
                    <flux:input wire:model="slug" placeholder="Your slug" />

                    <flux:button wire:click="generateSlug" icon="link">Generate</flux:button>
                </flux:input.group>
                <flux:description>URL-friendly version of the title used in web addresses with lowercase letters, numbers, and hyphens.</flux:description>
            </flux:field>

            <flux:textarea wire:model="body" label="Body" placeholder="Your body" />

            <div class="flex">
                <flux:spacer />

                <flux:button wire:click="update" type="submit" variant="primary">Update</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
