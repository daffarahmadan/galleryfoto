<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Carbon\Carbon;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    public function index()
    {
        $foto = Foto::all();
        return view('home', compact('foto'));
    }

    public function create()
    {
       // Mendapatkan semua album pengguna yang sedang masuk
        $userId = Auth::id();
        $album = Album::where('userid', $userId)->get();

        return view('foto.create', compact('album'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'lokasifile' => 'required|image', // Pastikan file yang diunggah adalah gambar
        ]);

        // Simpan file yang diunggah ke penyimpanan
        $lokasiFile = $request->file('lokasifile')->store('public/img');

        // Dapatkan ID album yang akan digunakan untuk menyimpan foto
        $albumId = $request->albumid;

        // Dapatkan ID pengguna yang sedang masuk
        $userId = Auth::id();

        // Buat entri baru di database
        $foto = Foto::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggalunggah' => Carbon::now(),
            'lokasifile' => $lokasiFile, // Simpan lokasi file di database
            'albumid' => $albumId, // Gunakan ID album yang sesuai
            'userid' => $userId, // Gunakan ID pengguna yang sedang masuk
        ]);

        return redirect()->route('album.show', $albumId)->with('success', 'Foto berhasil ditambahkan.');
    }

    public function destroy(Request $request, $id)
    {
        $foto = Foto::findOrFail($id);
        $foto->delete();
        return redirect()->back()->with(['success' => '']);
        // // Periksa apakah foto milik album yang sesuai
        // if ($foto->albumid == $request->albumid && $foto->userid == Auth::id()) {
        //     // Hapus file dari penyimpanan sebelum menghapus data dari database
        //     Storage::delete($foto->lokasifile);

        //     $foto->delete();

        // } else {
        //     return redirect()->route('foto.index')->with(['error' => 'Anda tidak memiliki izin untuk menghapus foto ini.']);
        // }
    }
}
