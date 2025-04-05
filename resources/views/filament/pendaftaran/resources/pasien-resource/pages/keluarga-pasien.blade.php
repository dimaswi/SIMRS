<x-filament-panels::page>
    <x-filament::modal width="5xl" id="tambah-keluarga">
        <x-slot name="trigger">
            <x-filament::button color="success">
                Tambah
            </x-filament::button>
        </x-slot>

        <div>
            <form wire:submit="create">
                {{ $this->form }}

                <br>

                <x-filament::button type="submit" color="success">
                    Simpan
                </x-filament::button>
            </form>

            <x-filament-actions::modals />
        </div>
    </x-filament::modal>
    {{ $this->table }}
</x-filament-panels::page>
