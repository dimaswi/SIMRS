<x-filament-panels::page>
    <form wire:keydown.enter="create">
        {{ $this->form }}
    </form>

    <div>
        {{ $this->table }}
    </div>
</x-filament-panels::page>
