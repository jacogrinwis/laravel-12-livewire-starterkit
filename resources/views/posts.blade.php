<x-layouts.app>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">Posts</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage all the posts') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <livewire:posts/>
</x-layouts.app>
