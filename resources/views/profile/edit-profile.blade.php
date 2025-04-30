@extends('layout')

@section('konten')
<div class="container mt-4">
    <!-- Back Button -->
    <a href="/home" class="text-decoration-none text-dark">
        <i class="bi bi-arrow-left" style="font-size: 1.5rem;"></i>
    </a>

    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <!-- Profile Picture Section -->
            <div class="text-center mb-4">
                @if(auth()->user()->profile_photo)
                    <img src="{{ asset('storage/'.auth()->user()->profile_photo) }}" 
                        class="rounded-circle mb-2" 
                        alt="Profile Picture"
                        style="width: 100px; height: 100px; object-fit: cover;">
                @else
                    <div class="bi bi-person-circle text-center" style="font-size: 100px;"></div>
                @endif
                <p class="mt-2">Ubah</p>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Hidden file input triggered by the profile picture click -->
                <input type="file" id="profile_photo" name="profile_photo" class="d-none">

                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" 
                        class="form-control border-0 border-bottom rounded-0" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', auth()->user()->name) }}">
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" 
                        class="form-control border-0 border-bottom rounded-0" 
                        id="email" 
                        name="email" 
                        value="{{ old('email', auth()->user()->email) }}">
                </div>

                <!-- Current Password -->
                <div class="mb-4">
                    <label for="current_password" class="form-label">Password Saat Ini</label>
                    <input type="password" 
                        class="form-control border-0 border-bottom rounded-0" 
                        id="current_password" 
                        name="current_password">
                </div>

                <!-- New Password -->
                <div class="mb-4">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" 
                        class="form-control border-0 border-bottom rounded-0" 
                        id="password" 
                        name="password">
                </div>

                <!-- Confirm New Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" 
                        class="form-control border-0 border-bottom rounded-0" 
                        id="password_confirmation" 
                        name="password_confirmation">
                </div>

                <!-- Submit Button -->
                <div class="d-grid gap-2 mt-5">
                    <button type="submit" class="btn btn-primary rounded-pill">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<br>
<br>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Trigger file input when clicking on profile picture or "Ubah" text
    const profilePic = document.querySelector('.rounded-circle, .bi-person-circle');
    const changeText = document.querySelector('.mt-2');
    const fileInput = document.getElementById('profile_photo');

    [profilePic, changeText].forEach(element => {
        if (element) {
            element.style.cursor = 'pointer';
            element.addEventListener('click', () => fileInput.click());
        }
    });
});
</script>
@endsection