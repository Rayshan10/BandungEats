@if($bookmarkedReseps->count() > 0)
    <div class="row">
        @foreach($bookmarkedReseps as $item)
            <div class="col-md-12 mb-4">
                <div class="card bookmark-card border-0 shadow-sm rounded-4 overflow-hidden" id="bookmark-{{ $item->id }}">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-center">
                            @if($item->gambar)
                                <img
                                    src="{{ asset('storage/'.$item->gambar) }}"
                                    class="bookmark-image"
                                    alt="{{ $item->judul }}">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">{{ $item->judul }}</h5>
                                    <div class="d-flex gap-2">
                                        <a
                                            href="{{ route('recipes.show',$item->id) }}"
                                            class="btn btn-primary rounded-pill">
                                            <i class="bi bi-book me-1"></i>
                                            Detail
                                        </a>

                                        <form
                                            class="deleteBookmarkForm"
                                            action="{{ route('bookmarks.destroy',$item->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="btn btn-outline-danger rounded-pill">
                                                <i class="bi bi-heartbreak me-1"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <br>
                                <p class="card-text">{{ Str::limit($item->deskripsi, 150) }}</p>
                                <p class="card-text">
                                    <div class="d-flex flex-wrap gap-2 mt-3">
                                        <span class="badge bg-primary rounded-pill px-3 py-2">
                                            <i class="bi bi-tag-fill me-1"></i>
                                            {{ $item->kategori }}
                                        </span>

                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                                            <i class="bi bi-clock-fill me-1"></i>
                                            {{ $item->waktu }}
                                        </span>

                                        <span class="badge bg-success rounded-pill px-3 py-2">
                                            <i class="bi bi-bar-chart-fill me-1"></i>
                                            {{ $item->kesulitan }}
                                        </span>

                                        <span class="badge bg-info rounded-pill px-3 py-2">
                                            <i class="bi bi-people-fill me-1"></i>
                                            {{ $item->porsi }}
                                        </span>
                                    </div>
                                </p>
                            </div>
                        </div>
                </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-info">
        Belum ada resep yang ditambahkan ke favorit.
        <a href="/home#resep" class="alert-link">Jelajahi resep</a>
    </div>
@endif