@extends('layouts.auth')

@section('title','Register')

@section('content')

<div class="register-card">
    <h1 class="logo">
        <span>Bandung</span>Eats
    </h1>

    <h2>Daftar Akun ✨</h2>

    <p>
        Buat akun untuk mulai menjelajahi berbagai resep khas Kota Bandung.
    </p>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('register.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <!-- Nama -->

        <div class="modern-input input-group">
            <span class="input-group-text">
                <i class="bi bi-person"></i>
            </span>
            <input
                type="text"
                name="name"
                class="form-control"
                placeholder="Nama Lengkap"
                value="{{ old('name') }}"
                required>
        </div>

        <!-- Email -->

        <div class="modern-input input-group">
            <span class="input-group-text">
                <i class="bi bi-envelope"></i>
            </span>
            <input
                type="email"
                name="email"
                class="form-control"
                placeholder="Email"
                value="{{ old('email') }}"
                required>
        </div>

        <!-- Password -->

        <div class="modern-input input-group">
            <span class="input-group-text">
                <i class="bi bi-lock"></i>
            </span>
            <input
                type="password"
                name="password"
                id="password"
                class="form-control"
                placeholder="Password"
                required>
            <button
                type="button"
                class="btn btn-light"
                id="togglePassword">
                <i class="bi bi-eye"></i>
            </button>
        </div>

        <!-- Password Strength -->
        <div class="mb-3">
            <div class="progress" style="height:8px">
                <div
                    id="passwordStrength"
                    class="progress-bar"
                    style="width:0%">
                </div>
            </div>

            <small id="strengthText" class="text-muted">
                Gunakan minimal 8 karakter.
            </small>
        </div>

        <!-- Konfirmasi Password -->
        <div class="modern-input input-group">
            <span class="input-group-text">
                <i class="bi bi-shield-lock"></i>
            </span>
            <input
                type="password"
                name="password_confirmation"
                id="password_confirmation"
                class="form-control"
                placeholder="Konfirmasi Password"
                required>
            <button
                type="button"
                class="btn btn-light"
                id="toggleConfirmPassword">
                <i class="bi bi-eye"></i>
            </button>
        </div>

        <!-- Preview Foto -->
        <div class="text-center mb-3">
            <img
                id="previewImage"
                src="{{ asset('assets/img/default-profile.png') }}"
                class="rounded-circle shadow"
                width="100"
                height="100"
                style="object-fit:cover">
        </div>

        <!-- Upload -->
        <div class="mb-4">
            <input
                type="file"
                name="profile_photo"
                id="profile_photo"
                class="form-control"
                accept="image/*">
        </div>
        <button class="btn btn-login">
            Buat Akun
        </button>
    </form>

    <p class="text-center mt-4">
        Sudah punya akun?
        <a href="{{ route('login') }}">
            Login Disini
        </a>
    </p>
</div>

@endsection

@push('styles')

<style>

.register-card{
    max-height:85vh;
    overflow-y:auto;
    padding-right:10px;
}

.register-card::-webkit-scrollbar{
    width:6px;
}

.register-card::-webkit-scrollbar-thumb{
    background:#b7dfff;
    border-radius:20px;
}

.register-card::-webkit-scrollbar-track{
    background:transparent;
}

</style>

@endpush

@push('scripts')

<script>

// Preview Foto

const profile=document.getElementById('profile_photo');

const preview=document.getElementById('previewImage');

profile.addEventListener('change',function(){

    const file=this.files[0];

    if(file){

        preview.src=URL.createObjectURL(file);

    }

});

// Toggle Password

function toggle(buttonId,inputId){

    const btn=document.getElementById(buttonId);

    const input=document.getElementById(inputId);

    btn.onclick=()=>{

        if(input.type==="password"){

            input.type="text";

            btn.innerHTML='<i class="bi bi-eye-slash"></i>';

        }else{

            input.type="password";

            btn.innerHTML='<i class="bi bi-eye"></i>';

        }

    }

}

toggle('togglePassword','password');

toggle('toggleConfirmPassword','password_confirmation');

// Password Strength

const password=document.getElementById('password');

const bar=document.getElementById('passwordStrength');

const text=document.getElementById('strengthText');

password.addEventListener('keyup',()=>{

    let value=password.value.length;

    if(value<6){

        bar.style.width="30%";

        bar.className="progress-bar bg-danger";

        text.innerHTML="Password Lemah";

    }else if(value<10){

        bar.style.width="65%";

        bar.className="progress-bar bg-warning";

        text.innerHTML="Password Sedang";

    }else{

        bar.style.width="100%";

        bar.className="progress-bar bg-success";

        text.innerHTML="Password Kuat";

    }

});

</script>

@endpush