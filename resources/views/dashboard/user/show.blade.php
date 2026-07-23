@extends('dashboard.layouts.app')

@section('title','Detail User')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold">
            Detail User
        </h2>
        <p class="text-muted">
            Informasi lengkap pengguna BandungEats.
        </p>
    </div>

    <div class="d-flex gap-2">
        <a
            href="{{ route('dashboard.user') }}"
            class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body text-center">
        <img
            src="{{ $user->profile_photo_url }}"
            class="user-detail-photo mb-3">
        <h3 class="fw-bold">
            {{ $user->name }}
        </h3>
        <p class="text-muted">
            {{ $user->email }}
        </p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <h5 class="fw-bold mb-4">
                    Informasi User
                </h5>
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Bergabung</th>
                        <td>{{ $user->created_at->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Bookmark</th>
                        <td>{{ $user->bookmarks_count }} Resep</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-success">
                                Aktif
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection