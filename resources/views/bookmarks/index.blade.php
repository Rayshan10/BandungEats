@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <a href="{{ route('home') }}"
            class="btn btn-light rounded-pill shadow-sm mb-3">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

            <h1 class="display-5 fw-bold">
                ❤️ Bookmark Saya
            </h1>

            <p class="text-muted fs-5">
                Semua resep favorit yang telah Anda simpan.
            </p>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h2 id="bookmarkCount" class="fw-bold text-danger">
                        {{ auth()->user()->bookmarks()->count() }}
                    </h2>
                    <span class="text-muted">
                        Total Bookmark
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h2 class="fw-bold text-primary">
                        {{ auth()->user()->created_at->format('Y') }}
                    </h2>

                    <span class="text-muted">
                        Bergabung
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h2 class="fw-bold text-success">
                        ❤
                    </h2>

                    <span class="text-muted">
                        Favorit Saya
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-5">
        <div class="card-body">
            <div class="input-group">
                <span class="input-group-text bg-white border-0">
                    <i class="bi bi-search"></i>
                </span>

                <input
                    id="bookmarkSearch"
                    type="text"
                    class="form-control border-0"
                    placeholder="Cari bookmark favoritmu..."
                    autocomplete="off">
            </div> 
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div id="bookmarkContainer">
        @include('bookmarks.partials.bookmark-list')
    </div>
</div>

<script>
document.addEventListener('submit',function(e){
    if(!e.target.classList.contains('deleteBookmarkForm')){
        return;
    }

    e.preventDefault();

    if(!confirm("Hapus bookmark ini?")){
        return;
    }

    const form=e.target;

    fetch(form.action,{
        method:'POST',
        headers:{
            'X-CSRF-TOKEN':'{{ csrf_token() }}',
            'X-Requested-With':'XMLHttpRequest'
        },

        body:new FormData(form)
    })

    .then(res=>res.json())
    .then(data=>{
        if(data.success){
            const card=form.closest('.bookmark-card');
            card.style.transition=".4s";
            card.style.opacity="0";
            card.style.transform="translateX(-40px)";
            setTimeout(()=>{
                card.remove();
            },400);

            document.getElementById('bookmarkCount').innerText=data.total;
        }
    });
});
</script>

<style>
.bookmark-card{
    transition:.35s;
}

.bookmark-card:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 35px rgba(0,0,0,.12);
}

.bookmark-image{
    width:100%;
    height:225px;
    object-fit:cover;
    border-radius:18px;
}

.action-buttons{
    display:flex;
    gap:10px;
}
</style>

@endsection