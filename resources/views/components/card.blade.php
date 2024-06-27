<div class="bg-white border border-gray-200 rounded-lg shadow">
    <img class="rounded-t-lg h-52 w-full object-cover" src="{{ asset('storage/' . $data->gambar[0]) }}" alt="{{ $data->nama }}" />
    <div class="p-4">
        <h5 class="text-lg font-semibold text-gray-900">{{ $data->nama }}</h5>
        <div class="flex flex-row divide-x my-2 text-gray-400">
            <p class="text-sm font-medium pr-4">{{ $data->umur }} Tahun</p>
            <p class="text-sm font-medium px-4">{{ $data->bobot }} kg</p>             
            <p class="text-sm font-medium pl-4">{{ $data->tinggi }} cm</p>             
        </div>
        <h5 class="font-medium text-gray-900 border-y py-2">Penjual : {{ $data->user->name }}</h5>
        <div class="flex flex-col mt-2">
            <span class="text-xl font-bold text-gray-900 mb-1">Rp {{ number_format($data->harga, 0, ',', '.') }}</span>      
            <a href="{{ route('addCart', $data->id) }}" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 text-center">Tambahkan</a>
        </div>
    </div>
</div>