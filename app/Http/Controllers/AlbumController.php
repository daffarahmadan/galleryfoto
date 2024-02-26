<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function index()
    {
        // Mendapatkan id pengguna yang saat ini masuk
        $userId = Auth::id();
        
        // Menyaring album berdasarkan id pengguna
        $album = Album::where('userid', $userId)->get();
        
        return view('album.index', compact('album'));
    }

    public function show($id)
    {
        $album = Album::findOrFail($id);
        return view('album.show', compact('album'));
    }
    
    public function create()
    {
        return view('album.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaalbum'=>'required',
            'tanggaldibuat'=>'required',
            'deskripsi'=>'required'
        ],[
            'namaalbum.required'=>'Nama Album harus diisi!',
            'tanggadibuat.required'=>'Nama Album harus diisi!',
            'deskripsi.required'=> 'Deskripsi harus diisi'
        ]);

        $userId = Auth::user()->id;

        Album::create([
            'namaalbum'=> $request->namaalbum,
            'tanggaldibuat'=> $request->tanggaldibuat,
            'deskripsi'=> $request->deskripsi,
            'userid'=> $userId
        ]);

        return redirect()->route('album.index')->with('success','Album berhasil dibuat!');
    }

    public function edit($id)
    {
        // Temukan album berdasarkan ID yang diberikan
        $album = Album::findOrFail($id);
        
        // Kembalikan view edit dengan data album yang ditemukan
        return view('album.edit', compact('album'));
    }
    
    public function update(Request $request, $id) // tambahkan $id sebagai parameter
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'namaalbum' => 'required',
            'deskripsi' => 'required',
            'tanggaldibuat' => 'required',
            'userid' => 'required|integer',
        ]);
    
        // Temukan album berdasarkan ID yang diberikan
        $album = Album::findOrFail($id);
    
        // Update data album dengan data yang dikirimkan dari form
        $album->update([
            'namaalbum'     => $request->namaalbum,
            'deskripsi'     => $request->deskripsi,
            'tanggaldibuat' => $request->tanggaldibuat,
            'userid'        => $request->userid,
        ]);
    
        // Redirect ke halaman index album dengan pesan sukses
        return redirect()->route('album.index')->with('success', 'Album berhasil diubah!');
    }

    public function destroy($id)
    {
        $album = Album::find($id);
        if (!$album) {
            return redirect()->route('album.index')->with('error', 'Album tidak ditemukan');
        }

        // Hapus foto yang terkait dengan album ini
        foreach ($album->foto as $foto) {
            $foto->delete();
        }

        // Hapus album
        $album->delete();

        return redirect()->route('album.index')->with('success','Album berhasil dihapus');


    }
}
