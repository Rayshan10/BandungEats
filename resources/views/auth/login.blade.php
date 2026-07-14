@extends('layouts.auth')

@section('title','Login')

@section('content')

<h1 class="logo">
    <span>Bandung</span>Eats
</h1>

<h2>Selamat Datang 👋</h2>
<p>
    Masuk untuk menikmati berbagai resep khas Kota Bandung.
</p>

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif

@if($errors->any())
<div class="alert alert-danger">
    {{ $errors->first() }}
</div>
@endif

<form action="{{ route('login.auth') }}" method="POST">
    @csrf
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

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="form-check">
            <input
                class="form-check-input"
                type="checkbox">
            <label class="form-check-label">
                Ingat saya
            </label>
        </div>
    </div>

    <button class="btn btn-login">
        Login
    </button>
</form>

<p class="text-center mt-4">
    Belum punya akun?
    <a href="{{ route('register') }}">
        Daftar Sekarang
    </a>
</p>

@endsection

@push('scripts')

<script>

const toggle=document.getElementById('togglePassword');

const password=document.getElementById('password');

toggle.addEventListener('click',()=>{

    if(password.type==="password"){

        password.type="text";

        toggle.innerHTML='<i class="bi bi-eye-slash"></i>';

    }else{

        password.type="password";

        toggle.innerHTML='<i class="bi bi-eye"></i>';

    }

});

</script>

@endpush