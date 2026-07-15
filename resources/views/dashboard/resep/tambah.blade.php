@extends('dashboard.layouts.app')

@section('title','Tambah Resep')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Tambah Resep Baru</h2>
            <p class="text-muted mb-0">
                Tambahkan resep khas Bandung ke dalam sistem.
            </p>
        </div>

        <a href="{{ route('dashboard.resep') }}"
            class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    <form
        action="{{ route('resep.recipe') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div class="row">

            {{-- LEFT --}}
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">
                            Informasi Resep
                        </h5>
                        <div class="mb-3">
                            <label class="form-label">
                                Judul Resep
                            </label>

                            <input
                                type="text"
                                name="title"
                                value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror"
                                placeholder="Masukkan judul resep">

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
                                    <option value="pedas">Pedas</option>
                                    <option value="gurih">Gurih</option>
                                    <option value="manis">Manis</option>
                                    <option value="jajanan">Jajanan</option>
                                    <option value="minuman">Minuman</option>
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
                                    <option value="mudah">Mudah</option>
                                    <option value="sedang">Sedang</option>
                                    <option value="sulit">Sulit</option>
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
                                    value="{{ old('time') }}"
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
                                    value="{{ old('servings') }}"
                                    class="form-control @error('servings') is-invalid @enderror"
                                    placeholder="4 orang">
                                @error('servings')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="mb-4">
                            <label class="form-label">
                                Deskripsi
                            </label>

                            <textarea
                                name="description"
                                class="form-control auto-resize @error('description') is-invalid @enderror"
                                rows="4">{{ old('description') }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <small id="descCounter">
                                0 / 500
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4">
                            Upload Foto
                        </h5>
                        
                        <div class="upload-area" id="uploadArea">
                            <i class="bi bi-cloud-arrow-up display-4 text-primary mb-3"></i>
                            <h6>Drag & Drop Foto</h6>
                            <small class="text-muted">
                                atau klik untuk memilih gambar
                            </small>
                            
                            <input
                                type="file"
                                name="image"
                                class="form-control @error('image') is-invalid @enderror"
                                id="image"
                                accept="image/*"
                                hidden>
                            @error('image')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <img
                            id="previewImage"
                            class="img-fluid rounded-4 mt-4 d-none">
                        <div
                            id="fileName"
                            class="text-center text-muted mt-2">
                        </div>
                        <div class="progress mt-3 d-none" id="uploadProgressWrapper">
                            <div
                                class="progress-bar progress-bar-striped progress-bar-animated"
                                id="uploadProgress"
                                style="width:0%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 rounded-4 mt-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">
                    Detail Resep
                </h5>

                <div class="mb-3">
                    <label>Bahan</label>
                    <textarea
                        class="form-control auto-resize"
                        rows="5"
                        name="ingredients"></textarea>
                </div>

                <div class="mb-3">
                    <label>Langkah Pembuatan</label>
                    <textarea
                        class="form-control auto-resize"
                        rows="6"
                        name="steps"></textarea>
                </div>

                <div class="mb-4">
                    <label>Video Tutorial</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-youtube text-danger"></i>
                        </span>
                        <input
                            type="url"
                            name="video"
                            id="video"
                            class="form-control @error('video') is-invalid @enderror"
                            placeholder="https://www.youtube.com/watch?v=xxxxxxxx">
                        <img
                            id="youtubePreview"
                            class="img-fluid rounded mt-3 d-none">
                    </div>
                    <small class="text-muted">
                        Tempelkan link video tutorial dari YouTube.
                    </small>
                    @error('video')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex gap-3 mt-4">
                    <button
                        type="button"
                        class="btn btn-outline-primary"
                        id="previewRecipe">
                        <i class="bi bi-eye"></i>
                        Preview
                    </button>
                    <button
                        type="submit"
                        class="btn btn-primary">
                        <i class="bi bi-check-circle"></i>
                        Simpan Resep
                    </button>
                </div>
            </div>
        </div>
    </form>
    <!-- Modal Preview -->
    <div
        class="modal fade"
        id="previewModal"
        tabindex="-1">
        <div class="modal-dialog modal-lg">
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
                    <h2 id="previewTitle"></h2>
                    <p id="previewDescription"></p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')

<script>

    const uploadArea=document.getElementById('uploadArea');
    const imageInput=document.getElementById('image');
    const preview=document.getElementById('previewImage');
    const fileName=document.getElementById('fileName');

    uploadArea.onclick=()=>imageInput.click();
    imageInput.onchange=e=>{
        previewFile(e.target.files[0]);

    };

    uploadArea.addEventListener("dragover",(e)=>{
        e.preventDefault();
        uploadArea.classList.add("dragover");
    });

    uploadArea.addEventListener("dragleave",()=>{
        uploadArea.classList.remove("dragover");
    });

    uploadArea.addEventListener("drop",(e)=>{
        e.preventDefault();
        uploadArea.classList.remove("dragover");
        imageInput.files=e.dataTransfer.files;
        previewFile(e.dataTransfer.files[0]);
    });

    function previewFile(file){
        if(!file) return;
        const reader=new FileReader();
        reader.onload=function(e){
            preview.src=e.target.result;
            preview.classList.remove("d-none");
            fileName.innerHTML=file.name;
        }

        reader.readAsDataURL(file);
    }

    document.querySelectorAll(".auto-resize").forEach(textarea=>{
        textarea.addEventListener("input",function(){
            this.style.height="auto";
            this.style.height=this.scrollHeight+"px";
        });
    });

    const progress=document.getElementById("uploadProgress");
    const progressWrapper=document.getElementById("uploadProgressWrapper");

    function previewFile(file){
        if(!file) return;
        progressWrapper.classList.remove("d-none");
        let percent=0;
        const fake=setInterval(()=>{
            percent+=10;
            progress.style.width=percent+"%";
            progress.innerHTML=percent+"%";
            if(percent>=100){
                clearInterval(fake);
            }
        },70);
        const reader=new FileReader();
        reader.onload=e=>{
            preview.src=e.target.result;
            preview.classList.remove("d-none");
            fileName.innerHTML=file.name;
        }
        reader.readAsDataURL(file);
    }

    const desc=document.querySelector("[name='description']");
    const counter=document.getElementById("descCounter");

    desc.addEventListener("input",()=>{
        counter.innerHTML=
        desc.value.length+" / 500";
    });

    document.getElementById("previewRecipe").onclick=()=>{
        document.getElementById("previewTitle").innerHTML=
        document.querySelector("[name='title']").value;
        document.getElementById("previewDescription").innerHTML=
        document.querySelector("[name='description']").value;
        
        new bootstrap.Modal(
            document.getElementById("previewModal")
        ).show();
    }

    const videoInput=document.getElementById("video");
    videoInput.addEventListener("input",function(){
        const url=this.value;
        const match=url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/);

        if(match){
            document.getElementById("youtubePreview").src=
            "https://img.youtube.com/vi/"
            +match[1]+
            "/hqdefault.jpg";
            document.getElementById("youtubePreview")
            .classList.remove("d-none");
        }
    });
</script>

@endpush

@if(session('success'))

@push('scripts')

<script>
    Swal.fire({
        icon:'success',
        title:'Berhasil',
        text:'Resep berhasil ditambahkan.',
        timer:2000,
        showConfirmButton:false
    })
</script>

@endpush

@endif
@endsection