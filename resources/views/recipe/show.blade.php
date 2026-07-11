@extends('layout')

@section('konten')
<div class="container">
    <h1>{{ $resep->judul }}</h1>
    <p>{{ $resep->deskripsi }}</p>
    <p><strong>Views:</strong> {{ $resep->views }}</p>
    <img src="{{ asset('storage/' . $resep->gambar) }}" alt="{{ $resep->judul }}" class="img-fluid">
</div>
@endsection
