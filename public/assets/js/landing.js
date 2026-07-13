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
                                <div class="col-12 mb-4">
                                    <div class="search-result-card">
                                        <img
                                            src="/storage/${item.gambar}"
                                            class="search-result-image"
                                            alt="${item.judul}">
                                        <div class="search-result-content">
                                            <h4>${item.judul}</h4>
                                            <span class="search-category-badge">
                                                ${item.kategori}
                                            </span>
                                            <div class="search-meta">
                                                <span>
                                                    <i class="bi bi-clock"></i>
                                                    ${item.waktu}
                                                </span>
                                                <span>
                                                    <i class="bi bi-people"></i>
                                                    ${item.porsi}
                                                </span>
                                                <span>
                                                    <i class="bi bi-bar-chart"></i>
                                                    ${item.kesulitan}
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <a
                                                href="/resep/${item.id}"
                                                class="btn btn-outline-primary rounded-pill">
                                                Lihat Resep
                                            </a>
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

document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', () => {
        const card = question.parentElement;
        card.classList.toggle('active');
    });
});