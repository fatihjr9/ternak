<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Hewan Ternak') }}
            </h2>
            <a href="{{ route('ternak-create') }}" class="px-4 py-2 bg-gray-50 border rounded-lg">Tambah</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Gambar
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama hewan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Umur hewan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Bobot hewan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tinggi hewan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                harga
                            </th>
                            <th scope="col" class="px-6 py-3">
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
                                    <button data-modal-target="popup-modal-{{ $item->id }}" data-modal-toggle="popup-modal-{{ $item->id }}" class="text-sm rounded-lg text-slate-800 p-2 w-fit bg-slate-100" type="button">
                                        Lihat Detail
                                    </button>
                                    <div id="popup-modal-{{ $item->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow flex flex-col space-y-8">
                                                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal-{{ $item->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="p-4 grid grid-cols-2 gap-4 mt-4">
                                                    @if ($item->gambar)
                                                        @foreach ($item->gambar as $gambar)
                                                            <img src="{{ Storage::url($gambar) }}" alt="Gambar {{ $item->nama }}" class="w-full">
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->nama }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->umur }} tahun
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->bobot }} kg
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->tinggi }} cm
                                </td>
                                <td class="px-6 py-4">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 gap-x-2 flex">
                                    <a href="{{ route('ternak-edit', $item->id) }}" class="text-orange-500">Edit</a>
                                    <form action="{{ route('ternak-destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">Hapus</button>
                                    </form>                                  
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
