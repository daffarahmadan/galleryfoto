@extends('dashboard')

@section('content')
<div class="m-3">
    @isset($foto)
    <div class="max-w-sm mx-auto">
        <form action="{{ route('foto.update', $foto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-5">
                <label for="judul" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nama Foto</label>
                <input type="text" id="judul" name="judul" value="{{ $foto->judul }}" class="form-control" required>
            </div>
            
            <div class="mb-5">
                <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" required>{{ $foto->deskripsi }}</textarea>
            </div>
            
            <div class="mb-5">
                <label for="tanggalunggah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Tanggal Unggah</label>
                <input type="date" id="tanggalunggah" name="tanggalunggah" value="{{ $foto->tanggalunggah }}" class="form-control" required>
            </div>
            
            <div class="mb-5">
                <label for="lokasifile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Lokasi File</label>
                <input type="file" id="lokasifile" name="lokasifile" class="form-control" required>
            </div>
            
            <div class="mb-5">
                <label for="albumid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Album ID</label>
                <input type="text" id="albumid" name="albumid" value="{{ $foto->albumid }}" class="form-control" required>
            </div>
            
            <div class="mb-5">
                <label for="userid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">User ID</label>
                <input type="text" id="userid" name="userid" value="{{ $foto->userid }}" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-full">Simpan</button>
        </form>
    </div>
    @endisset
</div>
@endsection
