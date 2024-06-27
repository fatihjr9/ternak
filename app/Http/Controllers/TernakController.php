<?php

namespace App\Http\Controllers;

use App\Models\Ternak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TernakController extends Controller
{
    public function index() {
        $user = Auth::user();
        $data = Ternak::where('user_id', $user->id)->latest()->get();
        return view('pages.client.ternak.index', compact('data', 'user'));
    }    

    public function create() {
        return view('pages.client.ternak.create');
    }

    public function store(Request $request) {
        $user = Auth::user();
        $data = $request->validate([
            'nama' => 'required',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4098',
            'umur' => 'required',
            'bobot' => 'required',
            'harga' => 'required',
            'tinggi' => 'required',
        ]);

        $gambar = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('ternak_gambar', 'public');
                $gambar[] = $path;
            }
        }

        Ternak::create([
            'user_id' => $user->id,
            'gambar' => $gambar,
            'nama' => $data['nama'],
            'umur' => $data['umur'],
            'bobot' => $data['bobot'],
            'tinggi' => $data['tinggi'],
            'harga' => $data['harga']
        ]);

        return redirect()->route('ternak-index');
    }

    public function edit($id) {
        $data = Ternak::findOrFail($id);
        return view('pages.client.ternak.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $ternak = Ternak::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'umur' => 'required',
            'bobot' => 'required',
            'harga' => 'required',
            'tinggi' => 'required',
        ]);

        $gambar = $ternak->gambar ?? [];
        if ($request->hasFile('gambar')) {
            // Delete old images if exist
            foreach ($gambar as $file) {
                Storage::disk('public')->delete($file);
            }
            $gambar = [];
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('ternak_gambar', 'public');
                $gambar[] = $path;
            }
        }

        $ternak->update([
            'gambar' => $gambar,
            'nama' => $data['nama'],
            'umur' => $data['umur'],
            'bobot' => $data['bobot'],
            'tinggi' => $data['tinggi'],
            'harga' => $data['harga']
        ]);

        return redirect()->route('ternak-index')->with('success', 'Data ternak berhasil diupdate.');
    }

    public function destroy($id) {
        $ternak = Ternak::findOrFail($id);

        // Delete images from storage
        if ($ternak->gambar) {
            foreach ($ternak->gambar as $file) {
                Storage::disk('public')->delete($file);
            }
        }
        // Delete the record from database
        $ternak->delete();
        return redirect()->route('ternak-index')->with('success', 'Data ternak berhasil dihapus.');
    }
}
