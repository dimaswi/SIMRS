<x-filament-panels::page>
    @php
        setlocale(LC_ALL, 'IND');
    @endphp
    <style>
        polygon:hover {
            fill: black;
        }

        .kop {
            visibility: hidden;
            display: none;
        }

        @media print {
            body {
                visibility: hidden;
            }

            #print {
                visibility: visible;
                position: absolute;
                left: 0;
                top: 0;
                width: 100%
            }

            #gmain {
                transform: scale(1.77);
            }

            #button-print {
                display: none;
            }

            .kop {
                visibility: visible;
                display: block;
                table-layout: fixed;
            }

            svg {
                border-right: solid 1px black;
                border-left: solid 1px black;
                border-bottom: solid 1px black;
            }

            #form {
                display: none;
            }

        }
    </style>

    <div id="print" class="h-full">
        <div id="button-print">
            <x-filament::button icon="heroicon-m-trash" color="danger" wire:click="hapus_semua">
                Hapus Semua
            </x-filament::button>
            <x-filament::button icon="heroicon-m-printer" color="warning" onclick="window.print()">
                Print
            </x-filament::button>
        </div>


        <table class="kop" style="border: solid 1px black;">
            <tr>
                <td>
                    <center>
                        <img src="{{ url('/kop.png') }}" alt="" style="width: 100%">
                    </center>
                </td>
            </tr>
        </table>


        <div class="kop">
            <div style="width:50%; float:left; border-left: 1px solid black; border-bottom: 1px solid black;">
                <div class="px-2">
                    <b>Nama</b> : {{ $dataPasien->nama_lengkap }}
                </div>
                <div class="px-2">
                    <b>NIK</b> : .....
                </div>
            </div>

            <div style="width: 50%; float:right; border-right: 1px solid black; border-bottom: 1px solid black;">
                <div class="px-2">
                    <b>Tanggal</b> : {{ \Carbon\Carbon::parse($record->created_at)->formatLocalized('%A, %d %B %Y') }}
                </div>
                <div class="px-2">
                    <b>Kunjungan</b> : {{ $record->ruangan->nama_ruangan }}
                </div>
            </div>
        </div>

        <svg version="1.1" style="width: 100%; height: 410px; " xmlns="http://www.w3.org/2000/svg">
            <g transform="scale(2)" id="gmain" style="">
                @foreach ($teeth as $tooth)
                    <g id="P{{ $tooth['number'] }}" transform="{{ $tooth['transform'] }}">
                        <!-- Tambahkan teks di atas poligon -->
                        @if (collect($tooth['kondisi'])->contains('non'))
                            <text x="3" y="-2" stroke="navy" fill="black" stroke-width="0.1"
                                style="font-size: 6pt;font-weight:normal" class="text-xs">
                                non
                            </text>
                        @endif

                        @if (collect($tooth['kondisi'])->contains('une'))
                            <text x="3" y="-2" stroke="navy" fill="black" stroke-width="0.1"
                                style="font-size: 6pt;font-weight:normal" class="text-xs">
                                une
                            </text>
                        @endif

                        @if (collect($tooth['kondisi'])->contains('pre'))
                            <text x="3" y="-2" stroke="navy" fill="black" stroke-width="0.1"
                                style="font-size: 6pt;font-weight:normal" class="text-xs">
                                pre
                            </text>
                        @endif

                        @if (collect($tooth['kondisi'])->contains('imx'))
                            <text x="3" y="-2" stroke="navy" fill="black" stroke-width="0.1"
                                style="font-size: 6pt;font-weight:normal" class="text-xs">
                                imx
                            </text>
                        @endif

                        @if (collect($tooth['kondisi'])->contains('ano'))
                            <text x="3" y="-2" stroke="navy" fill="black" stroke-width="0.1"
                                style="font-size: 6pt;font-weight:normal" class="text-xs">
                                ano
                            </text>
                        @endif

                        <!-- Gigi Posisi Atas -->
                        @if ($tooth['posisi']['Atas'] !== null && $tooth['kondisi']['Atas'] === 'car')
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Atas', '{{ $tooth['transform'] }}')"
                                points="0,0 20,0 15,5 5,5" fill="red" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @elseif ($tooth['posisi']['Atas'] !== null && $tooth['kondisi']['Atas'] === 'amf')
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Atas', '{{ $tooth['transform'] }}')"
                                points="0,0 20,0 15,5 5,5" fill="black" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @elseif ($tooth['posisi']['Atas'] !== null && $tooth['kondisi']['Atas'] === 'gif')
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Atas', '{{ $tooth['transform'] }}')"
                                points="0,0 20,0 15,5 5,5" fill="green" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @else
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Atas', '{{ $tooth['transform'] }}')"
                                points="0,0 20,0 15,5 5,5" fill="white" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @endif

                        <!-- Gigi Posisi Bawah -->
                        @if ($tooth['posisi']['Bawah'] !== null && $tooth['kondisi']['Bawah'] === 'car')
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Bawah', '{{ $tooth['transform'] }}')"
                                points="5,15 15,15 20,20 0,20" fill="red" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @elseif ($tooth['posisi']['Bawah'] !== null && $tooth['kondisi']['Bawah'] === 'amf')
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Bawah', '{{ $tooth['transform'] }}')"
                                points="5,15 15,15 20,20 0,20" fill="black" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @elseif ($tooth['posisi']['Bawah'] !== null && $tooth['kondisi']['Bawah'] === 'gif')
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Bawah', '{{ $tooth['transform'] }}')"
                                points="5,15 15,15 20,20 0,20" fill="green" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @else
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Bawah', '{{ $tooth['transform'] }}')"
                                points="5,15 15,15 20,20 0,20" fill="white" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @endif

                        <!-- Gigi Posisi Kanan -->
                        @if ($tooth['posisi']['Kanan'] !== null && $tooth['kondisi']['Kanan'] === 'car')
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Kanan', '{{ $tooth['transform'] }}')"
                                points="15,5 20,0 20,20 15,15" fill="red" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @elseif ($tooth['posisi']['Kanan'] !== null && $tooth['kondisi']['Kanan'] === 'amf')
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Kanan', '{{ $tooth['transform'] }}')"
                                points="15,5 20,0 20,20 15,15" fill="black" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @elseif ($tooth['posisi']['Kanan'] !== null && $tooth['kondisi']['Kanan'] === 'gif')
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Kanan', '{{ $tooth['transform'] }}')"
                                points="15,5 20,0 20,20 15,15" fill="green" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @else
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Kanan', '{{ $tooth['transform'] }}')"
                                points="15,5 20,0 20,20 15,15" fill="white" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @endif

                        <!-- Gigi Posisi Kiri -->
                        @if ($tooth['posisi']['Kiri'] !== null && $tooth['kondisi']['Kiri'] === 'car')
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Kiri', '{{ $tooth['transform'] }}')"
                                points="0,0 5,5 5,15 0,20" fill="red" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @elseif ($tooth['posisi']['Kiri'] !== null && $tooth['kondisi']['Kiri'] === 'amf')
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Kiri', '{{ $tooth['transform'] }}')"
                                points="0,0 5,5 5,15 0,20" fill="black" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @elseif ($tooth['posisi']['Kiri'] !== null && $tooth['kondisi']['Kiri'] === 'gif')
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Kiri', '{{ $tooth['transform'] }}')"
                                points="0,0 5,5 5,15 0,20" fill="green" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @else
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Kiri', '{{ $tooth['transform'] }}')"
                                points="0,0 5,5 5,15 0,20" fill="white" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @endif

                        <!-- Gigi Posisi Tengah -->
                        @if ($tooth['posisi']['Tengah'] !== null && $tooth['kondisi']['Tengah'] === 'car')
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Tengah', '{{ $tooth['transform'] }}')"
                                points="5,5 15,5 15,15 5,15" fill="red" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @elseif ($tooth['posisi']['Tengah'] !== null && $tooth['kondisi']['Tengah'] === 'amf')
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Tengah', '{{ $tooth['transform'] }}')"
                                points="5,5 15,5 15,15 5,15" fill="black" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @elseif ($tooth['posisi']['Tengah'] !== null && $tooth['kondisi']['Tengah'] === 'gif')
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Tengah', '{{ $tooth['transform'] }}')"
                                points="5,5 15,5 15,15 5,15" fill="green" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @else
                            <polygon
                                wire:click="odontogram('{{ $tooth['number'] }}', 'Tengah', '{{ $tooth['transform'] }}')"
                                points="5,5 15,5 15,15 5,15" fill="white" stroke="navy" stroke-width="0.5"
                                id="T" opacity="1" class="cursor-pointer hover:fill-blue-200"></polygon>
                        @endif

                        <!-- State Saat Gigi Missing -->
                        @if (collect($tooth['kondisi'])->contains('mis'))
                            <line x1="0" y1="0" x2="20" y2="20"
                                style="stroke:red;stroke-width:2;" />
                            <line x1="0" y1="20" x2="20" y2="0"
                                style="stroke:red;stroke-width:2;" />
                        @endif

                        <!-- State Saat Gigi Sisa Akar -->
                        @if (collect($tooth['kondisi'])->contains('rrx'))
                            <line x1="2" y1="0" x2="10" y2="20"
                                style="stroke:red;stroke-width:2;" />
                            <line x1="10" y1="20" x2="18" y2="0"
                                style="stroke:red;stroke-width:2;" />
                        @endif

                        <!-- State Saat Gigi Sisa Akar -->
                        @if (collect($tooth['kondisi'])->contains('mpm'))
                            <circle cx="10" cy="10" r="10" fill="none"
                                style="stroke:red;stroke-width:2;" />
                        @endif

                        <!-- State Saat Gigi Sisa Akar -->
                        @if (collect($tooth['kondisi'])->contains('cfr'))
                            <line x1="8" y1="0" x2="4" y2="20"
                                style="stroke:red;stroke-width:2;" />
                            <line x1="12" y1="20" x2="16" y2="0"
                                style="stroke:red;stroke-width:2;" />
                            <line x1="0" y1="6" x2="20" y2="6"
                                style="stroke:red;stroke-width:2;" />
                            <line x1="0" y1="12" x2="20" y2="12"
                                style="stroke:red;stroke-width:2;" />
                        @endif

                        <!-- Teks di bawah poligon -->
                        <text x="6" y="30" stroke="navy" fill="navy" stroke-width="0.1"
                            style="font-size: 6pt;font-weight:normal" class="text-xs">{{ $tooth['number'] }}</text>
                    </g>
                @endforeach
            </g>
        </svg>

        <div class="kop">
            <table style="border-collapse: collapse; width: 100%; ">
                @if ($odontogramDetail)
                    <tr>
                        <td style=" width:30%; padding-left:20px ; border-left: solid 1px black; ">
                            Occlusi
                        </td>
                        <td style="border-right: solid 1px black;">
                            @if ($odontogramDetail->occlusi === 'Normal Bite')
                                Normal Bite/<s>Cross Bite</s>/<s>Steep Bite</s>
                            @elseif ($odontogramDetail->occlusi === 'Cross Bite')
                                <s>Normal Bite</s>/Cross Bite/<s>Steep Bite</s>
                            @elseif ($odontogramDetail->occlusi === 'Steep Bite')
                                <s>Normal Bite</s>/<s>Cross Bite</s>/Steep Bite
                            @else
                                Normal Bite/Cross Bite/Steep Bite
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style=" width:30%; padding-left:20px ; border-left: solid 1px black; ">
                            Torus Platinus
                        </td>
                        <td style="border-right: solid 1px black;">
                            @if ($odontogramDetail->torus_platinus === 'Tidak Ada')
                                Tidak Ada/<s>Kecil</s>/<s>Sedang</s>/<s>Besar</s>/<s>Multiple</s>
                            @elseif ($odontogramDetail->torus_platinus === 'Kecil')
                                <s>Tidak Ada</s>/Kecil/<s>Sedang</s>/<s>Besar</s>/<s>Multiple</s>
                            @elseif ($odontogramDetail->torus_platinus === 'Sedang')
                                <s>Tidak Ada</s>/<s>Kecil</s>/Sedang/<s>Besar</s>/<s>Multiple</s>
                            @elseif ($odontogramDetail->torus_platinus === 'Besar')
                                <s>Tidak Ada</s>/<s>Kecil</s>/<s>Sedang</s>/Besar/<s>Multiple</s>
                            @elseif ($odontogramDetail->torus_platinus === 'Multiple')
                                <s>Tidak Ada</s>/<s>Kecil</s>/<s>Sedang</s>/<s>Besar</s>/Multiple
                            @else
                                Tidak Ada/Kecil/Sedang/Besar/Multiple
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style=" width:30%; padding-left:20px ; border-left: solid 1px black; ">
                            Torus Mandibularis
                        </td>
                        <td style="border-right: solid 1px black;">
                            @if ($odontogramDetail->torus_mandibularis === 'Tidak Ada')
                                Tidak Ada/<s>Sisi Kiri</s>/<s>Sisi Kanan</s>/<s>Kedua Sisi</s>
                            @elseif ($odontogramDetail->torus_mandibularis === 'Sisi Kiri')
                                <s>Tidak Ada</s>/Sisi Kiri/<s>Sisi Kanan</s>/<s>Kedua Sisi</s>
                            @elseif ($odontogramDetail->torus_mandibularis === 'Sisi Kanan')
                                <s>Tidak Ada</s>/<s>Sisi Kiri</s>/Sisi Kanan/<s>Kedua Sisi</s>
                            @elseif ($odontogramDetail->torus_mandibularis === 'Kedua Sisi')
                                <s>Tidak Ada</s>/<s>Sisi Kiri</s>/<s>Sisi Kanan</s>/Kedua Sisi
                            @else
                                Tidak Ada/Sisi Kiri/Sisi Kanan/Kedua Sisi
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style=" width:30%; padding-left:20px ; border-left: solid 1px black; ">
                            Palatum
                        </td>
                        <td style="border-right: solid 1px black;">
                            @if ($odontogramDetail->palatum === 'Dalam')
                                Dalam/<s>Sedang</s>/<s>Rendah</s>
                            @elseif ($odontogramDetail->palatum === 'Sedang')
                                <s>Dalam</s>/Sedang/<s>Rendah</s>
                            @elseif ($odontogramDetail->palatum === 'Rendah')
                                <s>Dalam</s>/<s>Sedang</s>/Rendah
                            @else
                                Dalam/Sedang/Rendah
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style=" width:30%; padding-left:20px ; border-left: solid 1px black; ">
                            Diastema
                        </td>
                        <td style="border-right: solid 1px black;">
                            @if ($odontogramDetail->diastema === 'Tidak Ada')
                                Tidak Ada/<s>Ada</s>
                            @elseif ($odontogramDetail->diastema !== 'Tidak Ada')
                                <s>Tidak Ada</s>/Ada : {{ $odontogramDetail->diastema }}
                            @else
                                Tidak Ada/Ada
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td
                            style=" width:30%; padding-left:20px ; border-left: solid 1px black;border-bottom: solid 1px black;">
                            Anomali
                        </td>
                        <td style="border-right: solid 1px black; border-bottom: solid 1px black;">
                            @if ($odontogramDetail->anomali === 'Tidak Ada')
                                Tidak Ada/<s>Ada</s>
                            @elseif ($odontogramDetail->anomali !== 'Tidak Ada')
                                <s>Tidak Ada</s>/Ada : {{ $odontogramDetail->anomali }}
                            @else
                                Tidak Ada/Ada
                            @endif
                        </td>
                    </tr>
                @else
                    <tr>
                        <td style=" width:30%; padding-left:20px ; border-left: solid 1px black; ">
                            Occlusi
                        </td>
                        <td style="border-right: solid 1px black;">
                            Normal Bite/Cross Bite/Steep Bite
                        </td>
                    </tr>
                    <tr>
                        <td style=" width:30%; padding-left:20px ; border-left: solid 1px black; ">
                            Torus Platinus
                        </td>
                        <td style="border-right: solid 1px black;">
                            Tidak Ada/Kecil/Sedang/Besar/Multiple
                        </td>
                    </tr>
                    <tr>
                        <td style=" width:30%; padding-left:20px ; border-left: solid 1px black; ">
                            Torus Mandibularis
                        </td>
                        <td style="border-right: solid 1px black;">
                            Tidak Ada/Sisi Kiri/Sisi Kanan/Kedua Sisi
                        </td>
                    </tr>
                    <tr>
                        <td style=" width:30%; padding-left:20px ; border-left: solid 1px black; ">
                            Palatum
                        </td>
                        <td style="border-right: solid 1px black;">
                            Dalam/Sedang/Rendah
                        </td>
                    </tr>
                    <tr>
                        <td style=" width:30%; padding-left:20px ; border-left: solid 1px black; ">
                            Diastema
                        </td>
                        <td style="border-right: solid 1px black;">
                            Tidak Ada/Ada
                        </td>
                    </tr>
                    <tr>
                        <td
                            style=" width:30%; padding-left:20px ; border-left: solid 1px black;border-bottom: solid 1px black;">
                            Anomali
                        </td>
                        <td style="border-right: solid 1px black; border-bottom: solid 1px black;">
                            Tidak Ada/Ada
                        </td>
                    </tr>
                @endif

            </table>
        </div>

        <div class="kop">
            <table style="border-collapse: collapse; width: 100%; border: solid 1px black;">
                <tr>
                    <td style="width: 50%"><center></center></td>
                    <td style="width: 50%"><center>Tanda Tangan Dokter</center></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td style="width: 50%"><center></center></td>
                    <td style="width: 50%"><center>Dokter Pemeriksa</center></td>
                </tr>
            </table>
        </div>

        <form id="form" wire:submit="create">
            {{ $this->form }}
            <br>
            <x-filament::button size="lg" color="success" type="submit">
                Simpan
            </x-filament::button>
        </form>

    </div>

    <x-filament::modal id="odontogram-modal" width="2xl">
        <x-slot name="heading">
            Gigi {{ $selectedTooth }}
        </x-slot>

        @if ($selectedTooth)
            <form wire:submit="simpan">
                <x-filament::fieldset>
                    <x-slot name="label">
                        Kondisi Gigi
                    </x-slot>
                    <x-filament::input.wrapper>
                        <x-filament::input.select wire:model="kondisi">
                            @foreach ($master_kondisi as $item)
                                <option value="{{ $item->id }}">{{ $item->simbol }} - {{ $item->keterangan }}
                                </option>
                            @endforeach
                        </x-filament::input.select>
                    </x-filament::input.wrapper>
                </x-filament::fieldset>

                <x-filament::fieldset>
                    <x-slot name="label">
                        Tindakan
                    </x-slot>
                    <x-filament::input.wrapper>
                        <x-filament::input type="text" wire:model="tindakan"
                            placeholder="Masukkan tindakan pada gigi" />
                    </x-filament::input.wrapper>
                </x-filament::fieldset>
                <br>
                <x-filament::button size="lg" color="success" type="submit">
                    Simpan
                </x-filament::button>
                <x-filament::button size="lg" color="danger" type="button" wire:click="hapus">
                    Hapus
                </x-filament::button>
                <x-filament::button size="lg" color="danger" type="button" wire:click="hapus_data_gigi">
                    Hapus Semua
                </x-filament::button>
            </form>
        @endif
    </x-filament::modal>
</x-filament-panels::page>
