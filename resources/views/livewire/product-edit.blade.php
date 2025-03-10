<?php
 
use App\Models\Product;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Illuminate\Validation\Rule as ValidationRule;
use Livewire\Attributes\Validate;
 
new class extends Component
{
    public string $product_id;
    public string $user_id;
    public string $name;
    public string $slug;
    public ?string $description;
    public string $price;
    public string $length;
    public string $width;
    public ?string $height = null;
    public ?string $weight = null;

    public function rules()
    {
        return [
            'product_id' => 'required',
            'user_id' => 'required',
            'name' => [
                'required',
                'min:3',
                'max:250', 
                ValidationRule::unique('products')->ignore($this->product_id), 
            ],
            'slug' => [
                'required',
                'min:3',
                'max:250', 
                ValidationRule::unique('products')->ignore($this->product_id), 
            ], 
            'description' => 'nullable',
            'price' => 'required',
            'length' => 'required',
            'width' => 'required',
            'height' => 'nullable',
            'weight' => 'nullable',
        ];
    }

    #[On('edit-product')]
    public function edit($id)
    {
        $product = Product::find($id);

        $this->product_id = $id;
        $this->user_id = $product->user_id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->length = $product->length;
        $this->width = $product->width;
        $this->height = $product->height;
        $this->weight = $product->weight;

        Flux::modal('edit-product')->show();
    }

    public function update() {
        $this->validate($this->rules());

        $this->length = toPoint($this->length);
        $this->width = toPoint($this->width);
        $this->height = toPoint($this->height);
        $this->weight = toPoint($this->weight);
        $this->price = toPoint($this->price);

        $product = Product::find($this->product_id);
        $product->user_id = $this->user_id;
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->length = $this->length;
        $product->width = $this->width;
        $product->height = $this->height;
        $product->weight = $this->weight;
        $product->save();
 
        $this->reset(['name', 'slug', 'description', 'price', 'length', 'width', 'height', 'weight']);

        Flux::modal('edit-product')->close();

        $this->dispatch('reload-datatable', 'products-table');
    }

    public function generateSlug()
    {
        if ($this->name) {
            $this->slug = Str::slug($this->name);
        }
    }
}; ?>

<flux:modal name="edit-product" class="w-full">
    <form wire:submit="update">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Product</flux:heading>
                <flux:subheading>Make details for the product.</flux:subheading>
            </div>

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

                <flux:button type="submit" variant="primary">Update</flux:button>
            </div>
        </div>
    </form>
</flux:modal>
