<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\Event;



namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Peminjaman; // Assuming you have a Peminjaman model
use Illuminate\Http\Request;

class FullCalenderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Peminjaman::whereDate('tanggal_peminjaman', '>=', $request->start)
                ->whereDate('tanggal_peminjaman', '<=', $request->end)
                ->get(['id', 'title', 'tanggal_peminjaman', 'jam_mulai', 'jam_selesai', 'ruangan_id', 'user_id']); // Fetch relevant fields

            return response()->json($data);
        }

        return view('calendar.index');
    }

    public function ajax(Request $request)
    {
        switch ($request->type) {
            case 'add':
                // Store new peminjaman record in the database
                $peminjaman = Peminjaman::create([
                    'title' => $request->title,
                    'tanggal_peminjaman' => $request->tanggal_peminjaman,
                    'jam_mulai' => $request->jam_mulai,
                    'jam_selesai' => $request->jam_selesai,
                    'ruangan_id' => $request->ruangan_id,
                    'user_id' => $request->user_id,
                ]);

                return response()->json($peminjaman);
                break;

            case 'update':
                // Update an existing peminjaman record
                $peminjaman = Peminjaman::find($request->id)->update([
                    'title' => $request->title,
                    'tanggal_peminjaman' => $request->tanggal_peminjaman,
                    'jam_mulai' => $request->jam_mulai,
                    'jam_selesai' => $request->jam_selesai,
                    'ruangan_id' => $request->ruangan_id,
                    'user_id' => $request->user_id,
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
}


