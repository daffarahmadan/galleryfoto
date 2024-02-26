@extends('layouts.dashboard')

@section('content')
<div class="m-3">
    <a href="{{ route('foto.create') }}" class="btn btn-primary mb-4">Tambah Data</a>
    <div class="row">
    @forelse ($foto as $fotos)
    <div class="col-lg-4 col-md-6 mb-4">
        <img src="{{ Storage::url($fotos->lokasifile) }}" class="w-100 shadow-1-strong rounded mb-4" alt="{{ $fotos->judul }}" />
        <div class="d-flex justify-content-center">
            <a href="{{ route('foto.edit', $fotos->id) }}" class="btn btn-primary me-2">Edit</a>
            <form action="{{ route('foto.destroy', $fotos->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
    @empty
    <p class="col">Foto saat ini kosong.</p>
    @endforelse
    </div>
</div>
@endsection
