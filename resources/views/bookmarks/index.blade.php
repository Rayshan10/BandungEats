@extends('layout')

@section('konten')
<div class="container mt-4">
    <a href="/home" class="text-decoration-none text-dark">
        <i class="bi bi-arrow-left" style="font-size: 1.5rem;"></i>
    </a>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Resep Favorit</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($bookmarkedReseps->count() > 0)
        <div class="row">
            @foreach($bookmarkedReseps as $item)
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4 d-flex align-items-center">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" 
                                        class="img-fluid rounded-start w-100" 
                                        alt="{{ $item->judul }}"
                                        style="height: 225px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title">{{ $item->judul }}</h5>
                                        <div class="action-buttons">
                                            <a href="{{ route('resep.show', $item->id) }}" 
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Lihat Detail
                                            </a>
                                            <form action="{{ route('bookmarks.destroy', $item->id) }}" 
                                                method="POST" 
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger btn-sm">
                                                    <i class="fas fa-heart-broken"></i> Hapus dari Favorit
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <br>
                                    <p class="card-text">{{ Str::limit($item->deskripsi, 150) }}</p>
                                    <p class="card-text">
                                        <div class="d-flex gap-3 mb-4">
                                            <div class="border rounded p-2 bg-primary text-white">
                                                <div>{{ $item->kategori }}</div>
                                            </div>
                                            <div class="border rounded p-2">
                                                <div>{{ $item->waktu }}</div>
                                            </div>
                                            <div class="border rounded p-2">
                                                <div>{{ $item->kesulitan }}</div>
                                            </div>
                                            <div class="border rounded p-2">
                                                <div>{{ $item->porsi }}</div>
                                            </div>
                                        </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            Belum ada resep yang ditambahkan ke favorit.
            <a href="/home#resep" class="alert-link">Jelajahi resep</a>
        </div>
    @endif
</div>
@endsection