@extends('dashboard.layouts.app')

@section('title','Kelola User')

@section('content')

<div class="inventory-header">
    <div>
        <h2>Kelola User</h2>
        <p>Kelola seluruh pengguna BandungEats.</p>
        <small class="text-muted">
            Total
            <strong>
                {{ $users->count() }}
            </strong>
            pengguna.
        </small>
    </div>
</div>

<div class="inventory-toolbar">
    <div class="search-box">
        <i class="bi bi-search"></i>
        <input type="text" class="form-control" id="searchUser" placeholder="Cari user...">
    </div>
</div>

<div class="card inventory-table">
    <div class="table-responsive">
        <table class="table align-middle" id="userTable">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Bookmark</th>
                    <th>Bergabung</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <img src="{{ $user->profile_photo_url }}" class="user-thumb">
                    </td>
                    <td>
                        <strong>
                            {{ $user->name }}
                        </strong>
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->bookmarks_count }}
                    </td>
                    <td>
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                    <td>
                        @if($user->status == 'active')
                        <span class="badge bg-success">Aktif</span>
                        @else
                        <span class="badge bg-danger">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')

<script src="{{ asset('assets/js/user.js') }}"></script>

@endpush

@endsection