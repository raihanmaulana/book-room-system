<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    // Menampilkan daftar ruangan
    public function index()
{
    // Ambil data ruangan dengan paginasi
    $ruangans = Ruangan::paginate(10); // Menampilkan 10 ruangan per halaman
    return view('ruangans.index', compact('ruangans'));
}

    // Menampilkan form untuk membuat ruangan baru
    public function create()
    {
        return view('ruangans.create');
    }

    // Menyimpan data ruangan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'tipe_ruangan' => 'required|string|max:255',
            'kapasitas' => 'required|string|max:255',
            'fasilitas' => 'required|string|max:255',
            'status_ruangan' => 'required|string|max:255',
        ]);

        Ruangan::create($validated);

        return redirect()->route('ruangans.index')->with('success', 'Ruangan berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit ruangan
    public function edit($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('ruangans.edit', compact('ruangan'));
    }

    // Memperbarui data ruangan
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'tipe_ruangan' => 'required|string|max:255',
            'kapasitas' => 'required|string|max:255',
            'fasilitas' => 'required|string|max:255',
            'status_ruangan' => 'required|string|max:255',
        ]);

        $ruangan = Ruangan::findOrFail($id);
        $ruangan->update($validated);

        return redirect()->route('ruangans.index')->with('success', 'Ruangan berhasil diperbarui');
    }

    // Menghapus ruangan
    public function destroy($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();

        return redirect()->route('ruangans.index')->with('success', 'Ruangan berhasil dihapus');
    }
}
