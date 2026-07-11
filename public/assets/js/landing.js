document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    let timeoutId;

    searchInput.addEventListener('input', function() {
        clearTimeout(timeoutId);
        
        timeoutId = setTimeout(() => {
            const keyword = this.value.trim();
            
            if (keyword.length > 0) {
                const BASE_URL = "/";
                fetch(`${BASE_URL}search?keyword=${keyword}`)
                    .then(response => response.json())
                    .then(data => {
                        searchResults.innerHTML = '';
                        
                        if (data.length > 0) {
                            const resultsContainer = document.createElement('div');
                            resultsContainer.className = 'row';
                            
                            data.forEach(item => {
                                const card = `
                                <div class="col-md-6 mb-2">
                                    <div class="search-card p-2">
                                        <div class="row g-0 align-items-center">
                                            <!-- Gambar lebih besar -->
                                            <div class="col-4">
                                                ${item.gambar ? 
                                                    `<img src="/storage/${item.gambar}" 
                                                        class="img-fluid rounded"
                                                        alt="${item.judul}">` 
                                                    : ''}
                                            </div>
                                            <div class="col-8">
                                                <div class="search-card-body">
                                                    <!-- Judul diperbesar -->
                                                    <h1 class="search-card-title">${item.judul}</h1>
                                                    <!-- Kategori di bawah judul -->
                                                    <div class="search-category">${item.kategori}</div>
                                                    <!-- Waktu, kesulitan, dan porsi sejajar di bawah kategori -->
                                                    <div class="search-details-container">
                                                        <div class="search-detail-box">${item.waktu}</div>
                                                        <div class="search-detail-box">${item.kesulitan}</div>
                                                        <div class="search-detail-box">${item.porsi}</div>
                                                    </div>
                                                    <a href="/resep/${item.id}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                                    resultsContainer.innerHTML += card;
                                });
                                
                                searchResults.appendChild(resultsContainer);
                            } else {
                                searchResults.innerHTML = `
                                    <div class="alert alert-info" style="font-size: 14px; padding: 5px;">
                                        Tidak ada resep yang sesuai dengan pencarian "${keyword}"
                                    </div>
                                `;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            searchResults.innerHTML = `
                                <div class="alert alert-danger" style="font-size: 14px; padding: 5px;">
                                    Terjadi kesalahan saat mencari resep
                                </div>
                            `;
                        });
                } else {
                    searchResults.innerHTML = '';
                }
            }, 500);
        });
    });