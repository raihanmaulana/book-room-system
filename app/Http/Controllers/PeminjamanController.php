<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function viewPeminjaman(Request $request)
{
    if ($request->ajax()) {
        // Mendapatkan data peminjaman dalam rentang tanggal yang diberikan
        $data = Peminjaman::whereDate('tanggal_peminjaman', '>=', $request->start)
            ->whereDate('tanggal_peminjaman', '<=', $request->end)
            ->get(['id', 'deskripsi_peminjaman', 'tanggal_peminjaman', 'jam_mulai', 'jam_selesai', 'ruangan_id', 'user_id', 'status']);
        
        // Gabungkan data peminjaman dengan nama ruangan menggunakan relasi
        $data = $data->map(function($peminjaman) {
            $peminjaman->nama_ruangan = $peminjaman->ruangan->nama_ruangan; // Ambil nama ruangan
            return $peminjaman;
        });
        
        return response()->json($data);
    }

    // Mengambil data peminjaman dan mengubahnya menjadi array
    $peminjaman = Peminjaman::all();

    // Mengambil data ruangan untuk dropdown
    $ruangans = Ruangan::all();

    // Mengirim data peminjaman dan ruangans ke view
    return view('calendar.index', compact('peminjaman', 'ruangans'));
}



    public function ajax(Request $request)
    {
        switch ($request->type) {
            case 'add':
                // Store new peminjaman record in the database
                $peminjaman = Peminjaman::create([
                    'deskripsi_peminjaman' => $request->deskripsi_peminjaman,
                    'tanggal_peminjaman' => $request->tanggal_peminjaman,
                    'jam_mulai' => $request->jam_mulai,
                    'jam_selesai' => $request->jam_selesai,
                    'ruangan_id' => $request->ruangan_id,
                    'user_id' => $request->user_id,
                    'status' => $request->status,
                ]);

                return response()->json($peminjaman);
                break;

            case 'update':
                // Update an existing peminjaman record
                $peminjaman = Peminjaman::find($request->id)->update([
                    'deskripsi_peminjaman' => $request->deskripsi_peminjaman,
                    'tanggal_peminjaman' => $request->tanggal_peminjaman,
                    'jam_mulai' => $request->jam_mulai,
                    'jam_selesai' => $request->jam_selesai,
                    'ruangan_id' => $request->ruangan_id,
                    'user_id' => $request->user_id,
                    'status' => $request->status,
                ]);

                return response()->json($peminjaman);
                break;

            case 'delete':
                // Delete a peminjaman record
                $peminjaman = Peminjaman::find($request->id)->delete();

                return response()->json($peminjaman);
                break;

            default:
                break;
        }
    }

    public function index()
    {
        $peminjamans = Peminjaman::paginate(10);
        return view('peminjaman.index', compact('peminjamans'));
    }

    // Menampilkan form untuk membuat peminjaman baru
    public function create()
    {
        return view('peminjaman.create');
    }

    // Menyimpan data peminjaman baru
    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'deskripsi_peminjaman' => 'required|string',
            'tanggal_peminjaman' => 'required|date',
            'ruangan_id' => 'required|exists:ruangans,id',
            'user_id' => 'required|exists:users,id',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        Peminjaman::create([
            'deskripsi_peminjaman' => $request->deskripsi_peminjaman,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'ruangan_id' => $request->ruangan_id,
            'user_id' => $request->user_id,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => 'Pending',
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dibuat.');
    }

    // Menampilkan form untuk mengedit peminjaman
    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('peminjaman.edit', compact('peminjaman'));
    }

    // Memperbarui data peminjaman
    public function update(Request $request, $id)
    {
        $request->validate([
            'deskripsi_peminjaman' => 'required|string',
            'tanggal_peminjaman' => 'required|date',
            'ruangan_id' => 'required|exists:ruangans,id',
            'user_id' => 'required|exists:users,id',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|date',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'deskripsi_peminjaman' => $request->deskripsi_peminjaman,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'ruangan_id' => $request->ruangan_id,
            'user_id' => $request->user_id,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diperbarui.');
    }

    // Menghapus data peminjaman
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus.');
    }

    public function updateStatus(Request $request, $id)
    {
        // Verifikasi apakah user adalah admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('peminjaman.index')->with('error', 'Unauthorized action');
        }

        // Validasi status yang diterima
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak',
        ]);

        // Cari peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($id);

        // Update status peminjaman
        $peminjaman->status = $request->status;
        $peminjaman->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('peminjaman.index')->with('success', 'Status peminjaman berhasil diperbarui');
    }
}
