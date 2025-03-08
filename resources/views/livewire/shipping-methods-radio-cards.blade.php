<?php

use Livewire\Volt\Component;
use App\Models\ShippingMethode;

new class extends Component {
    public function with(): array
    {
        return [
            'shippingMethods' => ShippingMethode::with('shippingZone')->get(),
        ];
    }
}; ?>

<div class="max-w-7xl space-y-6 @container">

    <x-radio-card-group name="shipping-method" label="Shipping methods" class="@lg:grid-cols-2 @4xl:grid-cols-3">
        @foreach ($shippingMethods as $shippingMethod)
            <x-radio-card
                id="standard-shipping-{{ $shippingMethod->id }}"
                name="shipping-method"
                value="{{ $shippingMethod->id }}"
                icon="shield-check"
                label="{{ $shippingMethod->name }}"
                description="{{ $shippingMethod->shippingCarrier->name }} {{ $shippingMethod->shippingCarrier->shippingZone->name }}"
                :checked="$loop->first"
            >
                <dl class="mt-2 text-sm text-black dark:text-white">
                    <dt>Max-size:</dt>
                    <dd>{{ $shippingMethod->formattedMaxSize }}</dd>
                </dl>
                <ol class="text-sm text-gray-500">
                    <li>{{ $shippingMethod->formattedMaxSize }}</li>
                </ol>
            </x-radio-card>
            {{-- @dump($shippingMethod) --}}
        @endforeach
        {{-- <x-radio-card
            id="standard-shipping"
            name="shipping-method"
            value="standard"
            label="Standaard Verzending"
            description="Levering binnen 3-5 werkdagen"
            :checked="true"
        />
        
        <x-radio-card
            id="express-shipping"
            name="shipping-method"
            value="express"
            label="Express Verzending"
            description="Levering binnen 1-2 werkdagen"
        />
        
        <x-radio-card
            id="extreme-shipping"
            name="shipping-method"
            value="extreme"
            icon="shield-check"
            label="Extreme Verzending"
            description="Levering binnen 7-14 werkdagen"
        />
        
        <x-radio-card
            id="turbo-shipping"
            name="shipping-method"
            value="turbo"
            icon="shield-check"
            label="Turbo Verzending"
            description="Levering binnen 7-14 werkdagen"
        />

        <x-radio-card
            id="super-turbo-shipping"
            name="shipping-method"
            value="super-turbo"
        >
            <flux:heading size="lg" class="mt-0!">Super Turbo Verzending</flux:heading>
            <flux:subheading>Levering binnen 7-14 werkdagen</flux:subheading>
        </x-radio-card> --}}
    </x-radio-card-group>

    {{-- <ul class="grid md:grid-cols-2 gap-4">
        <li class="group">
            <input type="radio" id="radio-card-1" name="radio-card" class="hidden" checked>
            <label for="radio-card-1" class="{{ $labelBaseClasses }} {{ $labelLightClasses }} {{ $labelDarkClasses }}">
                <div>
                    <flux:heading size="lg">Option 1</flux:heading>
                    <flux:subheading>Description for option 1</flux:subheading>
                </div>
                <div class="{{ $checkboxBaseClasses }} {{ $checkboxLightClasses }} {{ $checkboxDarkClasses }}">
                    <div class="{{ $checkboxInnerBaseClasses }} {{ $checkboxInnerLightClasses }} {{ $checkboxInnerDarkClasses }}"></div>
                </div>
            </label>
        </li>
        <li class="group">
            <input type="radio" id="radio-card-2" name="radio-card" class="hidden">
            <label for="radio-card-2" class="{{ $labelBaseClasses }} {{ $labelLightClasses }} {{ $labelDarkClasses }}">
                <div>
                    <flux:heading size="lg">Option 2</flux:heading>
                    <flux:subheading>Description for option 2</flux:subheading>
                </div>
                <div class="{{ $checkboxBaseClasses }} {{ $checkboxLightClasses }} {{ $checkboxDarkClasses }}">
                    <div class="{{ $checkboxInnerBaseClasses }} {{ $checkboxInnerLightClasses }} {{ $checkboxInnerDarkClasses }}"></div>
                </div>
            </label>
        </li>
        <li class="group">
            <input type="radio" id="radio-card-3" name="radio-card" class="hidden">
            <label for="radio-card-3" class="{{ $labelBaseClasses }} {{ $labelLightClasses }} {{ $labelDarkClasses }}">
                <div>
                    <flux:heading size="lg">Option 3</flux:heading>
                    <flux:subheading>Description for option 3</flux:subheading>
                </div>
                <div class="{{ $checkboxBaseClasses }} {{ $checkboxLightClasses }} {{ $checkboxDarkClasses }}">
                    <div class="{{ $checkboxInnerBaseClasses }} {{ $checkboxInnerLightClasses }} {{ $checkboxInnerDarkClasses }}"></div>
                </div>
            </label>
        </li>
        <li class="group">
            <input type="radio" id="radio-card-4" name="radio-card" class="hidden">
            <label for="radio-card-4" class="{{ $labelBaseClasses }} {{ $labelLightClasses }} {{ $labelDarkClasses }}">
                <div class="flex flex-1 gap-2">
                    <flux:icon name="shield-check" variant="solid" class="{{ $checkboxIconBaseClasses }} {{ $checkboxIconLightClasses }} {{ $checkboxIconDarkClasses }}" />
                    <div>
                        <flux:heading size="lg">Option 4</flux:heading>
                        <flux:subheading>Description for option 4</flux:subheading>
                    </div>
                </div>
                <div class="{{ $checkboxBaseClasses }} {{ $checkboxLightClasses }} {{ $checkboxDarkClasses }}">
                    <div class="{{ $checkboxInnerBaseClasses }} {{ $checkboxInnerLightClasses }} {{ $checkboxInnerDarkClasses }}"></div>
                </div>
            </label>
        </li>
        <li class="group">
            <input type="radio" id="radio-card-5" name="radio-card" class="hidden">
            <label for="radio-card-5" class="{{ $labelBaseClasses }} {{ $labelLightClasses }} {{ $labelDarkClasses }}">
                <div class="flex flex-1 gap-2">
                    <flux:icon name="shield-check" variant="mini" class="{{ $checkboxIconBaseClasses }} {{ $checkboxIconLightClasses }} {{ $checkboxIconDarkClasses }}" />
                    <div>
                        <flux:heading size="lg">Option 5</flux:heading>
                        <flux:subheading>Description for option 5</flux:subheading>
                    </div>
                </div>
                <div class="{{ $checkboxBaseClasses }} {{ $checkboxLightClasses }} {{ $checkboxDarkClasses }}">
                    <div class="{{ $checkboxInnerBaseClasses }} {{ $checkboxInnerLightClasses }} {{ $checkboxInnerDarkClasses }}"></div>
                </div>
            </label>
        </li>
    </ul> --}}
</div>