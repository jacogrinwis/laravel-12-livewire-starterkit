<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

@php
    $labelBaseClasses = 'inline-flex justify-between items-start gap-3 p-5 w-full rounded-lg border';
    $labelLightClasses = 'bg-white group-has-checked:bg-zinc-50 border-zinc-200 group-has-checked:border-black';
    $labelDarkClasses = 'dark:bg-zinc-700 dark:group-has-checked:bg-zinc-600 dark:border-zinc-600 group-has-checked:dark:border-white';
    $checkboxBaseClasses = 'flex items-center justify-center shrink-0 size-[1.25rem] text-sm rounded-full border shadow-xs';
    $checkboxLightClasses = 'bg-white border-zinc-200 group-has-checked:bg-black';
    $checkboxDarkClasses = 'dark:bg-zinc-600 dark:border-zinc-500 group-has-checked:dark:bg-white';
    $checkboxInnerBaseClasses = 'hidden group-has-checked:block size-2 rounded-full';
    $checkboxInnerLightClasses = 'bg-white';
    $checkboxInnerDarkClasses = 'dark:bg-black';
    $checkboxIconBaseClasses = 'shrink-0 mt-0.5 shrink-0 inline-block';
    $checkboxIconLightClasses = 'fill-zinc-400 group-has-checked:fill-black';
    $checkboxIconDarkClasses = 'group-has-checked:dark:fill-white';
@endphp

<div class="max-w-3xl space-y-6">

    <x-radio-card-group name="shipping-method" :columns="2">
        <x-radio-card
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
        </x-radio-card>
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