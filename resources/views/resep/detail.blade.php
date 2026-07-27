@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <nav class="mb-4">
        <a href="{{ route('resep.tampil') }}" class="text-decoration-none">
            Semua Resep
        </a>

        <span class="text-muted">/</span>
        <span>{{ $resep->judul }}</span>
    </nav>

    <div class="card border-0 shadow-sm rounded-4 mb-5">
        <div class="card-body p-4">
            <div class="row align-items-center g-4">
                <!-- FOTO -->
                <div class="col-lg-6">
                    <img
                        src="{{ asset('storage/'.$resep->gambar) }}"
                        class="img-fluid recipe-image w-100"
                        alt="{{ $resep->judul }}">
                </div>

                <!-- INFORMASI -->
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold mb-3">
                        {{ $resep->judul }}
                    </h1>

                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="badge bg-primary info-badge">
                            <i class="bi bi-tag-fill"></i>
                            {{ $resep->kategori }}
                        </span>

                        <span class="badge bg-success info-badge">
                            <i class="bi bi-bar-chart-fill"></i>
                            {{ $resep->kesulitan }}
                        </span>

                        <span class="badge bg-warning text-dark info-badge">
                            <i class="bi bi-clock-fill"></i>
                            {{ $resep->waktu }}
                        </span>

                        <span class="badge bg-info info-badge">
                            <i class="bi bi-people-fill"></i>
                            {{ $resep->porsi }}
                        </span>
                    </div>

                    <div class="card border-0 bg-light rounded-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">
                                Tentang Resep
                            </h5>

                            <p class="text-muted mb-0">
                                {{ $resep->deskripsi }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($resep->link)
        <div class="card border-0 shadow-sm rounded-4 mb-5">
            <div class="card-body">
                <h3 class="fw-bold mb-4">
                    <i class="bi bi-play-circle-fill text-danger"></i>
                    Video Tutorial
                </h3>

                <div class="ratio ratio-16x9">
                    <iframe
                        src="{{ preg_replace('/watch\?v=/', 'embed/', $resep->link) }}"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    @endif

    <div class="row g-4 mb-5">
        <!-- BAHAN -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 recipe-section-card">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h4 class="fw-bold text-success">
                        <i class="bi bi-basket2-fill me-2"></i>
                        Bahan-bahan
                    </h4>
                </div>

                <div class="card-body px-4 pb-4">
                    <div class="recipe-content">
                        {!! nl2br(e($resep->bahan)) !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- LANGKAH -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 recipe-section-card">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h4 class="fw-bold text-primary">
                        <i class="bi bi-list-check me-2"></i>
                        Langkah Memasak
                    </h4>
                </div>

                <div class="card-body px-4 pb-4">
                    <div class="recipe-content">
                        {!! nl2br(e($resep->langkah)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-5">
        <a href="{{ route('resep.tampil') }}" class="btn btn-outline-secondary btn-lg rounded-pill">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>

        @auth
            @if(auth()->user()->role === 'user')
                @if(auth()->user()->bookmarks->contains($resep->id))
                    <form action="{{ route('bookmarks.destroy',$resep->id) }}"
                        method="POST">

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-warning btn-lg rounded-pill px-4">
                            <i class="bi bi-bookmark-check-fill me-2"></i>
                            Hapus Bookmark
                        </button>
                    </form>
                @else
                    <form action="{{ route('bookmarks.store',$resep->id) }}"
                        method="POST">
                        @csrf
                        <button
                            class="btn btn-danger btn-lg rounded-pill px-4">
                            <i class="bi bi-heart-fill me-2"></i>
                            Simpan Bookmark
                        </button>
                    </form>
                @endif
            @endif
        @else
            <a href="{{ route('login') }}"
            class="btn btn-danger btn-lg rounded-pill">
                <i class="bi bi-heart-fill me-2"></i>
                Login untuk Bookmark
            </a>
        @endauth
    </div>
</div>

<style>
.recipe-image{
    height:450px;
    object-fit:cover;
    border-radius:22px;
    box-shadow:0 12px 30px rgba(0,0,0,.12);
}

.info-badge{
    padding:10px 18px;
    font-size:.95rem;
    border-radius:50px;
}

.card{
    transition:.3s;
}

.card:hover{
    transform:translateY(-3px);
}
</style>
@endsection