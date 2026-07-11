<section>
    <div class="container section-title popular-title" data-aos="fade-up">
        <div><span>Resep</span> <span class="description-title">Populer</span></div>
    </div>
    <div class="icon-boxes position-relative" data-aos="fade-up" data-aos-delay="200">
        <div class="container position-relative">
            <div class="row gy-4 mt-5">
                @foreach($rekomendasiResep as $resep)
                <div class="col-xl-3 col-md-6">
                    <div class="icon-box">
                        <div class="icon">
                            <img src="{{ asset('storage/' . $resep->gambar) }}" alt="{{ $resep->judul }}" class="img-fluid full-width-img">
                        </div>
                        <h4 class="title">
                            <a href="{{ route('resep.show', $resep->id) }}" class="stretched-link">{{ $resep->judul }}</a>
                        </h4>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>