<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Metode Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('payment-store') }}" method="POST" enctype="multipart/form-data" class="w-96 bg-white p-4 drop-shadow-sm border rounded-lg mx-auto">
                @csrf
                <div class="flex flex-col space-y-2 mb-4">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Nama Bank</label>
                        <input type="text" name="nama_bank" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="cth: Yusuf" required />
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Nama Pemilik</label>
                        <input type="text" name="nama_pemilik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="cth: Yusuf" required />
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">No Rekening</label>
                        <input type="text" name="no_rek" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="cth: Yusuf" required />
                    </div>
                </div>
                <button class="bg-green-700 text-white w-full py-2 rounded-lg">Tambahkan</button>
            </form>
        </div>
    </div>
</x-app-layout>