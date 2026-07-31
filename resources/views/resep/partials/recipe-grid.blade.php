<div class="row g-4">
    @forelse($resep as $item)
    <div class="col-lg-4 col-md-6">
        <div class="recipe-card h-100">
            <div class="recipe-image-wrapper">
                <img
                    src="{{ asset('assets/img/'.$item->gambar) }}"
                    class="recipe-image"
                    alt="{{ $item->judul }}">

                <span class="recipe-category">
                    {{ $item->kategori }}
                </span>
            </div>

            <div class="recipe-body">
                <h4>
                    {{ $item->judul }}
                </h4>

                <div class="recipe-meta">
                    <span>
                        <i class="bi bi-clock"></i>
                        {{ $item->waktu }}
                    </span>

                    <span>
                        <i class="bi bi-bar-chart"></i>
                        {{ $item->kesulitan }}
                    </span>
                </div>

                <p>
                    {{ Str::limit($item->deskripsi,90) }}
                </p>

                <a
                    href="{{ route('recipes.show',$item->id) }}"
                    class="btn-detail">
                    <i class="bi bi-book"></i>
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