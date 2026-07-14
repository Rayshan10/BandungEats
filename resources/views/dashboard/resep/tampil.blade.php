@extends('dashboard.layouts.app')

@section('title','Kelola Resep')

@section('content')

<div class="inventory-header">
    <div>
        <h2>Kelola Resep</h2>
        <p>Kelola seluruh resep khas Bandung.</p>
    </div>

    <a href="{{ route('resep.tambah') }}" class="btn btn-primary inventory-btn">
        <i class="bi bi-plus-circle"></i>
        Tambah Resep
    </a>
</div>

<div class="inventory-toolbar">
    <div class="search-box">
        <i class="bi bi-search"></i>
        <input
            type="text"
            id="searchRecipe"
            class="form-control"
            placeholder="Cari resep...">
    </div>

    <select class="form-select category-filter" id="categoryFilter">
        <option value="">Semua Kategori</option>
        <option value="Pedas">Pedas</option>
        <option value="Gurih">Gurih</option>
        <option value="Manis">Manis</option>
        <option value="Jajanan">Jajanan</option>
        <option value="Minuman">Minuman</option>
    </select>
</div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($resep->count() > 0)
        <div class="card inventory-table">
            <div class="table-responsive">
                <table class="table align-middle" id="recipeTable">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Waktu</th>
                            <th>Kesulitan</th>
                            <th>Porsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="recipeTableBody">
                        @foreach($resep as $item)
                        <tr>
                            <td>
                                @if($item->gambar)
                                <img
                                    src="{{ asset('storage/'.$item->gambar) }}"
                                    class="recipe-thumb">
                                @endif
                            </td>
                            <td class="recipe-name">
                                <strong>{{ $item->judul }}</strong>
                            </td>
                            <td class="recipe-category">
                                @php

                                $badge = [
                                    'pedas'=>'danger',
                                    'gurih'=>'success',
                                    'manis'=>'warning',
                                    'jajanan'=>'primary',
                                    'minuman'=>'info'
                                ];

                                @endphp

                                <span class="badge bg-{{ $badge[strtolower($item->kategori)] ?? 'secondary' }}">
                                    {{ ucfirst($item->kategori) }}
                                </span>
                            </td>
                            <td>{{ $item->waktu }}</td>
                            <td>{{ $item->kesulitan }}</td>
                            <td>{{ $item->porsi }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('resep.show',$item->id) }}"
                                    class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('resep.edit',$item->id) }}"
                                    class="btn btn-outline-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form
                                        action="{{ route('resep.destroy',$item->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus resep ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            Belum ada resep yang ditambahkan.
        </div>
    @endif
</div>

@push('scripts')

<script>

const searchInput=document.getElementById('searchRecipe');
const categoryFilter=document.getElementById('categoryFilter');
const rows=document.querySelectorAll('#recipeTable tbody tr');

function filterRecipe(){
    const keyword=searchInput.value.toLowerCase();
    const category=categoryFilter.value.toLowerCase();
    rows.forEach(row=>{
        const name=row.querySelector('.recipe-name').innerText.toLowerCase();
        const cat=row.querySelector('.recipe-category').innerText.toLowerCase();
        const matchName=name.includes(keyword);
        const matchCategory=category==='' || cat.includes(category);
        if(matchName && matchCategory){
            row.style.display='';
        }else{
            row.style.display='none';
        }
    });
}

searchInput.addEventListener('keyup',filterRecipe);
categoryFilter.addEventListener('change',filterRecipe);
</script>

@endpush

@endsection