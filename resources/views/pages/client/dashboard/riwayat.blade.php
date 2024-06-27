<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pembelian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-6">
                @foreach ($riwayat as $item)
                    <div class="bg-white p-4 rounded-md shadow-md space-y-4">
                        <div class="flex flex-col space-y-2">
                            <h5 class="text-lg font-medium">Info Pembeli</h5>
                            <div class="flex flex-col space-y-1">
                                <div class="flex flex-row items-center gap-x-2">
                                    <p>Nama :</p>
                                    <p>{{ $item->nama }}</p>
                                </div>
                                <div class="flex flex-row items-center gap-x-2">
                                    <p>Alamat :</p>
                                    <p>{{ $item->alamat }}</p>
                                </div>
                                <div class="flex flex-row items-center gap-x-2">
                                    <p>Whatsapp :</p>
                                    <p>{{ $item->no_telp }}</p>
                                </div>
                                <div class="flex flex-row items-center gap-x-2">
                                    <p>Catatan :</p>
                                    @if ($item->catatan)
                                        <p>{{ $item->catatan }}</p>
                                    @else
                                        <p>Tidak ada</p>
                                    @endif
                                </div>
                                <div class="flex flex-row items-center gap-x-2">
                                    <p>Bukti Pembayaran :</p>
                                    <button data-modal-target="default-modal-{{ $item->id }}" data-modal-toggle="default-modal-{{ $item->id }}">Lihat</button>
                                    <div id="default-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow p-4">
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal-{{ $item->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <img class="w-96 text-center" src="{{ asset('storage/' . $item->bukti_byr) }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-row items-center gap-x-2">
                                    <p>Total Keseluruhan :</p>
                                    <p>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <h5 class="text-lg font-medium">Detail Ternak</h5>
                            <div class="flex flex-col space-y-1">
                                <div class="flex flex-row items-center gap-x-2">
                                    <p>Nama :</p>
                                    <p>{{ $item->ternak->nama }}</p>
                                </div>
                                <div class="flex flex-row items-center gap-x-2">
                                    <p>Bobot :</p>
                                    <p>{{ $item->ternak->bobot }} kg</p>
                                </div>
                                <div class="flex flex-row items-center gap-x-2">
                                    <p>Tinggi :</p>
                                    <p>{{ $item->ternak->tinggi }} cm</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <h5 class="text-lg font-medium">Detail Pengiriman</h5>
                            @foreach ($admins as $admin)
                                <p>Nama pengantar : {{ $admin->name }}</p>
                            @endforeach
                            <div class="flex flex-row items-center gap-x-2">
                                <p>Angkutan yg digunakan :</p>
                                <p>{{ $item->angkutan }}</p>
                            </div>
                            <div class="flex flex-row items-center gap-x-2">
                                <p>Jarak Dari lokasi :</p>
                                <p>{{ $item->jarak }} km</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>