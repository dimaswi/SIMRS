<x-filament-panels::page>
    <style>
        polygon:hover {
            fill: black;
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
                transform: scale(1.65);
            }
        }
    </style>
    <div id="print" class="flex justify-center items-center overflow-auto p-4 h-screen">
        <svg version="1.1" class="w-full max-w-4xl h-full" xmlns="http://www.w3.org/2000/svg">
            <g transform="scale(2)" id="gmain">
                @foreach ($teeth as $tooth)
                    <g id="P{{ $tooth['number'] }}" transform="{{ $tooth['transform'] }}" style="padding-top: 100px">
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
    </div>


    <div>
        <button onclick="window.print();">Print</button>
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
