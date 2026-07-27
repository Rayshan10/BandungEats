@extends('layouts.app')

@section('content')

<div class="container py-4">
    <form method="POST"
        action="{{ route('profile.update') }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input
            type="file"
            id="profile_photo"
            name="profile_photo"
            class="d-none"
            accept="image/*">
        <div class="row g-4">
            <!-- PROFILE CARD -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 h-100">
                    <div class="card-body text-center profile-card">
                        @if(auth()->user()->profile_photo)
                        <img
                            id="preview-image"
                            src="{{ asset('storage/'.auth()->user()->profile_photo) }}"
                            class="user-detail-photo">
                        @else
                        <img
                            id="preview-image"
                            src="{{ asset('assets/img/default-profile.png') }}"
                            class="user-detail-photo">
                        @endif
                        <h3 class="fw-bold mt-4">
                            {{ auth()->user()->name }}
                        </h3>
                        <p class="text-muted">
                            {{ auth()->user()->email }}
                        </p>

                        <hr>

                        <div class="row">
                            <div class="col-6">
                                <h4 class="fw-bold">
                                    {{ auth()->user()->bookmarks()->count() }}
                                </h4>
                                <small class="text-muted">
                                    Bookmark
                                </small>
                            </div>

                            <div class="col-6">
                                <h4 class="fw-bold">
                                    {{ auth()->user()->created_at->format('Y') }}
                                </h4>
                                <small class="text-muted">
                                    Bergabung
                                </small>
                            </div>
                        </div>

                        <button
                            type="button"
                            id="change-photo-btn"
                            class="btn btn-outline-primary rounded-pill mt-4">
                            <i class="bi bi-camera"></i>
                            Ganti Foto
                        </button>
                    </div>
                </div>
            </div>

            <!-- FORM CARD -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">
                            Informasi Akun
                        </h4>
                        <!-- Nama -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Nama Lengkap
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                value="{{ old('name', auth()->user()->name) }}"
                                required>
                            @error('name')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Email
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                value="{{ old('email', auth()->user()->email) }}"
                                required>
                            @error('email')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <h5 class="fw-bold mb-4">
                            Ganti Password
                        </h5>

                        <!-- Password Lama -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Password Saat Ini
                            </label>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input
                                    type="password"
                                    id="current_password"
                                    name="current_password"
                                    class="form-control form-control-lg">
                            </div>
                        </div>

                        <!-- Password Baru -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Password Baru
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-key-fill"></i>
                                </span>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control form-control-lg">
                            </div>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Konfirmasi Password Baru
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-shield-lock-fill"></i>
                                </span>
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="form-control form-control-lg">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <button
                                type="submit"
                                class="btn btn-primary btn-lg rounded-pill px-5">
                                <i class="bi bi-floppy-fill me-2"></i>
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function () {

    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        confirmButtonColor: '#0d6efd',
        timer: 2000,
        showConfirmButton: false
    });

});
</script>
@endif

<script>
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("profile_photo");
    const preview = document.getElementById("preview-image");
    const button = document.getElementById("change-photo-btn");

    // tombol ganti foto
    button.addEventListener("click", function () {
        input.click();
    });

    // klik foto juga bisa ganti
    preview.addEventListener("click", function () {
        input.click();
    });

    // preview foto
    input.addEventListener("change", function () {
        const file = this.files[0];

        if(file){
            preview.src = URL.createObjectURL(file);
        }
    });
});
</script>

<style>
.profile-card{
    padding:40px;
}

.user-detail-photo{
    width:170px;
    height:170px;
    border-radius:50%;
    object-fit:cover;
    cursor:pointer;
    border:5px solid #fff;
    box-shadow:0 12px 30px rgba(0,0,0,.12);
    transition:.3s;
}

.user-detail-photo:hover{
    transform:scale(1.05);
}

.form-control{
    border-radius:12px;
    padding:12px 18px;
}

.form-control:focus{
    box-shadow:0 0 0 .2rem rgba(13,110,253,.15);
}

.input-group-text{
    border-radius:12px 0 0 12px;
}

.card{
    transition:.3s;
}

.card:hover{
    transform:translateY(-3px);
    box-shadow:0 15px 35px rgba(0,0,0,.08);
}

.btn-primary{
    border-radius:50px;
    transition:.3s;
}

.btn-primary:hover{
    transform:translateY(-2px);
}

.btn-outline-primary{
    border-radius:50px;
}
</style>

@endsection