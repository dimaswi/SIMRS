<x-filament-panels::page>
    <div>
        <form wire:submit="create">
            {{ $this->form }}

            <br>

            <x-filament::button type="submit" wire:target="create">
                Submit
            </x-filament::button>
        </form>

    </div>
</x-filament-panels::page>
