@props([
    'id' => null,
    'name' => '',
    'value' => '',
    'label' => null,
    'description' => null,
    'checked' => false,
])

@php
    $labelBaseClasses = 'group inline-flex justify-between items-start gap-3 p-5 w-full rounded-lg border cursor-pointer';
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

<li>
    <input 
        id="{{ $id }}" 
        name="{{ $name }}" 
        type="radio" 
        value="{{ $value }}"
        {{ $checked ? 'checked' : '' }}
        {{ $attributes->merge(['class' => 'hidden peer']) }}
    >
    <label for="{{ $id }}" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:border-gray-700 dark:hover:bg-gray-700 dark:hover:text-white">
        <div>
            @isset($label)
                <flux:heading size="lg">{{ $label }}</flux:heading>
            @endisset

            @isset($description)
                <flux:subheading>{{ $description }}</flux:subheading>
            @endisset
            
            {{ $slot }}
        </div>
        <div class="hidden peer-checked:block">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </label>
</li>
