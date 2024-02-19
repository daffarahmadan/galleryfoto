<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LikeFoto;
use Illuminate\Support\Facades\Auth;

class LikefotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'foto_id' => 'required|integer',
        ]);

        // Cek apakah user sudah memberikan like untuk foto tertentu
        $existingLike = LikeFoto::where('fotoid', $request->foto_id)
                                 ->where('userid', Auth::id())
                                 ->first();

        // Jika user sudah memberikan like sebelumnya, hapus like tersebut
        if ($existingLike) {
            $existingLike->delete();
            return back()->with('success', 'Like telah dihapus.');
        }

        // Jika user belum memberikan like, tambahkan like baru
        LikeFoto::create([
            'fotoid' => $request->foto_id,
            'userid' => Auth::id(),
            'tanggallike' => now(), // Set 'tanggallike' to the current timestamp
        ]);

        return back()->with('success', 'Foto telah dilike.');
    }
}
