<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komentarfoto;
use App\Models\Foto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class KomentarfotoController extends Controller
{
    public function index()
    {
        $komentarfoto = Komentarfoto::all();
        return view('komentarfoto.index', compact('komentarfoto'));
    }

    public function create($fotoid)
    {
        
        $komentarfoto = Komentarfoto::findOrFail($fotoid);
        return view('album.show', compact('komentarfoto'));
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'fotoid' => 'required|exists:foto,id', 
            'isikomentar' => 'required',
        ]);
    
        // Simpan komentar ke dalam database
        Komentarfoto::create([
            'fotoid' => $request->fotoid,
            'userid' => Auth::id(), // Perbaiki penulisan variabel menjadi Auth::id()
            'isikomentar' => $request->isikomentar,
            'tanggalkomentar' => Carbon::now(),
        ]);
    
        // Redirect ke halaman sebelumnya
        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $komentarfoto = Komentarfoto::findOrFail($id);
        return view('album.show', compact('komentarfoto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'isikomentar' => 'required',
            'tanggalkomentar' => 'required',
        ]);
    
        $komentarfoto = Komentarfoto::findOrFail($id);
        $komentarfoto->update([
            'isikomentar' => $request->isikomentar,
            'tanggalkomentar' => $request->tanggalkomentar,
        ]);
    
        return redirect()->back()->with('success', 'Komentar berhasil diubah!');
    
    }

    public function destroy($id)
    {
        $komentarfoto = Komentarfoto::findOrFail($id);
        $komentarfoto->delete();

        return redirect()->back()->with(['success' => '']);
    }
}
