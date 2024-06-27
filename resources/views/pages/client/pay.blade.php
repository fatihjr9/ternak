@extends('layouts.client')
@section('content')
<div class="bg-white p-4 w-96 mx-auto rounded-lg border drop-shadow-sm">
    <img class="w-full p-4 rounded-lg bg-slate-100 mx-auto" src="{{ asset('acc.svg') }}" alt="">
    <div class="flex flex-col text-center">
        <h5 class="text-xl font-bold">Pembayaran Berhasil</h5>
        <p class="text-gray-500 text-sm">Pesanan kamu dapat di cek melalui riwayat</p>
    </div>
    <a href="{{ url('/') }}" class="text-white bg-green-700 w-full py-2 rounded-lg">Kembali</a>
</div>
@endsection