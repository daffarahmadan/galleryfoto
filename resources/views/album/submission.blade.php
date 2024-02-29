@extends('layouts.dashboard')

@section('content')
<div class="m-3">
    <h5 class="mb-3">Pengajuan Album dan Foto</h5>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @forelse ($submissions as $submission)
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $submission->judul_album }}</h5>
                    <p class="card-text">{{ $submission->deskripsi }}</p>
                    <img src="{{ Storage::url($submission->foto) }}" class="card-img-top" alt="Foto Album">
                    <p>Status: {{ $submission->status }}</p>
                    <form action="{{ route('submission.approve', $submission->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Setujui</button>
                    </form>
                    <form action="{{ route('submission.reject', $submission->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Tolak</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p class="col">Tidak ada pengajuan album dan foto.</p>
        @endforelse
    </div>
</div>
@endsection
