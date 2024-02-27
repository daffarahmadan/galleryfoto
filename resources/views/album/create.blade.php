@extends('layouts.dashboard')

@section('content')

<div class="m-3 ">
    <form class="card p-4 m-4" action="{{ route('album.store') }}" method="POST">
        @csrf
        <h4 class="mb-4">Create Album</h4>
        <div class="mb-3">
          <label for="inputNamaAlbum" class="form-label">Nama Album</label>
          <input type="text" name="namaalbum" class="form-control" id="inputNamaAlbum" placeholder="Nama Album">
        </div>
        <div class="mb-3">
          <label for="inputDeskripsi" class="form-label">Deskripsi</label>
          <textarea class="form-control" name="deskripsi" id="inputDeskripsi" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
