@extends('layouts.dashboard')

@section('content')
<div class="m-3">
    <h5 class="mb-3">Album</h5>
    <!-- Tombol untuk menambahkan album baru -->
    @if (Gate::allows('admin'))
    <a href="{{ route('album.create') }}" class="btn btn-primary mb-4">+</a>
    @endif

     <!-- Formulir Pengajuan Album dan Foto (Hanya Ditampilkan untuk User Biasa) -->
    @if (!Gate::allows('admin'))
        <form method="POST" action="{{ route('submision.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Judul Album -->
            <div class="mb-3">
                <label for="namaalbum" class="form-label">Judul Album</label>
                <input type="text" class="form-control" id="namaalbum" name="namaalbum" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
            </div>

            <!-- Unggah Foto -->
            <div class="mb-3">
                <label for="foto" class="form-label">Unggah Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" required>
            </div>

            <button type="submit" class="btn btn-primary">Ajukan</button>
        </form>
    @endif
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    @forelse ($album as $index => $albums)
    <div class="col">
        <div class="bg-white rounded-lg overflow-hidden shadow-md border"> 
            @if($albums->foto->isNotEmpty())
            <a href="{{ route('album.show', $albums->id) }}"> <!-- Tautkan ke tampilan album -->
                @foreach($albums->foto as $foto)
                    <img class="w-full h-48 object-cover object-center" src="{{ Storage::url($foto->lokasifile) }}" alt="Foto Album" style="max-width: 100%;"> <!-- Tampilkan gambar cover album -->
                    @break <!-- Hentikan loop setelah menampilkan satu foto -->
                @endforeach
            </a>
            @else
            <a href="{{ route('album.show', $albums->id) }}"> <!-- Tautkan ke tampilan album -->
                <img class="w-full h-48 object-cover object-center" src="{{ asset('placeholder.jpg') }}" alt="Foto Album" style="max-width: 100%;"> <!-- Placeholder untuk album tanpa foto -->
            </a>
            @endif
            <div class="p-4">
                <h2 class="font-semibold text-xl mb-2">{{ $albums->namaalbum }}</h2>
                <p class="text-gray-700">{{ $albums->deskripsi }}</p>
            </div>
            <div class="flex justify-between items-center px-4 py-2 bg-gray-100">
                <p class="text-sm text-gray-600">Tanggal dibuat: {{ $albums->tanggaldibuat }}</p>
                <div class="flex space-x-2">
                    <a href="{{ route('album.edit', $albums->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('album.destroy', $albums->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <p class="col">Tidak ada album.</p>
    @endforelse
    </div>
</div>
@endsection
