@extends('dashboard.layouts.app')

@section('title','Detail Resep')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/show.css') }}">
@endpush

@section('content')

<div class="recipe-detail">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">
                Detail Resep
            </h2>
            <p class="text-muted">
                Informasi lengkap resep BandungEats.
            </p>
        </div>

        <div>
            <a
                href="{{ route('dashboard.resep') }}"
                class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

            <a
                href="{{ route('resep.edit',$resep->id) }}"
                class="btn btn-primary">
                <i class="bi bi-pencil-square"></i>
                Edit
            </a>
            <form action="{{ route('resep.destroy',$resep->id) }}" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
                <button type="button" id="deleteButton" class="btn btn-danger">
                    <i class="bi bi-trash"></i>
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <h1 class="fw-bold">
                {{ $resep->judul }}
            </h1>

            <div class="mt-3 d-flex gap-2 flex-wrap">
                <span class="badge bg-primary">
                    {{ $resep->kategori }}
                </span>

                <span class="badge bg-success">
                    {{ $resep->kesulitan }}
                </span>

                <span class="badge bg-warning text-dark">
                    {{ $resep->waktu }}
                </span>

                <span class="badge bg-info">
                    {{ $resep->porsi }}
                </span>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">
                        Foto Resep
                    </h5>

                    <img 
                        src="{{ asset('storage/'.$resep->gambar) }}"
                        class="img-fluid rounded-4 recipe-image"
                        id="recipeImage">
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">
                        Video Tutorial
                    </h5>

                    @php
                        $youtubeId = null;
                        if($resep->link){
                            preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/',$resep->link,$matches);
                            $youtubeId = $matches[1] ?? null;
                        }
                    @endphp

                    @if($youtubeId)
                        <a
                            href="{{ $resep->link }}"
                            target="_blank">
                            <img
                                src="https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg"
                                class="img-fluid rounded-4">
                        </a>

                    @else
                        <div class="alert alert-secondary">
                            Tidak ada video.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mt-4">
        <div class="card-body">
            <h4 class="fw-bold mb-3">
                Deskripsi
            </h4>
            <p>
                {{ $resep->deskripsi }}
            </p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mt-4">
        <div class="card-body">
            <h4 class="fw-bold mb-4">
                <i class="bi bi-basket2-fill text-success"></i>
                Bahan-bahan
            </h4>

            @foreach(explode("\n",$resep->bahan) as $bahan)
                @if(trim($bahan)!='')
                    <div class="ingredient-item">
                        <i class="bi bi-check-circle-fill text-success"></i>
                        <span>{{ trim($bahan) }}</span>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mt-4">
        <div class="card-body">
            <h4 class="fw-bold mb-4">
                <i class="bi bi-list-ol text-primary"></i>
                Langkah Pembuatan
            </h4>

            @foreach(explode("\n",$resep->langkah) as $i=>$langkah)
                @if(trim($langkah)!='')
                    <div class="step-item">
                        <div class="step-number">
                            {{ $i+1 }}
                        </div>

                        <div class="step-text">
                            {{ trim($langkah) }}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

@push('scripts')

<script src="{{ asset('assets/js/show.js') }}"></script>

@endpush

@endsection

<div class="modal fade" id="imageModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-transparent border-0">
            <img id="modalImage" class="img-fluid rounded-4">
        </div>
    </div>
</div>