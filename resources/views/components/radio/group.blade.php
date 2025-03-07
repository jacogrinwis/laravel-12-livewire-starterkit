@props(['variant' => '', 'label'])


@if($variant === 'card')
    @isset($label)
        <flux:label>{{ $label }}</flux:label>
    @endisset
    <div class="flex gap-3 w-full">
        <flux:heading size="lg">Option 1</flux:heading>
        <flux:subheading>Description for option 1</flux:subheading>
        {{ $slot }}
    </div>
@else
    <div>    
        {{ $slot }}
    </div>
@endif

