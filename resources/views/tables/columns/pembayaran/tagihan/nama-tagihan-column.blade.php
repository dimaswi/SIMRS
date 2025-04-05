<div class="text-sm">
    @if ($getRecord()->tarif_id != null)
        {{ $getRecord()->tarif->nama_tarif }}
    @elseif ($getRecord()->tindakan_id != null)
        {{ $getRecord()->tindakan->nama_tindakan }}
    @elseif ($getRecord()->barang_id != null)
        {{ $getRecord()->barang->nama_barang }}
    @endif
</div>
