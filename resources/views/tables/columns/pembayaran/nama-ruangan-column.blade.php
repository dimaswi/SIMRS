@php
    $kunjungan = \App\Models\Pendaftaran\Kunjungan::where('pendaftaran_id', $getRecord()->id)->with('ruangan')->get();
@endphp

<div>
    @foreach ($kunjungan as $val)
        <div class="inline-block">
            <x-filament::badge size="sm">
                {{ $val->ruangan->nama_ruangan }}
            </x-filament::badge>
        </div>
    @endforeach
</div>
