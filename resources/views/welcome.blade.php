@php
    // Mendapatkan album ID dari parameter rute
    $albumid = request()->route('albumid');
    // Mengambil data album berdasarkan album ID
    $album = App\Models\Album::find($albumid);
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Title Here</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .navbar {
            background-color: #000000; /* Warna hitam */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: #ffffff; /* Teks putih */
        }
        .navbar-brand {
            color: #ffffff; /* Teks putih */
        }
        .footer {
            background-color: #ffffff;
            color: #888;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }
        .album-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            overflow: hidden;
        }
        .album-card:hover {
            transform: translateY(-5px);
        }
        .album-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }
        .album-info {
            padding: 20px;
        }
        .album-title {
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 10px;
        }
        .album-description {
            color: #666;
            font-size: 16px;
        }
        .btn-register {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-register:hover {
            background-color: #0056b3;
        }
        .btn-login {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
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
        <a class="navbar-brand">Dreamlines company</a>
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
<div class="row">
    @foreach ($album->foto as $foto)
    <div class="col-lg-4 col-md-6 mb-4">
        <!-- Kartu untuk menampilkan gambar foto -->
        <div class="card shadow">
            <img src="{{ Storage::url($foto->lokasifile) }}" class="card-img-top rounded" alt="{{ $foto->judul }}" 
                 data-toggle="modal" data-target="#modal{{ $foto->id }}" style="height: 100%; object-fit: cover;" />
            <div class="card-body">
                <!-- Tombol untuk "Like" dan "Komentar" -->
                <div class="d-flex justify-content-between">
                    <!-- Tombol Like -->
                    <button class="btn btn-transparent btn-like btn-lg" data-foto-id="{{ $foto->id }}">
                        <ion-icon name="happy-outline" style="font-size: 24px;"></ion-icon>
                    </button>
                    <!-- Tombol Komentar -->
                    <button class="btn btn-outline-secondary btn-comment" data-toggle="modal" data-target="#modal{{ $foto->id }}">
                        Komentar <span class="badge bg-secondary">{{ count($foto->komentarfoto) }}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk menampilkan gambar dan komentar -->
    <div class="modal fade" id="modal{{ $foto->id }}" tabindex="-1" aria-labelledby="modal{{ $foto->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Konten modal -->
            </div>
        </div>
    </div>
    @endforeach
</div>
@endauth <!-- Akhir dari cek autentikasi -->
@guest <!-- Jika pengguna belum login -->
<div class="container">
    <div class="alert alert-warning" role="alert">
        Silakan login terlebih dahulu untuk melihat konten ini.
    </div>
</div>
@endguest <!-- Akhir dari cek guest -->


<footer class="footer py-3 mt-auto">
    <div class="container text-center">
        <span class="text-muted">Place sticky footer content here.</span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
