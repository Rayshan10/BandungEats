<section id="popular" class="popular-section">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-badge">
                🔥 Resep Pilihan
            </span>
            <h2>
                Resep Populer
            </h2>
            <p>
                Resep favorit yang paling banyak dilihat oleh pengguna BandungEats.
            </p>
        </div>

        <div class="row g-4">
            @foreach($rekomendasiResep as $resep)
            <div class="col-lg-3 col-md-6">
                <div class="recipe-card">
                    <img
                        src="{{ asset('storage/'.$resep->gambar) }}"
                        alt="{{ $resep->judul }}"
                        class="recipe-image">
                    <div class="recipe-body">
                        <h3 class="recipe-title">
                            {{ $resep->judul }}
                        </h3>

                        <span class="recipe-category">
                            {{ ucfirst($resep->kategori) }}
                        </span>

                        <div class="recipe-info">

                            <span>
                                <i class="bi bi-clock"></i>
                                {{ $resep->waktu }}
                            </span>

                            <span>
                                <i class="bi bi-people"></i>
                                {{ $resep->porsi }}
                            </span>

                        </div>

                        <div class="recipe-level">
                            <i class="bi bi-bar-chart"></i>
                            {{ $resep->kesulitan }}
                        </div>
                        <a
                            href="{{ route('resep.show',$resep->id) }}"
                            class="btn btn-primary btn-sm">
                            Lihat Resep
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>