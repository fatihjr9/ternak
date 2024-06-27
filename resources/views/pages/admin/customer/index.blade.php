<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesanan Customer') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Nama Customer
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Alamat
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                No Telp
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Catatan
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Jarak pengiriman
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Hewan yang dipesan
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Metode Pengiriman
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Bukti Pembayaran
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Total
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->user->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->alamat }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->no_telp }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($item->catatan)
                                        {{ $item->catatan }}
                                    @else
                                        tidak ada
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->jarak }} km
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->ternak->nama }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->angkutan }}
                                </td>
                                <td class="px-6 py-4">
                                    <button data-modal-target="default-modal-{{ $item->id }}" data-modal-toggle="default-modal-{{ $item->id }}" class="bg-gray-800 text-white px-3 py-1 rounded-lg">Lihat</button>
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
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 gap-x-2 flex">
                                    <a href="#" class="text-orange-500">Edit</a>
                                    <button class="text-red-500">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>