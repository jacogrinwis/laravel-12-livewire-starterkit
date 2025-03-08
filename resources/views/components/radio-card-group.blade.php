@props([
    'label' => null,
])

@if($label)
    <div>
        <flux:label class="mb-2!">{{ $label }}</flux:label>
@endif

<ul {{ $attributes->merge(['class' => 'grid gap-4']) }}>
    {{ $slot }}
</ul>

@if($label)
    </div>
@endif
