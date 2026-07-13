@extends('layout')

@section('konten')
<link href="{{ asset('assets/img/logobdg.png') }}" rel="icon">
<link rel="stylesheet" href="{{ asset('assets/css/tambah.css') }}">
<div class="container">
    <a href="{{ route('resep.tampil') }}" class="back-btn">← Kembali</a>
    <h1>Edit Resep: {{ $resep->judul }}</h1>
    
    <form action="{{ route('resep.update', $resep->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="category">Kategori Resep</label>
            <select name="category" id="category" required>
                <option value="">Pilih kategori...</option>
                <option value="pedas" {{ $resep->kategori == 'pedas' ? 'selected' : '' }}>Pedas</option>
                <option value="gurih" {{ $resep->kategori == 'gurih' ? 'selected' : '' }}>Gurih</option>
                <option value="manis" {{ $resep->kategori == 'manis' ? 'selected' : '' }}>Manis</option>
                <option value="jajanan" {{ $resep->kategori == 'jajanan' ? 'selected' : '' }}>Jajanan</option>
                <option value="minuman" {{ $resep->kategori == 'minuman' ? 'selected' : '' }}>Minuman</option>
            </select>
        </div>

        <div class="form-group">
            <label for="title">Judul Resep</label>
            <input type="text" name="title" id="title" placeholder="Masukkan judul resep..." value="{{ $resep->judul }}" required>
        </div>

        <div class="form-group">
            <label>Foto Resep</label>
            <div class="image-upload">
                <input type="file" name="image" id="image" accept="image/*">
                @if($resep->gambar)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $resep->gambar) }}" alt="Gambar Resep Saat Ini" style="max-width: 200px">
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi Resep</label>
            <textarea name="description" id="description" placeholder="Jelaskan tentang resep ini..." required>{{ $resep->deskripsi }}</textarea>
        </div>

        <div class="form-group">
            <label for="video">Link Video</label>
            <input type="url" name="video" id="video" placeholder="Masukkan link video tutorial..." value="{{ $resep->video }}" required>
        </div>

        <div class="details-grid">
            <div class="form-group">
                <label for="difficulty">Tingkat Kesulitan</label>
                <select name="difficulty" id="difficulty" required>
                    <option value="">Pilih tingkat...</option>
                    <option value="Mudah" {{ $resep->kesulitan == 'Mudah' ? 'selected' : '' }}>Mudah</option>
                    <option value="Sedang" {{ $resep->kesulitan == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="Sulit" {{ $resep->kesulitan == 'Sulit' ? 'selected' : '' }}>Sulit</option>
                </select>
            </div>

            <div class="form-group">
                <label for="servings">Porsi</label>
                <input type="text" name="servings" id="servings" placeholder="Contoh: 4 orang" value="{{ $resep->porsi }}" required>
            </div>

            <div class="form-group">
                <label for="time">Waktu Memasak</label>
                <input type="text" name="time" id="time" placeholder="Contoh: 30 menit" value="{{ $resep->waktu }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="ingredients">Bahan-bahan</label>
            <textarea name="ingredients" id="ingredients" placeholder="Masukkan daftar bahan-bahan..." required>{{ $resep->bahan }}</textarea>
        </div>

        <div class="form-group">
            <label for="steps">Langkah Pembuatan</label>
            <textarea name="steps" id="steps" placeholder="Masukkan langkah-langkah pembuatan..." required>{{ $resep->langkah }}</textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update Resep</button>
            <a href="{{ route('resep.tampil') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
