@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="row align-items-center mb-5">
            <div class="col-lg-7">
                <span class="badge bg-success px-3 py-2 rounded-pill mb-3">
                    🍽️ Bandung Culinary
                </span>

                @php
                    $judulKategori = request('kategori');
                @endphp

                <h1 class="display-5 fw-bold">
                    Semua
                    <span class="text-primary">
                        Resep Bandung
                    </span>
                </h1>

                <p class="lead text-muted">
                    Jelajahi berbagai resep khas Bandung mulai dari
                    makanan tradisional hingga minuman favorit.
                </p>
            </div>

            <div class="col-lg-5 text-end">
                <img
                    src="{{ asset('assets/img/depann.png') }}"
                    class="img-fluid hero-food">
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <form id="searchForm" action="{{ route('recipes.index') }}">
                <div class="input-group">
                    <span class="input-group-text bg-white border-0">
                        <i class="bi bi-search"></i>
                    </span>

                    <input
                        id="searchInput"
                        type="text"
                        class="form-control border-0"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari resep favoritmu...">
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex flex-wrap gap-2 mb-5 category-filter">
        @php
            $currentKategori = request('kategori');
        @endphp
        <a
            href="{{ route('recipes.index') }}"
            data-kategori=""
            class="btn rounded-pill category-btn {{ empty($currentKategori) ? 'btn-primary' : 'btn-light' }}">
            Semua
        </a>

        @foreach(['Minuman','Pedas','Gurih','Manis','Jajanan','Kuah','Tumis'] as $kategori)

        <a
            href="{{ route('recipes.index',['kategori'=>$kategori]) }}"
            data-kategori="{{ $kategori }}"
            class="btn rounded-pill category-btn {{ $currentKategori == $kategori ? 'btn-primary' : 'btn-light' }}">
            {{ $kategori }}
        </a>

        @endforeach
    </div>

    <div id="recipeContainer">
        @include('resep.partials.recipe-grid')
    </div>
</div>

<script>

const searchInput = document.getElementById('searchInput');
let currentKategori = "{{ request('kategori') }}";
let typingTimer;

function loadRecipes(){
    const keyword = searchInput.value;
    const params = new URLSearchParams();

    if(keyword){
        params.append('search', keyword);
    }

    if(currentKategori){
        params.append('kategori', currentKategori);
    }

    document.getElementById('recipeContainer').innerHTML = `
    <div class="row g-4">
    ${Array.from({length:6}).map(()=>`
    <div class="col-lg-4 col-md-6">
        <div class="recipe-card">
            <div class="recipe-image-wrapper">
                <div class="skeleton skeleton-image"></div>
            </div>

            <div class="recipe-body">
                <div class="skeleton skeleton-title"></div>

                <div class="d-flex justify-content-between mb-3">
                    <div class="skeleton" style="width:80px;height:14px;"></div>
                    <div class="skeleton" style="width:80px;height:14px;"></div>
                </div>

                <div class="skeleton skeleton-text"></div>
                <div class="skeleton skeleton-text"></div>
                <div class="skeleton skeleton-text short"></div>
                <div class="skeleton skeleton-button"></div>
            </div>
        </div>
    </div>
    `).join('')}
    </div>
    `;

    fetch("{{ route('recipes.index') }}?" + params.toString(),{
        headers:{
            'X-Requested-With':'XMLHttpRequest'
        }
    })

    .then(response=>response.text())
    .then(html=>{
        setTimeout(() => {
            const container = document.getElementById('recipeContainer');

            container.style.opacity = 0;
            container.innerHTML = html;

            container.animate(
                [
                    { opacity: 0 },
                    { opacity: 1 }
                ],
                {
                    duration: 250,
                    fill: 'forwards'
                }
            );

            history.replaceState(
                {},
                '',
                "{{ route('recipes.index') }}?" + params.toString()
            );

        }, 250); // 250ms agar shimmer sempat terlihat
    });
}

// SEARCH
searchInput.addEventListener('keyup',function(){
    clearTimeout(typingTimer);
    typingTimer = setTimeout(loadRecipes,300);
});

