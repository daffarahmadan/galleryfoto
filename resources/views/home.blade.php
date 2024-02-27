<!-- Meneruskan variabel $foto dari controller ke tampilan Blade -->
@php
    $foto = App\Models\Foto::all(); // Anda dapat menyesuaikan namespace dan model yang sesuai
    $foto = App\Models\Foto::orderBy('created_at', 'desc')->get();
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
    .card:hover {
        transform: scale(1.1); /* Ubah skala gambar */
        transition: transform 0.3s ease; /* Tambahkan transisi */
    }
    .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }
</style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">DREAMPHOTO</a>
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
                            <!-- Form untuk menambahkan like -->
                            <form action="{{ route('likefoto.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="foto_id" value="{{ $foto->id }}">
                                <!-- Tombol Like -->
                                <button type="submit" class="btn btn-transparent btn-like btn-lg">
                                    <ion-icon name="heart-outline" style="font-size: 24px;"></ion-icon>
                                    <p class="card-text" style="font-size: 10px;">{{ $foto->likeCount() }}</p>
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
                <!-- Modal untuk menampilkan gambar dan komentar -->
                <div class="modal fade" id="modal{{ $foto->id }}" tabindex="-1" aria-labelledby="modal{{ $foto->id }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <!-- username user -->
                                @if($foto->user && $foto->user->username)
                                    <h5 class="card-text">{{ $foto->user->username }}</h5>
                                @endif
                                <!-- Tombol untuk menutup modal -->
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Tampilkan gambar -->
                                <img id="image-{{ $foto->id }}" src="{{ Storage::url($foto->lokasifile) }}" class="w-100 rounded" alt="{{ $foto->judul }}">
                                <!-- Judul modal -->
                                <h5 class="modal-title mt-4" id="modal{{ $foto->id }}Label">{{ $foto->judul }}</h5>
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
                                
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="footer py-3 mt-auto footer-light bg-light">
        <div class="container text-center">
            <span class="text-muted">DREAMLINES Company</span>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- template icon -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

   
    
</body>
</html>
