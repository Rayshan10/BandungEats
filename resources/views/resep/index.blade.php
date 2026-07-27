@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">

                Semua Resep

            </h2>

            <p class="text-muted">

                Temukan berbagai resep khas Bandung.

            </p>

        </div>

    </div>

    <div class="row g-4">

        @forelse($resep as $item)

        <div class="col-lg-4">

            <div class="card shadow-sm border-0 rounded-4 h-100">

                <img
                    src="{{ asset('storage/'.$item->gambar) }}"
                    class="card-img-top"
                    style="height:220px;object-fit:cover;">

                <div class="card-body">

                    <h5 class="fw-bold">

                        {{ $item->judul }}

                    </h5>

                    <span class="badge bg-primary">

                        {{ $item->kategori }}

                    </span>

                    <p class="text-muted mt-3">

                        {{ Str::limit($item->deskripsi,100) }}

                    </p>

                    <a
                        href="{{ route('recipes.show',$item->id) }}"
                        class="btn btn-primary w-100">

                        Lihat Detail

                    </a>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="alert alert-warning">

                Belum ada resep.

            </div>

        </div>

        @endforelse

    </div>

    <div class="mt-5">

        {{ $resep->links() }}

    </div>

</div>

@endsection