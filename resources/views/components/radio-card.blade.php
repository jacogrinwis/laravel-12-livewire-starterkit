@props([
    'id' => null,
    'name' => '',
    'value' => '',
    'icon' => null,
    'label' => null,
    'description' => null,
    'checked' => false,
])

@php
    $labelBaseClasses = 'group inline-flex justify-between items-start gap-3 p-5 h-full w-full rounded-lg border cursor-pointer';
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

<li class="group">
    <input 
        type="radio" 
        id="{{ $id }}" 
        name="{{ $name }}" 
        {{ $attributes->merge(['class' => 'hidden']) }}
        value="{{ $value }}"
        {{ $checked ? 'checked' : '' }}
    >
    <label 
        for="{{ $id }}" 
        class="{{ $labelBaseClasses }} {{ $labelLightClasses }} {{ $labelDarkClasses }}"
    >
        @isset($icon)
            <div class="flex flex-1 gap-2">
                <flux:icon name="shield-check" variant="mini" class="{{ $checkboxIconBaseClasses }} {{ $checkboxIconLightClasses }} {{ $checkboxIconDarkClasses }}" />
                <div>
                    <flux:heading size="lg">{{ $label }}</flux:heading>
                    <flux:subheading>{{ $description }}</flux:subheading>
                </div>
            </div>
        @else
            <div>
                @isset($label)
                    <flux:heading size="lg">{{ $label }}</flux:heading>
                @endisset

                @isset($description)
                    <flux:subheading>{{ $description }}</flux:subheading>
                @endisset

                {{ $slot }}
            </div>
        @endisset
        
        <div class="{{ $checkboxBaseClasses }} {{ $checkboxLightClasses }} {{ $checkboxDarkClasses }}">
            <div class="{{ $checkboxInnerBaseClasses }} {{ $checkboxInnerLightClasses }} {{ $checkboxInnerDarkClasses }}"></div>
        </div>
    </label>
</li>
