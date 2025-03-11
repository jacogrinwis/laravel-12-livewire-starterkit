@props([
    'icon' => null,
    'name' => null,
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'p-5 rounded-lg bg-white dark:bg-zinc-600 border border-zinc-200 dark:border-zinc-600 shadow-xs']) }}>
    @isset($icon)
        <div class="flex gap-2 w-full">
            <flux:icon name="{{ $icon }}" variant="mini" class="shrink-0 mt-0.5 inline-block fill-zinc-400 dark:fill-zinc-400" />
            <div class="w-full">
                @isset($name)
                    <flux:heading size="lg">{{ $name }}</flux:heading>
                @endisset

                @isset($description)
                    <flux:subheading>{{ $description }}</flux:subheading>
                @endisset

                {{ $slot }}
            </div>
        </div>
    @else
        <div>
            @isset($name)
                <flux:heading size="lg">{{ $name }}</flux:heading>
            @endisset

            @isset($description)
                <flux:subheading>{{ $description }}</flux:subheading>
            @endisset

            {{ $slot }}
        </div>
    @endisset
</div>