<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CustomerAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\TernakController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ClientController::class, 'index']);

Route::get('/pembayaran-sukses', function () {
    return view('pages.client.pay');
})->name('pembayaran');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified'
    ])->group(function () {
        
        Route::group(['middleware' => 'role:0'], function () {
        Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard-index');
        // Kurir
        Route::get('/kurir-pengiriman', [PengirimanController::class, 'index'])->name('kurir-index');
        Route::get('/kurir-pengiriman/tambah', [PengirimanController::class, 'create'])->name('kurir-create');
        Route::post('/kurir-pengiriman/tambah', [PengirimanController::class, 'store'])->name('kurir-store');
        Route::get('/kurir-pengiriman/edit/{id}', [PengirimanController::class, 'edit'])->name('kurir-edit');
        Route::put('/kurir-pengiriman/edit/{id}', [PengirimanController::class, 'update'])->name('kurir-update');
        Route::delete('/kurir-pengiriman/{id}', [PengirimanController::class, 'destroy'])->name('kurir-destroy');
        // Customer
        Route::get('/customer', [CustomerAdminController::class,'index'])->name('customer-index');
        // Metode Pembayaran
        Route::get('/metode-pembayaran', [PembayaranController::class, 'index'])->name('payment-index');
        Route::get('/metode-pembayaran/tambah', [PembayaranController::class, 'create'])->name('payment-create');
        Route::post('/metode-pembayaran/tambah', [PembayaranController::class, 'store'])->name('payment-store');
        Route::get('/metode-pembayaran/edit/{id}', [PembayaranController::class, 'edit'])->name('payment-edit');
        Route::put('/metode-pembayaran/edit/{id}', [PembayaranController::class, 'update'])->name('payment-update');
        Route::delete('/metode-pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('payment-destroy');
        });
        
        Route::group(['middleware' => 'role:1'], function () {
            Route::get('/dashboard', function () { return view('pages.client.dashboard.index');})->name('dashboard-client-index');
            Route::get('/riwayat', [ClientController::class, 'History'])->name('riwayat-index');
            Route::get('/tambah-keranjang/{id}', [ClientController::class, 'addToCart'])->name('addCart');
            Route::get('/keranjang', [ClientController::class,'showItemCart'])->name('keranjang');
            Route::post('/keranjang', [ClientController::class,'cart'])->name('keranjang-post');
            Route::delete('/del-keranjang/{id}', [ClientController::class,'deleteItemCart'])->name('hapus-keranjang');
            
            // Ternak
            Route::get('/hewan-ternak', [TernakController::class,'index'])->name('ternak-index');
            Route::get('/hewan-ternak/tambah', [TernakController::class,'create'])->name('ternak-create');
            Route::post('/hewan-ternak/tambah', [TernakController::class,'store'])->name('ternak-store');
            Route::get('/hewan-ternak/edit/{id}', [TernakController::class,'edit'])->name('ternak-edit');
            Route::put('/hewan-ternak/edit/{id}', [TernakController::class,'update'])->name('ternak-update');
            Route::delete('/hewan-ternak/{id}', [TernakController::class,'destroy'])->name('ternak-destroy');
        });
    });
});
Route::get('redirects', [HomeController::class, 'index']);
