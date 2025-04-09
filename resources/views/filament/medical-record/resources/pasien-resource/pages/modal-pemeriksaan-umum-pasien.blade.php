<div>
    <x-filament::fieldset>
        <x-slot name="label">
            TTV
        </x-slot>

        <div>
            <table style="width: 100%">
                <tr>
                    <td colspan="2">
                        <p>Keadaan Umum :</p> <b>{{ $record->keadaan_umum }}</b>
                    </td>
                    <td colspan="2">
                        <p>Tingkat Kesadaran : </p> <b>{{ $record->tingkat_kesadaran }}</b>
                    </td>
                </tr>
                <tr></tr>
                <tr>
                    <td>
                        <p>Eye :</p> <b>{{ (int) $record->eye }}</b>
                    </td>
                    <td>
                        <p>Verbal :</p> <b>{{ (int) $record->verbal }}</b>
                    </td>
                    <td>
                        <p>Motorik :</p> <b>{{ (int) $record->motorik }}</b>
                    </td>
                    <td>
                        <p>GCS :</p> <b>{{ (int) $record->GCS }}</b>
                    </td>
                </tr>
                <tr></tr>
                <tr>
                    <td colspan="4">
                        <p>Tekanan Darah : </p>
                        <b>{{ (int) $record->tekanan_darah_sistolik }}/{{ (int) $record->tekanan_darah_distolik }}
                            mmHg</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Frekuensi Nafas :</p> <b>{{ (int) $record->frekuensi_nafas }}/Menit</b>
                    </td>
                    <td>
                        <p>Frekuensi Nadi :</p> <b>{{ (int) $record->frekuensi_nadi }}/Menit</b>
                    </td>
                    <td>
                        <p>Suhu :</p> <b>{{ (int) $record->suhu }}°C</b>
                    </td>
                    <td>
                        <p>Oksigen :</p> <b>{{ (int) $record->saturasi_oksigen }} mmHg</b>
                    </td>
                </tr>
                <tr></tr>
            </table>
        </div>
    </x-filament::fieldset>

    <x-filament::fieldset>
        <x-slot name="label">
            Antropometri
        </x-slot>

        <table style="width: 100%">
            <tr>
                <td colspan="2">
                    <p>Berat Badan :</p> <b>{{ (int) $record->berat_badan }} Kg</b>
                </td>
                <td colspan="2">
                    <p>Tinggi Badan :</p> <b>{{ (int) $record->tinggi_badan }} cm</b>
                </td>
            </tr>
            <tr></tr>
            <tr>
                <td>
                    <p>Lingkar Lengan Atas :</p> <b>{{ (int) $record->lingkar_lengan_atas }} cm</b>
                </td>
                <td>
                    <p>Lingkar Kepala :</p> <b>{{ (int) $record->lingkar_kepala }} cm</b>
                </td>
                <td>
                    <p>Lingkar Perut :</p> <b>{{ (int) $record->lingkar_perut }} cm</b>
                </td>
            </tr>
            <tr></tr>
            <tr>
                <td colspan="2">
                    <p>Tinggi Lutut :</p> <b>{{ (int) $record->tinggi_lutut }} cm</b>
                </td>
                <td colspan="2">
                    <p>Panjang Ulna :</p> <b>{{ (int) $record->panjang_ulna }} cm</b>
                </td>
            </tr>
            <tr></tr>
            <tr>
                <td colspan="4">
                    <p>Kondisi Anak :</p> <b>{{ $record->kondisi_anak }}</b>
                </td>
            </tr>
            <tr></tr>
        </table>
    </x-filament::fieldset>
</div>
