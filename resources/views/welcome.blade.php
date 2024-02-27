<!-- @php
    $album = Auth::user()->album; // Mengambil album yang terkait dengan pengguna yang sedang login
@endphp -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dreamlines Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .navbar {
            background-color: #000000;
            color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            color: #ffffff;
        }
        .footer {
            background-color: #f8f9fa;
            color: #888;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }
        .btn-register {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-register:hover {
            background-color: #0056b3;
        }
        .btn-login {
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-login:hover {
            background-color: #218838;
        }
    </style>
</head>
<body class="d-flex flex-column vh-100">

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Dreamlines Company</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- You can add more navbar links here if needed -->
            </ul>
            <div class="d-flex">
                <a href="{{ route('register') }}" class="btn btn-register me-2">Register</a>
                <a href="{{ route('login') }}" class="btn btn-login">Login</a>
            </div>
        </div>
    </div>
</nav>

@auth <!-- Cek apakah pengguna sudah login -->
<div class="container mt-4">
    <div class="row">
        @foreach ($album as $singleAlbum) <!-- Iterasi terhadap setiap objek Album -->
            @foreach ($singleAlbum->foto as $foto) <!-- Iterasi terhadap setiap foto dalam album -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <!-- Card untuk menampilkan gambar foto -->
                    <div class="card shadow">
                        <img src="{{ Storage::url($foto->lokasifile) }}" class="card-img-top" alt="{{ $foto->judul }}" 
                            data-toggle="modal" data-target="#modal{{ $foto->id }}" />
                        <div class="card-body">
                            <!-- Tombol untuk "Like" dan "Komentar" -->
                            <div class="d-flex justify-content-between">
                                <!-- Form untuk menambahkan like -->
                                <form action="{{ route('likefoto.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="foto_id" value="{{ $foto->id }}">
                                    <!-- Tombol Like -->
                                    <button type="submit" class="btn btn-transparent btn-like btn-lg">
                                        <ion-icon name="heart-outline" style="font-size: 24px;"></ion-icon>
                                        <p class="card-text">{{ $foto->likeCount() }}</p>
                                    </button>
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
        @endforeach
    </div>
</div>
@endauth <!-- Akhir dari cek autentikasi -->
@guest <!-- Jika pengguna belum login -->
<div class="container mt-4">
    <div class="alert alert-warning" role="alert">
        Silakan login terlebih dahulu untuk melihat konten ini.
    </div>
</div>
@endguest <!-- Akhir dari cek guest --> 

<footer class="footer py-3 mt-auto">
    <div class="container text-center">
        <span class="text-muted">DREAMLINES Company</span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 <!-- template icon -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
