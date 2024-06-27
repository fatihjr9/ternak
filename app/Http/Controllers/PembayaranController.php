<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index() {
        $data = Pembayaran::latest()->get();
        return view('pages.admin.payment.index', compact('data'));
    }

    public function create() {
        return view('pages.admin.payment.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nama_bank' => 'required',
            'nama_pemilik' => 'required',
            'no_rek' => 'required',
        ]);
        Pembayaran::create($data);
        return redirect()->route('payment-index');
    }

    public function edit($id) {
        $data = Pembayaran::findOrFail($id);
        return view('pages.admin.kurir.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'nama_bank' => 'required',
            'nama_pemilik' => 'required',
            'no_rek' => 'required',
        ]);
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update($data);
        return redirect()->route('payment-index');
    }

    public function destroy($id) {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();
        return redirect()->route('payment-index');
    }
}
