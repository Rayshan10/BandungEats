<section id="resep" class="home-search-section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">
                🔎 Cari Resep
            </span>
            <h2>
                Temukan Resep Favoritmu
            </h2>
            <p>
                Cari resep khas Bandung berdasarkan nama makanan atau kategori.
            </p>
        </div>
        <div class="search-wrapper">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" placeholder="Cari resep khas Bandung..." >
            <button class="search-btn">
                Cari
            </button>
        </div>
        <div id="searchResults"></div>
        <!-- Category -->
        <div class="category-section">
            <div class="category-header">
                <span class="section-badge">
                    🍽 Kategori
                </span>
                <h3>Jelajahi Berdasarkan Kategori</h3>
                <p>
                    Pilih kategori favoritmu dan temukan resep khas Bandung.
                </p>
            </div>
            @php
            $categories = [
            [
                'title' => 'Pedas',
                'image' => 'pedas.jpg',
                'icon'  => '🌶',
                'route' => '/kategori/pedas'
            ],
            [
                'title' => 'Gurih',
                'image' => 'gurih.jpg',
                'icon'  => '🍗',
                'route' => '/kategori/gurih'
            ],
            [
                'title' => 'Manis',
                'image' => 'manis.jpg',
                'icon'  => '🍰',
                'route' => '/kategori/manis'
            ],
            [
                'title' => 'Jajanan',
                'image' => 'jajanan.jpg',
                'icon'  => '🍢',
                'route' => '/kategori/jajanan'
            ],
            [
                'title' => 'Minuman',
                'image' => 'minuman.jpg',
                'icon'  => '🥤',
                'route' => '/kategori/minuman'
            ],
            [
                'title' => 'Favorit',
                'image' => 'favorit.jpg',
                'icon'  => '❤️',
                'route' => route('bookmarks.index')
            ]
            ];
            @endphp
            <div class="row g-4 mt-2">
                @foreach($categories as $category)
                
                <div class="col-lg-4 col-md-6">
                    <a href="{{ $category['route'] }}" class="category-card">
                        <img src="{{ asset('assets/img/'.$category['image']) }}" alt="{{ $category['title'] }}">
                        <div class="category-overlay">
                            <span class="category-icon">
                                {{ $category['icon'] }}
                            </span>
                            <h4>
                                {{ $category['title'] }}
                            </h4>
                            <p>
                                Lihat resep →
                            </p>
                        </div>
                    </a>
                </div>

                @endforeach
            </div>
        </div>
    </div>
</section>