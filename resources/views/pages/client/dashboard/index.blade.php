<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-2">
                <div class="bg-white p-4 drop-shadow-sm border sm:rounded-lg">
                    <h5>Total Penjualan</h5>
                </div>
                <div class="bg-white p-4 drop-shadow-sm border sm:rounded-lg">
                    <h5>Total Customer Order</h5>
                </div>
                <div class="bg-white p-4 drop-shadow-sm border sm:rounded-lg">
                    <h5>Total beli</h5>
                </div>
                <div class="bg-white p-4 drop-shadow-sm border sm:rounded-lg">
                    <h5>Total beli</h5>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>