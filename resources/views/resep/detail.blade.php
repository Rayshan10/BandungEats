@extends('layout')

@section('konten')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('resep.tampil') }}">Kembali</a></li>
            <li class="breadcrumb-item active">{{ $resep->judul }}</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- Gambar Resep -->
                <div class="col-md-6 mb-4">
                    @if($resep->gambar)
                        <img src="{{ asset('storage/' . $resep->gambar) }}" 
                            class="img-fluid rounded" 
                            alt="{{ $resep->judul }}"
                            style="width: 100%; height: 400px; object-fit: cover;">
                    @endif
                </div>

                <!-- Informasi Resep -->
                <div class="col-md-6">
                    <h1 class="mb-3">{{ $resep->judul }}</h1>
                    <div class="d-flex gap-3 mb-4">
                        <div class="border rounded p-2 bg-primary">
                            <div>{{ $resep->kategori }}</div>
                        </div>
                        <div class="border rounded p-2">
                            <div>{{ $resep->waktu }}</div>
                        </div>
                        <div class="border rounded p-2">
                            <div>{{ $resep->kesulitan }}</div>
                        </div>
                        <div class="border rounded p-2">
                            <div>{{ $resep->porsi }}</div>
                        </div>
                    </div>
                    <p class="mb-4 text-justify">{{ $resep->deskripsi }}</p>
                </div>

                @if($resep->link)
                        <div class="col-12 text-center mb-4">
                            <h5>Video Tutorial:</h5>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-6">
                                        <div class="ratio ratio-16x9">
                                            <iframe 
                                                src="{{ preg_replace('/watch\?v=/', 'embed/', $resep->link) }}"
                                                title="YouTube video player"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
            </div>

            <div class="row mt-4">
                <!-- Bahan-bahan -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0"><i class="fas fa-list"></i> Bahan-bahan</h5>
                        </div>
                        <div class="card-body text-left">
                            {!! nl2br(e($resep->bahan)) !!}
                        </div>
                    </div>
                </div>

                <!-- Langkah-langkah -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0"><i class="fas fa-tasks"></i> Langkah-langkah</h5>
                        </div>
                        <div class="card-body">
                            {!! nl2br(e($resep->langkah)) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('resep.tampil') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <div class="flex gap-4">
                @if(auth()->check())
                    @if(auth()->check() && auth()->user()->role === 'user')
                        @if(auth()->user()->bookmarks->contains($resep->id))
                            <form action="{{ route('bookmarks.destroy', $resep->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning">Hapus Favorit</button>
                            </form>
                        @else
                            <form action="{{ route('bookmarks.store', $resep->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        @endif
                    @endif
                @else
                <!-- Jika user belum login -->
                <a href="{{ route('login') }}" class="btn btn-primary">Simpan</a>
                @endif
                
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('resep.edit', $resep->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit Resep
                    </a>
                    <form action="{{ route('resep.destroy', $resep->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus resep ini?')">
                            <i class="fas fa-trash"></i> Hapus Resep
                        </button>
                    </form>
                @endif
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection