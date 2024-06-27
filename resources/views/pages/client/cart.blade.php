@extends('layouts.client')
@section('content')
<form action="{{ route('keranjang-post') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    <input type="hidden" name="total_harga" value="{{ $totalPrice }}">

    <section class="flex flex-col lg:flex-row gap-6">
        <div class="flex flex-col space-y-4 w-full">
            <div class="flex flex-col space-y-2">
                <h5 class="text-xl font-bold">Form</h5>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
                        <input type="text" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5" placeholder="cth: Yusuf"/>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Alamat</label>
                        <input type="text" name="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5" placeholder="cth: Jl. Kebangsaan 20 RT 2 RW 6"/>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Jarak lokasi ke tujuan</label>
                        <input type="text" name="jarak" id="jarak" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5" placeholder="cth: 10km"/>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">No Telp</label>
                        <input type="text" name="no_telp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5" placeholder="cth: 081xxx"/>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Bukti Pembayaran</label>
                        <input type="file" name="bukti_byr" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5"/>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Catatan ( tidak wajib )</label>
                        <textarea name="catatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5" placeholder="cth: diikat"></textarea>
                    </div>
                </div>
            </div>
            <div class="border-b"></div>
            <div class="flex flex-col space-y-2">
                <div class="flex flex-row justify-between">
                    <h5 class="text-xl font-bold">Keranjang</h5>
                </div>
                @foreach ($cart as $item)
                    <input type="hidden" name="item_id" value="{{ $item->ternak->nama }}">
                    <div class="flex flex-row items-center justify-between p-2 border rounded-lg">
                        <div class="flex flex-row items-center gap-x-4">
                            <div class="flex flex-col">
                                <h5 class="font-medium">{{ $item->ternak->nama }}</h5>
                                <div class="flex flex-row items-center divide-x text-gray-500">
                                    <p class="text-sm pr-2">{{ $item->ternak->umur }} Bulan</p>
                                    <p class="text-sm px-2">{{ $item->ternak->bobot }} kg</p>
                                    <p class="text-sm px-2">{{ $item->ternak->tinggi }} cm</p>
                                </div>
                            </div>
                        </div>
                        <button type="button" onclick="deleteCartItem({{ $item->ternak->id }})" class="p-2 text-sm bg-red-500 text-red-50 rounded-lg">Hapus</button>
                    </div>
                @endforeach
            </div>
            <div class="border-b"></div>
            <div class="flex flex-col justify-between">
                <h5 class="text-xl font-bold">Pilih Angkutan</h5>
                <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-x-2">
                    @php
                        $usia = $cart->avg(fn($item) => $item->ternak->umur);
                        $jumlah = $cart->count();
                    @endphp
                    <div class="mt-2 w-full">
                        @if ($usia < 0.8 && $jumlah === 1 || $jumlah === 2)
                            <input type="radio" id="angkutan-pickup" name="angkutan" value="Pickup" class="hidden peer" onchange="calculateTotal()"/>
                            <label for="angkutan-pickup" class="grid grid-cols-2 items-center w-full px-4 py-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-emerald-600 peer-checked:text-emerald-600">
                                <div class="flex flex-col">
                                    <div class="w-full text-lg font-semibold">Pickup</div>
                                    <div class="flex flex-row items-center divide-x">
                                        <p class="text-sm font-medium pr-4 whitespace-nowrap">Rp 100.000/Km</p>             
                                        <p class="text-sm font-medium px-4 whitespace-nowrap">100/Km</p>             
                                        <p class="text-sm font-medium pl-4 whitespace-nowrap">1000 kg</p>
                                    </div>
                                </div>
                                <div class="w-fit h-fit p-2 ml-auto text-sm font-medium rounded-lg bg-emerald-50 text-emerald-500">Rekomendasi</div>
                            </label>
                        @elseif($usia > 0.8 && $jumlah === 1)
                            <input type="radio" id="angkutan-pickup" name="angkutan" value="Pickup" class="hidden peer" onchange="calculateTotal()"/>
                            <label for="angkutan-pickup" class="grid grid-cols-2 items-center w-full px-4 py-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-emerald-600 peer-checked:text-emerald-600">
                                <div class="flex flex-col">
                                    <div class="w-full text-lg font-semibold">Pickup</div>
                                    <div class="flex flex-row items-center divide-x">
                                        <p class="text-sm font-medium pr-4 whitespace-nowrap">Rp 45.000/Km</p>             
                                        <p class="text-sm font-medium px-4 whitespace-nowrap">100/Km</p>             
                                        <p class="text-sm font-medium pl-4 whitespace-nowrap">1000 kg</p>
                                    </div>
                                </div>
                                <div class="w-fit h-fit p-2 ml-auto text-sm font-medium rounded-lg bg-emerald-50 text-emerald-500">Rekomendasi</div>
                            </label>
                        @elseif($usia < 0.8 && $jumlah === 3 ||$jumlah === 4||$jumlah === 5||$jumlah === 6)
                            <input type="radio" id="angkutan-truk-kecil" name="angkutan" value="Truk Kecil" class="hidden peer" onchange="calculateTotal()"/>
                            <label for="angkutan-truk-kecil" class="grid grid-cols-2 items-center w-full px-4 py-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-emerald-600 peer-checked:text-emerald-600">
                                <div class="flex flex-col">
                                    <div class="w-full text-lg font-semibold">Truk Kecil</div>
                                    <div class="flex flex-row items-center divide-x">
                                        <p class="text-sm font-medium pr-4 whitespace-nowrap">Rp 45.000/Km</p>             
                                        <p class="text-sm font-medium px-4 whitespace-nowrap">100/Km</p>             
                                        <p class="text-sm font-medium pl-4 whitespace-nowrap">1000 kg</p>
                                    </div>
                                </div>
                                <div class="w-fit h-fit p-2 ml-auto text-sm font-medium rounded-lg bg-emerald-50 text-emerald-500">Rekomendasi</div>
                            </label>
                        @elseif($usia > 0.8 && $jumlah === 2 || $jumlah === 3 ||$jumlah === 4)
                            <input type="radio" id="angkutan-truk-kecil" name="angkutan" value="Truk Kecil" class="hidden peer" onchange="calculateTotal()"/>
                            <label for="angkutan-truk-kecil" class="grid grid-cols-2 items-center w-full px-4 py-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-emerald-600 peer-checked:text-emerald-600">
                                <div class="flex flex-col">
                                    <div class="w-full text-lg font-semibold">Truk Kecil</div>
                                    <div class="flex flex-row items-center divide-x">
                                        <p class="text-sm font-medium pr-4 whitespace-nowrap">Rp 60.000/Km</p>             
                                        <p class="text-sm font-medium px-4 whitespace-nowrap">100/Km</p>             
                                        <p class="text-sm font-medium pl-4 whitespace-nowrap">1000 kg</p>
                                    </div>
                                </div>
                                <div class="w-fit h-fit p-2 ml-auto text-sm font-medium rounded-lg bg-emerald-50 text-emerald-500">Rekomendasi</div>
                            </label>
                        @elseif($usia < 0.8 && $jumlah === 7 || $jumlah === 8)
                            <input type="radio" id="angkutan-truk-besar" name="angkutan" value="Truk Besar" class="hidden peer" onchange="calculateTotal()"/>
                            <label for="angkutan-truk-besar" class="grid grid-cols-2 items-center w-full px-4 py-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-emerald-600 peer-checked:text-emerald-600">
                                <div class="flex flex-col">
                                    <div class="w-full text-lg font-semibold">Truk Besar</div>
                                    <div class="flex flex-row items-center divide-x">
                                        <p class="text-sm font-medium pr-4 whitespace-nowrap">Rp 60.000/Km</p>             
                                        <p class="text-sm font-medium px-4 whitespace-nowrap">100/Km</p>             
                                        <p class="text-sm font-medium pl-4 whitespace-nowrap">1000 kg</p>
                                    </div>
                                </div>
                                <div class="w-fit h-fit p-2 ml-auto text-sm font-medium rounded-lg bg-emerald-50 text-emerald-500">Rekomendasi</div>
                            </label>
                        @elseif($usia > 0.8 && $jumlah === 5 || $jumlah === 8)
                            <input type="radio" id="angkutan-truk-besar" name="angkutan" value="Truk Besar" class="hidden peer" onchange="calculateTotal()"/>
                            <label for="angkutan-truk-besar" class="grid grid-cols-2 items-center w-full px-4 py-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-emerald-600 peer-checked:text-emerald-600">
                                <div class="flex flex-col">
                                    <div class="w-full text-lg font-semibold">Truk Besar</div>
                                    <div class="flex flex-row items-center divide-x">
                                        <p class="text-sm font-medium pr-4 whitespace-nowrap">Rp 75.000/Km</p>             
                                        <p class="text-sm font-medium px-4 whitespace-nowrap">100/Km</p>             
                                        <p class="text-sm font-medium pl-4 whitespace-nowrap">1000 kg</p>
                                    </div>
                                </div>
                                <div class="w-fit h-fit p-2 ml-auto text-sm font-medium rounded-lg bg-emerald-50 text-emerald-500">Rekomendasi</div>
                            </label>
                        @endif
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white w-full lg:w-96 h-fit ml-auto border drop-shadow-md p-4 rounded-lg space-y-4">
            <div class="flex flex-col space-y-2">
                <p class="font-medium">Transfer melalui</p>
                @foreach ($pay as $item)
                    <div class="flex flex-col px-4 py-2 w-full bg-white border border-gray-200 rounded-lg">
                        <div class="w-full text-lg font-semibold">{{ $item->nama_pemilik }}</div>
                        <div class="flex flex-row items-center gap-x-2">
                            <p class="text-sm font-medium">{{ $item->nama_bank }}</p>             
                            <p class="text-sm font-medium">{{ $item->no_rek }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="border-b"></div>
            <div class="flex flex-col my-2">
                <div class="flex flex-row justify-between items-center">
                    <h5 class="font-medium">Jumlah Hewan</h5>
                    <input type="hidden" value="{{ $totalItems }}">
                </div>
                <div class="flex flex-row justify-between items-center">
                    <h5 class="font-medium">Total Harga</h5>
                    <p class="text-slate-500">Rp {{ number_format($totalPrice, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="border-b"></div>
            <div class="flex flex-col my-2">
                <div class="flex flex-row justify-between items-center">
                    <h5 class="font-medium">Kendaraan</h5>
                    <p id="selectedVehicle" class="text-slate-500"></p>
                </div>
                <div class="flex flex-row justify-between items-center">
                    <h5 class="font-medium">Jarak</h5>
                    <p id="selectedDistance" class="text-slate-500"></p>
                </div>
                <div class="flex flex-row justify-between items-center">
                    <h5 class="font-medium">Biaya Kirim</h5>
                    <p id="shippingCost" class="text-slate-500"></p>
                </div>
            </div>
            <div class="border-b"></div>
            <div class="flex flex-row justify-between items-center">
                <h5 class="font-medium">Total Harga</h5>
                <p class="text-emerald-700 font-bold" name="total_harga" id="totalAllPrice"></p>
            </div>
            <button type="submit" class="w-full py-2 bg-emerald-700 text-white rounded-lg">Checkout</button>
        </div>
    </section>
</form>
<script>
    function deleteCartItem(itemId) {
        fetch(`/del-keranjang/${itemId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            window.reload();
        })
        .catch(error => {
            console.error('There was an error!', error);
        });
    }

    function calculateTotal() {
    var selectedVehicle = document.querySelector('input[name="angkutan"]:checked');
    var distance = document.getElementById('jarak').value;
    var totalAnimalPrice = {{ $totalPrice }};   

    if (selectedVehicle && distance) {
        var vehicleName = selectedVehicle.parentNode.querySelector('.font-semibold').textContent.trim();
        var vehicleCost = parseFloat(selectedVehicle.parentNode.querySelector('.font-medium').textContent.replace(/\D/g, ''));
        var distanceInKm = parseFloat(distance.replace(/\D/g, ''));
        
        var totalCost;
        if (distanceInKm <= 10) {
            totalCost = vehicleCost;
        } else {
            var extraDistance = distanceInKm - 10;
            var additionalCost = Math.ceil(extraDistance / 10) * vehicleCost;
            totalCost = vehicleCost + additionalCost;
        }

        var totalAllPrice = totalAnimalPrice + totalCost;  

        document.getElementById('selectedVehicle').textContent = vehicleName;
        document.getElementById('selectedDistance').textContent = distance + " km";
        document.getElementById('shippingCost').textContent = 'Rp ' + totalCost.toLocaleString('id-ID');
        document.getElementById('totalAllPrice').textContent = 'Rp ' + totalAllPrice.toLocaleString('id-ID');

        // Update the total price input field
        document.querySelector('input[name="total_harga"]').value = totalAllPrice;
    }
}
</script>
@endsection