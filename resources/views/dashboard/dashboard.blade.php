@extends('dashboard.layouts.app')

@section('title','Dashboard')

@section('content')

<div class="container-fluid">
    <div class="dashboard-header mb-5">
        @php
        $hour = now()->hour;

        if($hour < 11){
            $greeting = "Selamat Pagi";
        }elseif($hour < 15){
            $greeting = "Selamat Siang";
        }elseif($hour < 18){
            $greeting = "Selamat Sore";
        }else{
            $greeting = "Selamat Malam";
        }
        @endphp
        <h2>
            {{ $greeting }},
            <span>{{ auth()->user()->name }}</span> 👋
        </h2>
        <p>
            Kelola seluruh resep khas Bandung melalui dashboard admin.
        </p>
    </div>
    <div class="row g-4">

        <!-- Total User -->
        <div class="col-lg-3 col-md-6">
            <div class="card dashboard-card dashboard-fade">
                <div class="card-body">
                    <div class="dashboard-icon bg-success">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <small>Total User</small>
                        <h2 class="counter" data-target="{{ $totalUser }}">0</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Resep -->
        <div class="col-lg-3 col-md-6">
            <div class="card dashboard-card dashboard-fade">
                <div class="card-body">
                    <div class="dashboard-icon bg-primary">
                        <i class="bi bi-journal-bookmark-fill"></i>
                    </div>
                    <div>
                        <small>Resep</small>
                        <h2 class="counter" data-target="{{ $totalResep }}">0</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kategori -->
        <div class="col-lg-3 col-md-6">
            <div class="card dashboard-card dashboard-fade">
                <div class="card-body">
                    <div class="dashboard-icon bg-warning">
                        <i class="bi bi-grid-fill"></i>
                    </div>
                    <div>
                        <small>Kategori</small>
                        <h2 class="counter" data-target="{{ $totalKategori }}">0</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bookmark -->
        <div class="col-lg-3 col-md-6">
            <div class="card dashboard-card dashboard-fade">
                <div class="card-body">
                    <div class="dashboard-icon bg-danger">
                        <i class="bi bi-bookmark-heart-fill"></i>
                    </div>
                    <div>
                        <small>Bookmark</small>
                        <h2 class="counter" data-target="{{ $totalBookmark }}">0</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card dashboard-card chart-card p-4">
                <h5 class="mb-4">
                    Jumlah Resep per Kategori
                </h5>

                <canvas id="kategoriChart" height="350"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')

<script>
const ctx = document.getElementById('kategoriChart');

const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);

gradient.addColorStop(0, '#2DD4FF');
gradient.addColorStop(1, '#0099DD');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            @foreach($kategori as $k)
                '{{ ucfirst($k->kategori) }}',
            @endforeach
        ],
        datasets: [{
            label: 'Jumlah Resep',
            data: [
                @foreach($kategori as $k)
                    {{ $k->total }},
                @endforeach
            ],

            backgroundColor: gradient,
            hoverBackgroundColor: '#0099dd',

            borderRadius: 12,
            borderSkipped: false,

            barThickness: 45,
            maxBarThickness: 55
        }]
    },

    options: {

        responsive: true,

        maintainAspectRatio: true,

        aspectRatio: 2.4,

        plugins: {

            legend: {
                display: false
            },

            tooltip: {
                backgroundColor: '#252525',
                titleColor: '#fff',
                bodyColor: '#fff'
            }

        }

    }
});

document.querySelectorAll('.counter').forEach(counter => {
    const target = Number(counter.dataset.target);
    const duration = 1200;
    const startTime = performance.now();

    function animate(currentTime){
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const value = Math.floor(progress * target);
        counter.textContent = value.toLocaleString();

        if(progress < 1){
            requestAnimationFrame(animate);
        }else{
            counter.textContent = target.toLocaleString();
        }
    }

    requestAnimationFrame(animate);
});
</script>

@endpush

<style>
    .dashboard-fade{
        opacity:0;
        transform:translateY(25px);
        animation:fadeCard .6s ease forwards;
    }

    .dashboard-fade:nth-child(1){
        animation-delay:.1s;
    }

    .dashboard-fade:nth-child(2){
        animation-delay:.2s;
    }

    .dashboard-fade:nth-child(3){
        animation-delay:.3s;
    }

    .dashboard-fade:nth-child(4){
        animation-delay:.4s;
    }

    @keyframes fadeCard{
        to{
            opacity:1;
            transform:translateY(0);
        }
    }
</style>

@endsection