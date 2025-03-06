<?php
// Import the necessary classes for the component
use Livewire\Volt\Component; // Volt is Laravel's newer approach to Livewire components
use App\Models\Post; // Import the Post model to interact with the posts database table
use Illuminate\Support\Str;

// Define an anonymous Volt component class that handles post creation functionality
new class extends Component {
    // Public properties that are bound to form inputs through wire:model
    public $title; // Stores the post title from user input
    public $slug;  // Stores the post slug for SEO-friendly URLs
    public $body;  // Stores the post body content from user input

    /**
     * Generate a slug from the current title value
     */
    public function generateSlug()
    {
        if ($this->title) {
            $this->slug = Str::slug($this->title);
        }
    }
    
    /**
     * Method triggered when the user submits the post creation form
     * Handles validation, database insertion, form reset, and UI updates
     */
    public function createPost()
    {
        // Validate all input fields before proceeding with database operations
        $this->validate([
            'title' => 'required', // Title must not be empty
            'slug' => 'required|unique:posts,slug', // Slug must be provided and unique in the posts table
            'body' => 'required',  // Body content must not be empty
        ]);
        
        // Create a new post record in the database with validated data
        Post::create([
            'title' => $this->title, // Set the post title
            'slug' => Str::slug($this->slug),   // Set the URL-friendly slug
            'body' => $this->body,   // Set the post content
        ]);
        
        // Reset all form fields to empty after successful submission
        $this->reset(['title', 'slug', 'body']);
        
        // Close the modal dialog after form submission is complete
        Flux::modal('create-post')->close();
        
        // Dispatch an event to reload the posts datatable elsewhere in the application
        // This ensures the newly created post appears in the list without a page refresh
        $this->dispatch('reload-datatable', 'posts-table');
    }
};
?>

<!-- HTML template for the create post form -->
<div>
    <!-- Modal component using Flux UI library with a specific name for targeting -->
    <flux:modal name="create-post" class="w-full">
        <div class="space-y-6">
            <!-- Header section with title and instructional subheading -->
            <div>
                <flux:heading size="lg">Create Post</flux:heading>
                <flux:subheading>Make details for the post.</flux:subheading>
            </div>

            <!-- Input field for post title with two-way data binding -->
            <flux:input wire:model="title" label="Title" placeholder="Your title" />

            <!-- Input field for post slug with two-way data binding 
                 The slug is used for SEO-friendly URLs -->
            <flux:field>
                <flux:label>Slug</flux:label>
                {{-- <flux:description>A URL-friendly version of the title that will be used in the post's web address. Contains only lowercase letters, numbers, and hyphens.</flux:description> --}}
                <flux:input.group>
                    <flux:input wire:model="slug" placeholder="Your slug" />

                    <flux:button wire:click="generateSlug" icon="link">Generate</flux:button>
                </flux:input.group>
                <flux:description>URL-friendly version of the title used in web addresses with lowercase letters, numbers, and hyphens.</flux:description>
            </flux:field>

            <!-- Textarea for post body/content with two-way data binding -->
            <flux:textarea wire:model="body" label="Body" placeholder="Your body" />

            <!-- Footer section containing the submit button -->
            <div class="flex">
                <flux:spacer /> <!-- Pushes the button to the right side -->

                <!-- Submit button that triggers the createPost method when clicked
                     Uses primary styling for emphasis -->
                <flux:button wire:click="createPost" type="submit" variant="primary">Save</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
