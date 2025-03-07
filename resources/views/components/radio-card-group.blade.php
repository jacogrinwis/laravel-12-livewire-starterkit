@props([
    'name' => '',
    'columns' => 2,
    'label' => null,
])

@isset($label)
    <div>
        <flux:label>{{ $label }}</flux:label>
@endisset

<ul class="grid md:grid-cols-{{ $columns }} gap-4">
    {{ $slot }}
</ul>

@isset($label)
    </div>
@endisset
