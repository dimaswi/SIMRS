<x-filament-panels::page>
    <div>
        {{ $this->table }}
    </div>

    <x-filament::button wire:click="bayarTagihan" size="xl" color="success" icon="heroicon-m-banknotes">
        Bayar!
    </x-filament::button>
</x-filament-panels::page>
