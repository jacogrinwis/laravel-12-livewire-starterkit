<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Method;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Illuminate\Validation\Rule as ValidationRule;
use Livewire\Attributes\Validate;

new class extends Component {
    public string $product_id;
    public string $user_name;
    public string $name;
    public string $slug;
    public ?string $description;
    public string $price;
    public string $length;
    public string $width;
    public ?string $height = null;
    public string $size;
    public ?string $weight = null;
    public $available_methods;
    public string $zone_id = '1';

    #[On('show-product')]
    public function show($id)
    {
        $product = Product::find($id);
        $user = User::find($product->user_id);

        $this->product_id = $id;
        $this->user_name = $user->name;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->length = $product->length;
        $this->width = $product->width;
        $this->height = $product->height;
        $this->size = $product->formattedSize;
        $this->weight = $product->weight;

        $query = Method::where('zone_id', $this->zone_id);

        // Only apply length constraints if min_length exists
        $query->where(function($q) use ($product) {
            $q->whereNull('min_length')
            ->orWhere('min_length', '<=', $product->length);
        })
        ->where('max_length', '>=', $product->length);

        // Only apply width constraints if min_width exists
        $query->where(function($q) use ($product) {
            $q->whereNull('min_width')
            ->orWhere('min_width', '<=', $product->width);
        })
        ->where('max_width', '>=', $product->width);

        // Only apply weight constraints if min_weight exists
        $query->where(function($q) use ($product) {
            $q->whereNull('min_weight')
            ->orWhere('min_weight', '<=', $product->weight);
        })
        ->where('max_weight', '>=', $product->weight);

        // Only apply height constraints if product height exists
        if ($product->height !== null && $product->height !== '') {
            $query->where(function($q) use ($product) {
                $q->whereNull('min_height')
                ->orWhere('min_height', '<=', $product->height);
            })
            ->where(function($q) use ($product) {
                $q->whereNull('max_height')
                ->orWhere('max_height', '>=', $product->height);
            });
        }

        $this->available_methods = $query->get();

        Flux::modal('show-product')->show();
    }
}; ?>

<flux:modal name="show-product" class="w-full">
    <div class="space-y-6 text-sm">
        <div>
            <flux:heading size="lg">{{ $name }}</flux:heading>
            <flux:subheading>/{{ $slug }}</flux:subheading>
        </div>
        <p class="text-sm text-zinc-500 dark:text-zinc-400 font-medium">Publish by {{ $user_name }} - #{{ $product_id }}</p>
        <p>{{ $description }}</p>
        <div>
            <p class="text-sm font-medium mb-2">Details:</p>
            <ul class="list-disc list-inside text-zinc-500 dark:text-zinc-400 font-medium">
                <li>Size:  {{ $size }}</li>
                <li>Weight:  {{ $weight }} g</li>
            </ul>
        </div>
        <p class="text-lg text-right">€ {{ $price }}</p>
        @if ($available_methods)
        <p class="text-sm font-medium mb-2">Shippin method:</p>
            @foreach ($available_methods as $method)
                <x-card 
                    icon="truck" 
                    name="{{ $method->name }}" 
                    description="{{ $method->formattedMaxSize }} - {{ $method->price }}"
                    class="dark:bg-zinc-700!"
                >
                </x-card>
            @endforeach
        @else
            NO {{ $available_methods}}
        @endif
    </div>
</flux:modal>
