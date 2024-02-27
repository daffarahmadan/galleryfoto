@extends('layouts.dashboard')

@section('content')
<div class="m-3 ">
    <form class="card p-4 m-4" action="{{ route('album.edit', $album->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Tambahkan method PUT untuk update data -->
        <h4 class="mb-4">Edit Album</h4>
        <div class="mb-3">
          <label for="namaalbum" class="form-label">Nama Album</label>
          <input type="text" name="namaalbum" class="form-control" id="namaalbum" placeholder="Nama Album" value="{{ $album->namaalbum }}">
        </div>
        <div class="mb-3">
          <label for="tanggaldibuat" class="form-label">Tanggal</label>
          <input type="date" name="tanggaldibuat" class="form-control" id="tanggaldibuat" value="{{ $album->tanggaldibuat }}">
        </div>
        <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi</label>
          <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5">{{ $album->deskripsi }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
