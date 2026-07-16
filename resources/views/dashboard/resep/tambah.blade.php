@extends('dashboard.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/tambah.css') }}">
@endpush

@section('title','Tambah Resep')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                Tambah Resep
            </h2>
            <p class="text-muted mb-0">
                Tambahkan resep baru ke BandungEats.
            </p>
        </div>

        <a href="{{ route('dashboard.resep') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    <form
        action="{{ route('resep.recipe') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">
                            Informasi Resep
                        </h5>
                        <div class="mb-4">
                            <label class="form-label">
                                Judul Resep
                            </label>
                            <input
                                type="text"
                                name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                placeholder="Contoh: Surabi Bandung">

                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">
                                    Kategori
                                </label>
                                <select
                                    name="category"
                                    class="form-select @error('category') is-invalid @enderror">
                                    <option value="">Pilih</option>
                                    <option>Pedas</option>
                                    <option>Gurih</option>
                                    <option>Manis</option>
                                    <option>Jajanan</option>
                                    <option>Minuman</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">
                                    Kesulitan
                                </label>
                                <select
                                    name="difficulty"
                                    class="form-select @error('difficulty') is-invalid @enderror">
                                    <option>Mudah</option>
                                    <option>Sedang</option>
                                    <option>Sulit</option>
                                </select>
                                @error('difficulty')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">
                                    Waktu
                                </label>
                                <input
                                    type="text"
                                    name="time"
                                    class="form-control @error('time') is-invalid @enderror"
                                    placeholder="30 menit">
                                @error('time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">
                                    Porsi
                                </label>
                                <input
                                    type="text"
                                    name="servings"
                                    class="form-control @error('servings') is-invalid @enderror"
                                    placeholder="4 orang">
                                @error('servings')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="form-label">
                                Deskripsi
                            </label>
                            <textarea
                                name="description"
                                rows="5"
                                class="form-control auto-resize @error('description') is-invalid @enderror"
                                maxlength="500"
                                placeholder="Ceritakan sedikit mengenai resep ini..."></textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="text-end">
                                <small>
                                    <span id="descCount">
                                        0
                                    </span>
                                    /500
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm border-0 rounded-4 mt-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-basket2 me-2"></i>
                            Bahan
                        </h5>

                        <textarea
                            name="ingredients"
                            class="form-control auto-resize @error('ingredients') is-invalid @enderror"
                            rows="6"
                            placeholder="Contoh:
                            - 500 gram tepung
                            - 2 butir telur
                            - 300 ml santan"></textarea>
                        @error('ingredients')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="card shadow-sm border-0 rounded-4 mt-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-list-check me-2"></i>
                            Langkah Pembuatan
                        </h5>

                        <textarea
                            name="steps"
                            class="form-control auto-resize @error('steps') is-invalid @enderror"
                            rows="8"
                            placeholder="Tuliskan langkah memasak secara berurutan..."></textarea>
                        @error('steps')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4">
                            Upload Foto
                        </h5>
                        <div class="upload-area" id="uploadArea">
                            <i class="bi bi-cloud-arrow-up upload-icon"></i>
                            <h5 id="uploadTitle">
                                Drag & Drop Foto
                            </h5>
                            <p id="uploadSubtitle">
                                atau klik untuk memilih gambar
                            </p>
                            <input
                                type="file"
                                id="image"
                                name="image"
                                hidden>
                            @error('image')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div id="previewContainer" class="d-none">
                            <img id="imagePreview" class="img-fluid rounded-4 shadow-sm w-100">
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <button
                                    type="button"
                                    class="btn btn-outline-primary btn-sm"
                                    id="changeImage">
                                    <i class="bi bi-pencil"></i>
                                    Ganti Foto
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-outline-danger btn-sm"
                                    id="removeImage">
                                    <i class="bi bi-trash"></i>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">
                            Video Tutorial
                        </h5>
                        <div class="mb-3">
                            <label class="form-label">
                                Link Video YouTube
                            </label>
                            <input
                                id="video"
                                name="video"
                                type="url"
                                class="form-control"
                                placeholder="https://youtu.be/...">
                            @error('video')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <img
                                id="youtubePreview"
                                class="img-fluid rounded shadow-sm d-none">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-outline-primary">
                        <i class="bi bi-eye"></i>
                        Preview
                    </button>

                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-circle"></i>
                        Simpan Resep
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/tambah.js') }}"></script>
@endpush