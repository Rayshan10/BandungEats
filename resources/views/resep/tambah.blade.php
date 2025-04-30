@extends('layout')

@section('konten')
<link href="{{ asset('assets/img/logobdg.png') }}" rel="icon">
<link rel="stylesheet" href="{{ asset('assets/css/tambah.css') }}">
<div class="container">
    <a href="{{ route('resep.tampil') }}" class="back-btn">← Kembali</a>
    <h1>Tambah Resep Baru</h1>
    
    <form action="{{ route('resep.recipe') }}" method="POST" enctype="multipart/form-data" id="recipeForm">
        @csrf
        <div class="form-group">
            <label for="category">Kategori Resep</label>
            <select name="category" id="category" required>
                <option value="">Pilih kategori...</option>
                <option value="pedas">Pedas</option>
                <option value="gurih">Gurih</option>
                <option value="manis">Manis</option>
                <option value="jajanan">Jajanan</option>
                <option value="minuman">Minuman</option>
            </select>
        </div>

        <div class="form-group">
            <label for="title">Judul Resep</label>
            <input type="text" name="title" id="title" placeholder="Masukkan judul resep..." required>
        </div>

        <div class="form-group">
            <label>Foto Resep</label>
            <div class="image-upload">
                <img src="/api/placeholder/40/40" alt="upload icon">
                <p>Klik atau seret foto ke sini</p>
                <input type="file" name="image" id="image" accept="image/*">
            </div>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi Resep</label>
            <textarea name="description" id="description" placeholder="Jelaskan tentang resep ini..." required></textarea>
        </div>

        <div class="form-group">
            <label for="video">Link Video</label>
            <input type="url" name="video" id="video" placeholder="Masukkan link video tutorial..." required>
        </div>

        <div class="details-grid">
            <div class="form-group">
                <label for="difficulty">Tingkat Kesulitan</label>
                <select name="difficulty" id="difficulty" required>
                    <option value="">Pilih tingkat...</option>
                    <option value="Mudah">Mudah</option>
                    <option value="Sedang">Sedang</option>
                    <option value="Sulit">Sulit</option>
                </select>
            </div>

            <div class="form-group">
                <label for="servings">Porsi</label>
                <input type="text" name="servings" id="servings" placeholder="Contoh: 4 orang" required>
            </div>

            <div class="form-group">
                <label for="time">Waktu Memasak</label>
                <input type="text" name="time" id="time" placeholder="Contoh: 30 menit" required>
            </div>
        </div>

        <div class="form-group">
            <label for="ingredients">Bahan-bahan</label>
            <textarea name="ingredients" id="ingredients" placeholder="Masukkan daftar bahan-bahan..." required></textarea>
        </div>

        <div class="form-group">
            <label for="steps">Langkah Pembuatan</label>
            <textarea name="steps" id="steps" placeholder="Masukkan langkah-langkah pembuatan..." required></textarea>
        </div>

        <button type="submit" class="submit-btn">Simpan Resep</button>
    </form>
</div>
@endsection