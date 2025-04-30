@extends('layout')

@section('konten')
<div class="container mt-4">
    <a href="/home" class="text-decoration-none text-dark">
        <i class="bi bi-arrow-left" style="font-size: 1.5rem;"></i>
    </a>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Resep</h1>
        
        <!-- Category Filter -->
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                {{ request('category', 'Pilih Kategori') }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                <li><a class="dropdown-item" href="{{ route('resep.tampil') }}">Semua</a></li>
                <li><a class="dropdown-item" href="{{ route('resep.kategori', 'pedas') }}">Pedas</a></li>
                <li><a class="dropdown-item" href="{{ route('resep.kategori', 'gurih') }}">Gurih</a></li>
                <li><a class="dropdown-item" href="{{ route('resep.kategori', 'manis') }}">Manis</a></li>
                <li><a class="dropdown-item" href="{{ route('resep.kategori', 'jajanan') }}">Jajanan</a></li>
                <li><a class="dropdown-item" href="{{ route('resep.kategori', 'minuman') }}">Minuman</a></li>
            </ul>
            @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('resep.tambah') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Resep
            </a>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($resep->count() > 0)
        <div class="row">
            @foreach($resep as $item)
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
                                            @if(auth()->check() && auth()->user()->role === 'admin')
                                            <a href="{{ route('resep.edit', $item->id) }}" 
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('resep.destroy', $item->id) }}" 
                                                method="POST" 
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('Yakin ingin menghapus resep ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                            @endif
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
            Belum ada resep yang ditambahkan.
        </div>
    @endif
</div>
@endsection