// FILTER KATEGORI
document.querySelectorAll('.category-btn').forEach(button=>{
    button.addEventListener('click',function(e){
        e.preventDefault();
        currentKategori = this.dataset.kategori;

        // warna tombol
        document.querySelectorAll('.category-btn').forEach(btn=>{
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-light');
        });

        this.classList.remove('btn-light');
        this.classList.add('btn-primary');
        loadRecipes();
    });
});

window.addEventListener('popstate', function () {

    const params = new URLSearchParams(window.location.search);

    currentKategori = params.get('kategori') || '';

    searchInput.value = params.get('search') || '';

    document.querySelectorAll('.category-btn').forEach(btn => {

        btn.classList.remove('btn-primary');
        btn.classList.add('btn-light');

        if (btn.dataset.kategori === currentKategori) {

            btn.classList.remove('btn-light');
            btn.classList.add('btn-primary');

        }

        if (currentKategori === '' && btn.dataset.kategori === '') {

            btn.classList.remove('btn-light');
            btn.classList.add('btn-primary');

        }

    });

    loadRecipes();

});

</script>

<style>
    .recipe-card{
        background:#fff;
        border-radius:22px;
        overflow:hidden;
        box-shadow:0 10px 25px rgba(0,0,0,.06);
        transition:all .35s ease;
        height:100%;
    }

    .recipe-card:hover{
        transform:translateY(-10px);
        box-shadow:
        0 25px 45px rgba(0,0,0,.15);
    }

    .recipe-image-wrapper{
        position:relative;
    }

    .recipe-image{
        width:100%;
        height:230px;
        object-fit:cover;
        transition:transform .45s ease;
    }

    .recipe-category{
        position:absolute;
        left:18px;
        bottom:18px;
        background:#1e88e5;
        color:white;
        padding:7px 16px;
        border-radius:50px;
        font-size:13px;
        font-weight:600;
        transition:all .35s ease;
    }

    .recipe-body{
        padding:25px;
    }

    .recipe-body h4{
        font-weight:700;
        margin-bottom:18px;
    }

    .recipe-meta{
        display:flex;
        justify-content:space-between;
        color:#777;
        font-size:14px;
        margin-bottom:18px;
        transition:.3s;
    }

    .recipe-body p{
        color:#666;
        line-height:1.7;
        min-height:78px;
    }

    .btn-detail{
        display:block;
        text-align:center;
        background:#1e88e5;
        color:white;
        text-decoration:none;
        padding:12px;
        border-radius:50px;
        transition:all .3s ease;
    }

    .btn-detail:hover{
        background:#0d6efd;
        color:white;
        transform:translateY(-2px);
    }

    .recipe-card:hover .recipe-image{
        transform:scale(1.08);
    }

    .recipe-card:hover .recipe-category{
        transform:translateY(-6px);
        background:#1565c0;
    }

    .recipe-card:hover .recipe-meta{
        color:#444;
    }

    /* ===================================
    Skeleton Loading (Shimmer Effect)
    =================================== */
    .skeleton{
        position: relative;
        overflow: hidden;
        background: #e9ecef;
        border-radius: 12px;
    }

    .skeleton::before{
        content:"";
        position:absolute;
        top:0;
        left:-150px;
        width:150px;
        height:100%;
        background:linear-gradient(
            90deg,
            transparent,
            rgba(255,255,255,.7),
            transparent
        );

        animation: shimmer 1.2s infinite;
    }

    @keyframes shimmer{
        100%{
            transform:translateX(600px);
        }
    }

    .skeleton-image{
        width:100%;
        height:220px;
    }

    .skeleton-title{
        height:24px;
        margin-bottom:18px;
    }

    .skeleton-text{
        height:14px;
        margin-bottom:12px;
    }

    .skeleton-text.short{
        width:70%;
    }

    .skeleton-button{
        width:45%;
        height:42px;
        border-radius:50px;
        margin-top:25px;
    }
</style>

@endsection