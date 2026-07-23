@extends('dashboard.layouts.app')

@section('title','Detail User')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">
            <i class="bi bi-person-circle text-primary"></i>
            Detail User
        </h2>
        <p class="text-muted mb-0">
            Informasi lengkap pengguna BandungEats.
        </p>
    </div>
    <a
        href="{{ route('dashboard.user') }}"
        class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 rounded-4 h-100">
            <div class="card-body profile-card text-center">
                <img
                    src="{{ $user->profile_photo_url }}"
                    class="user-detail-photo">
                <h3 class="mt-4 fw-bold">
                    {{ $user->name }}
                </h3>
                <p class="text-muted">
                    {{ $user->email }}
                </p>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <h4 class="fw-bold">
                            {{ $user->bookmarks_count }}
                        </h4>
                        <small class="text-muted">
                            Bookmark
                        </small>
                    </div>

                    <div class="col-6">
                        <h4 class="fw-bold">
                            {{ $user->created_at->format('Y') }}
                        </h4>
                        <small class="text-muted">
                            Bergabung
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-4 h-100">
            <div class="card-body">
                <h4 class="fw-bold mb-4">
                    Informasi User
                </h4>

                <div class="info-item">
                    <i class="bi bi-person-fill"></i>
                    <div>
                        <label>Nama</label>
                        <h6>{{ $user->name }}</h6>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-envelope-fill"></i>
                    <div>
                        <label>Email</label>
                        <h6>{{ $user->email }}</h6>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-calendar-event-fill"></i>
                    <div>
                        <label>Bergabung</label>
                        <h6>
                            {{ $user->created_at->format('d F Y') }}
                        </h6>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-bookmark-heart-fill"></i>
                    <div>
                        <label>Total Bookmark</label>
                        <h6>
                            {{ $user->bookmarks_count }}
                        </h6>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-check-circle-fill text-success"></i>
                    <div>
                        <label>Status</label>
                        <h6>
                            Aktif
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card stat-card border-0 shadow-sm rounded-4">
            <div class="card-body text-center">
                <i class="bi bi-bookmark-heart-fill fs-1 text-danger"></i>
                <h3 class="fw-bold mt-3">
                    {{ $user->bookmarks_count }}
                </h3>
                <p class="text-muted mb-0">
                    Bookmark
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card border-0 shadow-sm rounded-4">
            <div class="card-body text-center">
                <i class="bi bi-calendar-check-fill fs-1 text-primary"></i>
                <h3 class="fw-bold mt-3">
                    {{ $user->created_at->format('Y') }}
                </h3>
                <p class="text-muted mb-0">
                    Tahun Bergabung
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card border-0 shadow-sm rounded-4">
            <div class="card-body text-center">
                <i class="bi bi-check-circle-fill fs-1 text-success"></i>
                <h3 class="fw-bold mt-3">
                    Aktif
                </h3>
                <p class="text-muted mb-0">
                    Status Akun
                </p>
            </div>
        </div>
    </div>
</div>
@endsection