@extends('layouts.dashboard')

@section('content')
<div class="m-3">
    <h5 class="mb-3">Foto</h5>
    <!-- Tombol untuk menambahkan foto baru -->
    <a href="{{ route('foto.create') }}" class="btn btn-primary mb-4">+</a>
    
    <div class="row">
        @foreach ($album->foto as $foto)
        <div class="col-lg-4 col-md-6 mb-4">
            <!-- Kartu untuk menampilkan gambar foto -->
            <div class="card shadow">
                <img src="{{ Storage::url($foto->lokasifile) }}" class="card-img-top rounded" alt="{{ $foto->judul }}" 
                     data-toggle="modal" data-target="#modal{{ $foto->id }}" style="height: 100%; object-fit: cover;" />
                <div class="card-body">
                    <!-- Form untuk menambahkan like -->
                    <form action="{{ route('likefoto.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="foto_id" value="{{ $foto->id }}">
                        <!-- Tombol Like -->
                        <button type="submit" class="btn btn-transparent btn-like btn-lg">
                            <ion-icon name="heart-outline" style="font-size: 20px;"></ion-icon>
                            <p class="card-text" style="font-size: 10px;">{{ $foto->likeCount() }}</p>
                        </button>
                    </form>
                    <!-- Tombol Komentar -->
                    <button class="btn btn-outline-secondary btn-comment" data-toggle="modal" data-target="#modal{{ $foto->id }}">
                        Komentar <span class="badge bg-secondary">{{ count($foto->komentarfoto) }}</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal untuk menampilkan gambar dan komentar -->
        <div class="modal fade" id="modal{{ $foto->id }}" tabindex="-1" aria-labelledby="modal{{ $foto->id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- Judul modal -->
                        <h5 class="modal-title" id="modal{{ $foto->id }}Label">{{ $foto->judul }}</h5>
                        <!-- Tombol untuk menutup modal -->
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Tampilkan gambar -->
                        <img id="image-{{ $foto->id }}" src="{{ Storage::url($foto->lokasifile) }}" class="w-100 rounded" alt="{{ $foto->judul }}">

                        <!-- Daftar komentar yang telah disimpan -->
                        <div class="mt-3">
                            @foreach ($foto->komentarfoto as $komentar)
                                <!-- Tampilkan komentar -->
                                <div class="comment-container border rounded p-3 mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <strong>{{ $komentar->user->username }}</strong>
                                            <p>{{ $komentar->isikomentar }}</p>
                                            <small>{{ \Carbon\Carbon::parse($komentar->tanggalkomentar)->format('d F Y H:i') }}</small>
                                        </div>
                                        <div class="dropdown">
                                            <!-- Tombol dropdown untuk edit dan hapus komentar -->
                                            @if($komentar->userid == Auth::user()->id)
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $komentar->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    ...
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $komentar->id }}">
                                                    <!-- Form untuk menghapus komentar -->
                                                    <form action="{{ route('komentarfoto.destroy', $komentar->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">Hapus</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Form untuk menambahkan komentar baru -->
                        <form action="{{ route('komentarfoto.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="fotoid" value="{{ $foto->id }}">
                            <div class="mb-3">
                                <label for="isikomentar" class="form-label">Komentar:</label>
                                <textarea class="form-control" id="isikomentar" name="isikomentar" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                        </form>
                        
                        
                        
                        <!-- Pesan konfirmasi setelah mengirim komentar -->
                        @if(session('success'))
                            <div class="alert alert-success mt-3" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <!-- Form untuk menghapus foto -->
                        <form action="{{ route('foto.destroy', $foto->id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <!-- Tombol untuk menghapus foto -->
                            <button type="submit" class="btn btn-danger">Hapus Foto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
