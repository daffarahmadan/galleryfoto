@extends('layouts.dashboard')

@section('content')
<div class="py-12">
    <div class="card p-4 m-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-8">Tambah Foto</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Foto</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="tanggalunggah" class="form-label">Tanggal Unggah</label>
                <input type="date" class="form-control" id="tanggalunggah" name="tanggalunggah" required>
            </div>
            <div class="mb-3">
                <label for="lokasifile" class="form-label">Pilih File</label>
                <input type="file" class="form-control" id="lokasifile" name="lokasifile" required>
            </div>
            <div class="mb-3">
                <label for="albumid" class="form-label">Album</label>
                <select class="form-select" id="albumid" name="albumid" required>
                    <option value="">Pilih Album</option>
                    @foreach($album as $albums)
                        <option value="{{ $albums->id }}">{{ $albums->namaalbum }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="userid" value="{{ Auth::id() }}">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <!-- Tampilkan gambar yang telah diunggah -->
        @if(isset($foto->lokasifile))
            <div class="mt-8">
                <h2 class="text-2xl font-semibold mb-4">Gambar yang Diunggah</h2>
                <img src="{{ asset($foto->lokasifile) }}" alt="Gambar yang diunggah" class="max-w-xs mx-auto">
            </div>
        @endif
    </div>
</div>
@endsection
