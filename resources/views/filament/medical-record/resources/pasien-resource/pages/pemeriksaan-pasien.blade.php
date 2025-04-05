<x-filament-panels::page>
    <form wire:submit="create">
        {{ $this->form }}
        <br>
        <x-filament::button size="lg" type="submit" icon="heroicon-m-bookmark" color="success">
            Simpan
        </x-filament::button>
    </form>

    <x-filament-actions::modals />
</x-filament-panels::page>
