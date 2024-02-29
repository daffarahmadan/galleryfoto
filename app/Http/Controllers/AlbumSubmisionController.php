<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlbumSubmission;

class AlbumSubmisionController extends Controller
{
    public function index()
    {
        $submisions = AlbumSubmision::all();
        return view('submissions.index', compact('submissions'));
    }
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan dari formulir
        $request->validate([
            'user_id' => 'required',
            'judul_album' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required',
        ]);

        // Simpan data pengajuan album baru ke dalam database
        AlbumSubmission::create([
            'user_id' => $request->user_id,
            'judul_album' => $request->judul_album,
            'deskripsi' => $request->deskripsi,
            'foto' => $request->foto->store('photos'), // Simpan foto di dalam direktori 'photos'
            'status' => 'pending', // Set status menjadi 'pending' karena pengajuan belum disetujui atau ditolak
        ]);

        // Redirect kembali ke halaman indeks pengajuan album dengan pesan sukses
        return redirect()->route('album.index')->with('success', 'Pengajuan album berhasil disimpan.');
    }

    public function approve($id)
    {
        $submision = AlbumSubmision::findOrFail($id);
        $submision->status = 'approved';
        $submision->save();
        return redirect()->route('submissions.index')->with('success', 'Pengajuan album disetujui.');
    }

    public function reject($id)
    {
        $submision = AlbumSubmision::findOrFail($id);
        $submision->status = 'rejected';
        $submision->save();
        return redirect()->route('submissions.index')->with('success', 'Pengajuan album ditolak.');
    }
}
