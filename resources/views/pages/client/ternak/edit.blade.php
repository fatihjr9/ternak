<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Ternak') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('ternak-update', $data->id) }}" method="POST" enctype="multipart/form-data" class="w-96 bg-white p-4 drop-shadow-sm border rounded-lg mx-auto">
                @csrf
                @method('PUT')
                <div class="flex flex-col space-y-2 mb-4">
                    <div>
                        <label class="mb-1 text-sm font-medium text-gray-900 flex items-center gap-x-2">Gambar <p class="text-xs text-gray-200">Maks 2mb</p></label>
                        <input type="file" name="gambar[]" multiple class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full" placeholder="cth: Yusuf" required />
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Nama Ternak</label>
                        <input value="{{ $data->nama }}" type="text" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="cth: Yusuf" required />
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Umur Hewan</label>
                        <input value="{{ $data->umur }}" type="number" name="umur" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="cth: Yusuf" required />
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Bobot Hewan</label>
                        <input value="{{ $data->bobot }}" type="number" name="bobot" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="cth: Yusuf" required />
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Tinggi Hewan</label>
                        <input value="{{ $data->tinggi }}" type="number" name="tinggi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="cth: Yusuf" required />
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Harga</label>
                        <input value="{{ $data->harga }}" type="number" name="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="cth: Yusuf" required />
                    </div>
                </div>
                <button class="bg-green-700 text-white w-full py-2 rounded-lg">Tambahkan</button>
            </form>
        </div>
    </div>
</x-app-layout>