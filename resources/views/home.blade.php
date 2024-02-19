<!-- Meneruskan variabel $foto dari controller ke tampilan Blade -->
@php
    $foto = App\Models\Foto::all(); // Anda dapat menyesuaikan namespace dan model yang sesuai
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
    .equal-height-img {
        height: 200px; /* Atur tinggi sesuai kebutuhan */
        object-fit: cover;
    }
</style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Gallery</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('album.index') }}">Album</a>
                    </li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link">Logout</button>
                    </form>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">Foto</h2>
        <div class="row">
            @foreach($foto as $foto)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ Storage::url($foto->lokasifile) }}" class="card-img-top rounded equal-height-img" alt="{{ $foto->judul }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $foto->judul }}</h5>
                            <p class="card-text">{{ $foto->deskripsi }}</p>
                            <p class="card-text"><small class="text-muted">Tanggal Unggah: {{ $foto->created_at->format('d F Y') }}</small></p>
                            @if($foto->user && $foto->user->username)
                                <p class="card-text">By: {{ $foto->user->username }}</p>
                            @endif
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <!-- Tombol Like -->
                            <form action="{{ route('likefoto.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="foto_id" value="{{ $foto->id }}">
                                <button type="submit" class="btn btn-primary btn-sm">Like {{ $foto->likeCount() }}</button>
                            </form>
                            <!-- Tombol Komentar -->
                            <button type="button" class="btn btn-secondary btn-sm ml-auto" data-toggle="modal" data-target="#modal{{ $foto->id }}">
                                Komentar 
                                @if($foto->komentarfoto)
                                    <span class="badge badge-light">{{ $foto->komentarfoto->count() }}</span>
                                @else
                                    <span class="badge badge-light">0</span>
                                @endif
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
                                
                                <!-- Form untuk menambahkan komentar baru -->
                                <form action="{{ route('komentarfoto.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="fotoid" value="{{ $foto->id }}">
                                    <div class="mb-3">
                                        <label for="isikomentar" class="form-label">Komentar:</label>
                                        <textarea class="form-control" id="isikomentar" name="isikomentar" rows="4" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggalkomentar" class="form-label">Tanggal Komentar:</label>
                                        <input type="date" class="form-control" id="tanggalkomentar" name="tanggalkomentar" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                                </form>
                                
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
                                                        <!-- Tautan untuk mengedit komentar -->
                                                        <a class="dropdown-item" href="{{ route('komentarfoto.edit', $komentar->id) }}">Edit</a>
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
                                
                                <!-- Pesan konfirmasi setelah mengirim komentar -->
                                @if(session('success'))
                                <div class="alert alert-success mt-3" role="alert">
                                    {{ session('success') }}
                                </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
