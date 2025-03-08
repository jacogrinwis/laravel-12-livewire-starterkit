<?php

use App\Models\Method;
use App\Models\Carrier;
use App\Models\Zone;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;

new class extends Component {
    // #[Rule(['required'])]
    // public float $zone_id;

    // #[Rule(['required'])]
    // public float $carrier_id;

    // #[Rule(['required', 'min:3', 'max:250'])]
    // public string $name;

    // #[Rule(['nullable'])]
    // public ?string $min_length;

    // #[Rule(['required'])]
    // public string $max_length;

    // #[Rule(['nullable'])]
    // public ?string $min_width;

    // #[Rule(['required'])]
    // public string $max_width;

    // #[Rule(['nullable'])]
    // public ?string $min_height;

    // #[Rule(['nullable'])]
    // public ?string $max_height;

    // #[Rule(['nullable'])]
    // public ?string $min_weight;

    // #[Rule(['required'])]
    // public string $max_weight;

    // #[Rule(['required'])]
    // public string $price;

    // #[Rule(['required'])]
    // public string $options = 'none';

    // #[Rule(['nullable'])]
    // public ?string $insurance_value = null;
    
    // #[Rule(['required', 'numeric'])]
    // public float $methodId;

    public float $zone_id;
    public float $carrier_id;
    public float $method_id;
    public string $name;
    public string $min_length = '';
    public string $max_length;
    public string $min_width = '';
    public string $max_width;
    public string $min_height = '';
    public string $max_height = '';
    public string $min_weight = '';
    public string $max_weight = '';
    public string $price;

    #[Rule(['required'])]
    public string $options = 'none';

    #[Rule(['nullable'])]
    public ?string $insurance_value = null;

    public function rules()
    {
        $rules = [
            'zone_id' => 'required',
            'carrier_id' => 'required',
            'method_id' => 'required',
            'name' => 'required|min:3|max:250',
            'min_length' => 'nullable',
            'max_length' => 'required',
            'min_width' => 'nullable',
            'max_width' => 'required',
            'min_height' => 'nullable',
            'max_height' => 'nullable',
            'min_weight' => 'nullable',
            'max_weight' => 'required',
            'price' => 'required',
            'options' => 'required'
        ];

        if ($this->options === 'insurance') {
            $rules['insurance_value'] = 'required';
        } else {
            $rules['insurance_value'] = 'nullable';
        }

        return $rules;
    }

    #[On('edit-method')]
    public function edit($id)
    {
        $method = Method::find($id);

        $this->method_id = $id;
        $this->zone_id = $method->zone_id;
        $this->carrier_id = $method->carrier_id;
        $this->name = $method->name;
        $this->min_length = $method->min_length;
        $this->max_length = $method->max_length;
        $this->min_width = $method->min_width;
        $this->max_width = $method->max_width;
        $this->min_height = $method->min_height;
        $this->max_height = $method->max_height;
        $this->min_weight = $method->min_weight;
        $this->max_weight = $method->zone_id;
        $this->price = $method->price;
        $this->options = $method->options;
        $this->insurance_value = $method->insurance_value;

        Flux::modal('edit-method')->show();
    }

    public function update() {
        $this->validate($this->rules());

        $this->min_length = toPoint($this->min_length);
        $this->min_width = toPoint($this->min_width);
        $this->min_height = toPoint($this->min_height);
        $this->max_length = toPoint($this->max_length);
        $this->max_width = toPoint($this->max_width);
        $this->max_height = toPoint($this->max_height);
        $this->min_weight = toPoint($this->min_weight);
        $this->max_weight = toPoint($this->max_weight);
        $this->price = toPoint($this->price);
        $this->insurance_value = toPoint($this->insurance_value);

        // if ($this->options === 'insurance' && is_string($this->insurance_value)) {
        //     $this->insurance_value = toPoint($this->insurance_value);
        //     $this->validate([
        //         'insurance_value' => 'required|numeric'
        //     ]);
        // }
 
        $method = Method::find($this->method_id);
        $method->zone_id = $this->zone_id;
        $method->carrier_id = $this->carrier_id;
        $method->name = $this->name;
        $method->min_length = $this->min_length;
        $method->max_length = $this->max_length;
        $method->min_width = $this->min_width;
        $method->max_width = $this->max_width;
        $method->min_height = $this->min_height;
        $method->max_height = $this->max_height;
        $method->min_weight = $this->min_weight;
        $method->max_weight = $this->max_weight;
        $method->price = $this->price;
        $method->options = $this->options;
        $method->insurance_value = $this->insurance_value;
        $method->save();
 
        $this->reset(['name', 'min_length', 'max_length', 'min_width', 'max_width', 'min_height', 'max_height', 'min_weight', 'max_weight', 'price', 'options', 'insurance_value']);

        Flux::modal('edit-method')->close();

        $this->dispatch('reload-datatable', 'methods-table');
    }

    public function updatedOptions()
    {
        if ($this->options !== 'insurance') {
            $this->insurance_value = null;
        }
    }

    public function with(): array 
    {
        return [
            'carriers' => Carrier::all(),
            'zones' => Zone::all(),
        ];
    }
}; ?>

<flux:modal name="edit-method" class="w-full">
    <form wire:submit="update" class="space-y-6">
        <div>
            <flux:heading size="lg">Edit Carrier</flux:heading>
            <flux:subheading>Make details for the carrier.</flux:subheading>
        </div>

        <flux:select wire:model="carrier_id" label="Carrier" placeholder="Choose carrier...">
            <flux:select.option value="">Choose Carrier...</flux:select.option>
            @foreach ($carriers as $carrier)
                <flux:select.option value="{{ $carrier->id }}">{{ $carrier->name }}</flux:select.option>
            @endforeach
        </flux:select>

        <flux:radio.group wire:model.live="zone_id" label="Select your zone">
            @foreach ($zones as $zone)
                <flux:radio value="{{ $zone->id }}" label="{{ $zone->name }}" />
            @endforeach
        </flux:radio.group>

        <flux:input wire:model="name" label="Name" placeholder="Name" />

        <div class="flex gap-3">
            <flux:input wire:model="min_length" label="min-length" placeholder="min-length" />
            <flux:input wire:model="min_width" label="min-width" placeholder="min-width" />
            <flux:input wire:model="min_height" label="min-height" placeholder="min-height" />
        </div>

        <div class="flex gap-3">
            <flux:input wire:model="max_length" label="max-length" placeholder="max-length" />
            <flux:input wire:model="max_width" label="max-width" placeholder="max-width" />
            <flux:input wire:model="max_height" label="max-height" placeholder="max-height" />
        </div>

        <div class="flex gap-3">
            <flux:input wire:model="min_weight" label="min-weight" placeholder="min-weight" />
            <flux:input wire:model="max_weight" label="max-weight" placeholder="max-weight" />
        </div>

        <flux:input wire:model="price" label="price" placeholder="price" />

        <flux:radio.group wire:model.live="options" label="Select your option">
            <flux:radio value="none" label="None" checked />
            <flux:radio value="track&trace" label="Track & Trace" />
            <flux:radio value="insurance" label="Insurance Value" />
        </flux:radio.group>

        @if ($options === 'insurance')
            <flux:input wire:model="insurance_value" label="insurance value" placeholder="insurance value" />
        @endif

        <div class="flex">
            <flux:spacer />

            <flux:button type="submit" variant="primary">Update</flux:button>
        </div>
    </form>
</flux:modal>

