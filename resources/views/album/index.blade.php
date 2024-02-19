@extends('dashboard')

@section('content')
<div class="m-3">
    <a href="{{ route('album.create') }}" class="btn btn-primary mb-4">+</a>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    @forelse ($album as $index => $albums)
    <div class="col">
        <div class="bg-white rounded-lg overflow-hidden shadow-md border"> <!-- Menambahkan class border -->
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
