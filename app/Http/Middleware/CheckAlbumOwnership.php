<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Album;
use Symfony\Component\HttpFoundation\Response;

class CheckAlbumOwnership
{
    public function handle(Request $request, Closure $next)
    {
        $albumId = $request->route('id'); // Mengambil ID album dari route
        $album = Album::findOrFail($albumId); // Mendapatkan data album

        // Memeriksa apakah pengguna yang sedang masuk adalah pemilik album
        if ($album->userid !== auth()->id()) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke album ini.');
        }

        return $next($request);
    }
}
