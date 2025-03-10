<?php
 
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Illuminate\Validation\Rule as ValidationRule;
use Livewire\Attributes\Validate;
 
new class extends Component
{
    // public string $product_id;
    public string $user_id;
    public string $name;
    public string $slug;
    public ?string $description;
    public string $price;
    public string $length;
    public string $width;
    public ?string $height = null;
    public string $weight;

    public function rules()
    {
        return [
            // 'product_id' => 'required',
            'user_id' => 'required',
            'name' => [
                'required',
                'min:3',
                'max:250', 
                ValidationRule::unique('products'), 
            ], 
            'description' => 'nullable',
            'price' => 'required',
            'length' => 'required',
            'width' => 'required',
            'height' => 'nullable',
            'weight' => 'nullable',
        ];
    }
 
    public function save() {
        $this->validate();
 
        Product::create([
            // 'product_id' => $this->product_id,
            'user_id' => Auth::id(),
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'weight' => $this->weight,
        ]);
 
        $this->reset(['name', 'slug', 'description', 'price', 'length', 'width', 'height', 'weight']);

        Flux::modal('create-product')->close();

        $this->dispatch('reload-datatable', 'products-table');
    }

    public function generateSlug()
    {
        if ($this->name) {
            $this->slug = Str::slug($this->name);
        }
    }
}
?>

<flux:modal name="create-product" class="w-full">
    <form wire:submit="save">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create Product</flux:heading>
                <flux:subheading>Make details for the product.</flux:subheading>
            </div>

            <flux:input wire:model="user_id" label="User ID" placeholder="User ID" />

            <flux:input wire:model="name" label="Name" placeholder="Name" />

            <flux:field>
                <flux:label>Slug</flux:label>
                <flux:input.group>
                    <flux:input wire:model="slug" placeholder="Your slug" />

                    <flux:button wire:click="generateSlug" icon="link">Generate</flux:button>
                </flux:input.group>
                <flux:description>URL-friendly version of the title used in web addresses with lowercase letters, numbers, and hyphens.</flux:description>
            </flux:field>

            <flux:textarea wire:model="description" label="Description" placeholder="Description" />

            <flux:input wire:model="price" label="Price" placeholder="Price" />

            <flux:input wire:model="length" label="length" placeholder="length" />

            <flux:input wire:model="width" label="width" placeholder="width" />

            <flux:input wire:model="height" label="height" placeholder="height" />

            <flux:input wire:model="weight" label="weight" placeholder="weight" />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Save</flux:button>
            </div>
        </div>
    </form>
</flux:modal>
