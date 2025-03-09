<?php
 
use App\Models\Method;
use App\Models\Carrier;
use App\Models\Zone;
use Livewire\Volt\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule as ValidationRule;
 
new class extends Component
{
    // public float $zone_id;
    // public float $carrier_id;
    // public string $name;
    // public string $min_length = '';
    // public string $max_length;
    // public string $min_width = '';
    // public string $max_width;
    // public string $min_height = '';
    // public string $max_height = '';
    // public string $min_weight = '';
    // public string $max_weight = '';
    // public string $price;

    // #[Rule(['required'])]
    // public string $options = 'none';

    // #[Rule(['nullable'])]
    // public ?string $insurance_value = null;

    // public function rules()
    // {
    //     $rules = [
    //         'zone_id' => 'required',
    //         'carrier_id' => 'required',
    //         'name' => 'required|unique:methods|min:3|max:250',
    //         'min_length' => 'nullable',
    //         'max_length' => 'required',
    //         'min_width' => 'nullable',
    //         'max_width' => 'required',
    //         'min_height' => 'nullable',
    //         'max_height' => 'nullable',
    //         'min_weight' => 'nullable',
    //         'max_weight' => 'required',
    //         'price' => 'required',
    //         'options' => 'required'
    //     ];

    //     if ($this->options === 'insurance') {
    //         $rules['insurance_value'] = 'required|numeric';
    //     } else {
    //         $rules['insurance_value'] = 'nullable';
    //     }

    //     return $rules;
    // }

    public float $zone_id;
    public float $carrier_id;
    public string $name;
    public ?string $min_length = null;
    public string $max_length;
    public ?string $min_width = null;
    public string $max_width;
    public ?string $min_height = null;
    public ?string $max_height = null;
    public ?string $min_weight = null;
    public ?string $max_weight = null;
    public string $price;
    public string $options = 'none';
    public ?string $insurance_value = null;

    public function rules()
    {
        $rules = [
            'zone_id' => 'required',
            'carrier_id' => 'required',
            'name' => [
                'required',
                'min:3',
                'max:250', 
                // ValidationRule::unique('methods')
                'unique:methods',
            ], 
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
 
    public function save() 
    {
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
 
        Method::create([
            'zone_id' => $this->zone_id,
            'carrier_id' => $this->carrier_id,
            'name' => $this->name,
            'min_length' => $this->min_length,
            'max_length' => $this->max_length,
            'min_width' => $this->min_width,
            'max_width' => $this->max_width,
            'min_height' => $this->min_height,
            'max_height' => $this->max_height,
            'min_weight' => $this->min_weight,
            'max_weight' => $this->max_weight,
            'price' => $this->price,
            'options' => $this->options,
            'insurance_value' => $this->insurance_value,
        ]);
 
        $this->reset(['name', 'min_length', 'max_length', 'min_width', 'max_width', 'min_height', 'max_height', 'min_weight', 'max_weight', 'price', 'options', 'insurance_value']);

        Flux::modal('create-method')->close();

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
}
?>

<flux:modal name="create-method" class="w-full">
    <form wire:submit="save"  class="space-y-6">
        <div>
            <flux:heading size="lg">Create Carrier</flux:heading>
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

        <div class="flex gap-3 items-start">
            <flux:input wire:model="min_length" label="min-length" placeholder="min-length" />
            <flux:input wire:model="min_width" label="min-width" placeholder="min-width" />
            <flux:input wire:model="min_height" label="min-height" placeholder="min-height" />
        </div>

        <div class="flex gap-3 items-start">
            <flux:input wire:model="max_length" label="max-length" placeholder="max-length" />
            <flux:input wire:model="max_width" label="max-width" placeholder="max-width" />
            <flux:input wire:model="max_height" label="max-height" placeholder="max-height" />
        </div>

        <div class="flex gap-3 items-start">
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

            <flux:button type="submit" variant="primary">Save</flux:button>
        </div>
    </form>
</flux:modal>
