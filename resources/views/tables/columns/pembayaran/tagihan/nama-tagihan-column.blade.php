<div class="text-sm">
    {{-- {{ dump($getRecord()) }} --}}
    @if ($getRecord()->tarif_id != null)
        {{ $getRecord()->tarif->tarif->nama_tarif }}
    @elseif ($getRecord()->tindakan_id != null)
        {{ $getRecord()->tindakan->tindakan->tindakan->nama_tindakan }}
    @elseif ($getRecord()->barang_id != null)
        {{ $getRecord()->barang->nama_barang }}
    @endif
</div>
