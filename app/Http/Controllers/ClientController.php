<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Pembayaran;
use App\Models\Pengiriman;
use App\Models\Ternak;
use App\Models\User;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index() {
        $data = Ternak::latest()->get();
        return view('pages.client.index', compact('data'));
    }

    public function addToCart($id) {
        $user = Auth::user();
        if ($user && $user->role === '1') {
            $checkout = new Cart();
            $checkout->user_id = $user->id;
            $checkout->item_id = $id;
            $checkout->save();
            return redirect()->back();
        }
    }    

    public function showItemCart() {
        $user = Auth::user();
        $userPerId = $user->user_id = $user->id;
        $userPerRole = $user->role ==='1';
        if ($userPerId && $userPerRole) {
            $cart = Cart::where('user_id', $user->id)->with('ternak')->get();
            $totalItems = $cart->count(); // Hitung jumlah item dalam keranjang
            $totalPrice = $cart->sum(function($item) {
                return $item->ternak->harga;
            });            
            $pay = Pembayaran::all();
            $kurir = Pengiriman::all();
            return view('pages.client.cart', compact('cart','pay','kurir','totalItems','totalPrice'));
        }
    }

    public function cart(Request $request) {
        // dd($request->all());
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('ternak')->get();
        // Validasi user
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak valid.');
        }

        if ($user->role !== '1') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan ini.');
        }

        // Validasi request
        $request->validate([
            'item_id' => 'required',
            'user_id' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'jarak' => 'required',
            'no_telp' => 'required',
            'bukti_byr' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'catatan' => 'nullable',
            'angkutan' => 'required',
            'total_harga' => 'required|numeric',
        ]);

        $bukti_byr_path = null;
        if ($request->hasFile('bukti_byr')) {
            $bukti_byr_path = $request->file('bukti_byr')->store('bukti_pemb', 'public');
        }

        foreach ($cart as $item) {
            Checkout::create([
                'user_id' => $user->id,
                'item_id' => $item->ternak->id,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'jarak' => $request->jarak,
                'no_telp' => $request->no_telp,
                'bukti_byr' => $bukti_byr_path,
                'catatan' => $request->catatan,
                'angkutan' => $request->angkutan,
                'total_harga' => $request->total_harga,
            ]);
        }    
        Cart::where('user_id', $user->id)->delete();
        return redirect('/');
    } 

    public function deleteItemCart($id) {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('keranjang')->with('error', 'User not authenticated');
        }
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('item_id', $id)
                        ->first();
        if (!$cartItem) {
            return redirect()->route('keranjang')->with('error', 'Item not found in cart');
        }
        $cartItem->delete();
        return redirect()->route('keranjang')->with('success', 'Item deleted successfully');
    } 

    public function History(Request $request) {
        $user = Auth::user();
        $admins = User::where('role', '0')->get();
        $riwayat = Checkout::where('user_id', $user->id)->latest()->get();

        return view('pages.client.dashboard.riwayat', compact('riwayat','user','admins'));
    }
}