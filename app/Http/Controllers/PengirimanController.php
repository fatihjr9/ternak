<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    public function index() {
        $data = Pengiriman::latest()->get();
        return view('pages.admin.kurir.index', compact('data'));
    }

    public function create() {
        return view('pages.admin.kurir.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nama' => 'required',
            'beban' => 'required',
            'jarak' => 'required',
            'biaya' => 'required',
        ]);
        Pengiriman::create($data);
        return redirect()->route('kurir-index');
    }

    public function edit($id) {
        $data = Pengiriman::findOrFail($id);
        return view('pages.admin.kurir.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'nama' => 'required',
            'beban' => 'required',
            'jarak' => 'required',
            'biaya' => 'required',
        ]);
        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->update($data);
        return redirect()->route('kurir-index');
    }

    public function destroy($id) {
        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->delete();
        return redirect()->route('kurir-index');
    }
}
