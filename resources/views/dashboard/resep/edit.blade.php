@extends('dashboard.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/tambah.css') }}">
@endpush

@section('title','Edit Resep')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                Edit Resep
            </h2>
            <p class="text-muted mb-0">
                Edit resep yang sudah ada di BandungEats.
            </p>
        </div>

        <a href="{{ route('dashboard.resep') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    <form
        action="{{ route('resep.update', $resep->id) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')
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
                                placeholder="Contoh: Surabi Bandung"
                                value="{{ old('title', $resep->title) }}">

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
                                    <option value="Pedas"{{ old('category',$resep->kategori)=='Pedas' ? 'selected':'' }}>
                                        Pedas
                                    </option>
                                    <option value="Gurih"{{ old('category',$resep->kategori)=='Gurih' ? 'selected':'' }}>
                                        Gurih
                                    </option>
                                    <option value="Manis"{{ old('category',$resep->kategori)=='Manis' ? 'selected':'' }}>
                                        Manis
                                    </option>
                                    <option value="Jajanan"{{ old('category',$resep->kategori)=='Jajanan' ? 'selected':'' }}>
                                        Jajanan
                                    </option>
                                    <option value="Minuman"{{ old('category',$resep->kategori)=='Minuman' ? 'selected':'' }}>
                                        Minuman
                                    </option>
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
                                    <option value="Mudah"{{ old('difficulty',$resep->kesulitan)=='Mudah' ? 'selected':'' }}>
                                        Mudah
                                    </option>
                                    <option value="Sedang"{{ old('difficulty',$resep->kesulitan)=='Sedang' ? 'selected':'' }}>
                                        Sedang
                                    </option>
                                    <option value="Sulit"{{ old('difficulty',$resep->kesulitan)=='Sulit' ? 'selected':'' }}>
                                        Sulit
                                    </option>
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
                                    placeholder="30 menit"
                                    value="{{ old('time', $resep->waktu) }}">
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
                                    placeholder="4 orang"
                                    value="{{ old('servings', $resep->porsi) }}">
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
                                placeholder="Ceritakan sedikit mengenai resep ini..."
                                >{{ old('description', $resep->deskripsi) }}</textarea>
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
                            - 300 ml santan">{{ old('ingredients', $resep->bahan) }}</textarea>
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
                            placeholder="Tuliskan langkah memasak secara berurutan...">{{ old('steps', $resep->langkah) }}</textarea>
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
                            <img id="imagePreview" class="img-fluid rounded-4 shadow-sm w-100" src="{{ $resep->gambar ? asset('storage/'.$resep->gambar) : '' }}">
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
                                value="{{ old('video', $resep->link) }}">
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
                    <button
                        type="button"
                        id="previewRecipe"
                        class="btn btn-outline-primary">
                        <i class="bi bi-eye"></i>
                        Preview
                    </button>

                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-circle"></i>
                        Update Resep
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

<div class="modal fade"
    id="previewModal"
    tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Preview Resep
                </h5>
                <button
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">
                <img id="previewImage" class="img-fluid rounded mb-4 d-none">
                <h3 id="previewTitle"></h3>
                <div class="mb-3">
                    <span id="previewCategory" class="badge bg-primary"></span>
                    <span id="previewTime" class="ms-2"></span>
                    <span id="previewDifficulty" class="ms-2"></span>
                    <span id="previewServings" class="ms-2"></span>
                </div>

                <hr>

                <h5>Deskripsi</h5>
                <p id="previewDescription"></p>

                <hr>

                <h5>Bahan</h5>
                <pre id="previewIngredients"></pre>

                <hr>

                <h5>Langkah</h5>
                <pre id="previewSteps"></pre>

                <hr>

                <h5>Video Tutorial</h5>
                <img id="previewYoutube" class="img-fluid rounded d-none">
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/tambah.js') }}"></script>
@endpush