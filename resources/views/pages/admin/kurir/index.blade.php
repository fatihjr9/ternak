<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pengiriman') }}
            </h2>
            <a href="{{ route('kurir-create') }}" class="px-4 py-2 bg-gray-50 border rounded-lg">Tambah</a>
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
                                Nama Kendaraan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Maks Beban
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Maks Jarak Tempuh
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Biaya
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
                                    {{ $item->nama }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->beban }} Kg
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->jarak }} Km
                                </td>
                                <td class="px-6 py-4">
                                    {{ 'Rp ' . number_format($item->biaya, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 gap-x-2 flex">
                                    <a href="{{ route('kurir-edit', $item->id) }}" class="text-orange-500">Edit</a>
                                    <form action="{{ route('kurir-destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
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
