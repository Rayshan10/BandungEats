<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>BandungEats - home</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/logobdg.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css" rel="stylesheet') }}">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

<!-- =======================================================
  * Template Name: eStartup
  * Template URL: https://bootstrapmade.com/estartup-bootstrap-landing-page-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="/home" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename"><span>Bandung</span>Eats</h1>
    </a>

    <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#resep">Resep</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#contact">Contact</a></li>
    
            @guest
                <!-- Jika user belum login -->
                <li><a href="{{ route('login') }}" class="active">Login</a></li>
            @endguest
    
            @auth
            <!-- Jika user sudah login -->
            <li class="profile-dropdown">
                <div class="profile-icon">
                    <img src="{{ auth()->user()->getProfilePhotoUrl() }}" alt="Profile" class="rounded-full w-10 h-10 object-cover">
                </div>
                <ul class="dropdown-menu">
                    <li><a href="/profile" class="dropdown-item">Edit Akun</a></li>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <li><a href="/resep" class="dropdown-item">Kelola Resep</a></li>
                    @endif
                    <li>
                        <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    </li>
                </ul>
            </li>
        @endauth
        
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
    

    </div>
    </header>

    <main class="main">

    <!-- Home Section -->
    <section id="home" class="home section light-background">

    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5">
        <div style="margin-top: 10px;" class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h2>Jelajahi cita rasa masakan khas kota Bandung</h2>
            <p>Menyajikan resep-resep pilihan yang mudah diikuti. Ayo temukan resep asli autentik khas kota Bandung</p>
            <div class="d-flex">
            <a href="#resep" class="btn-get-started">Get Started</a>
            </div>
        </div>
        <div style="margin-top: 10px;" class="col-lg-6 order-1 order-lg-2">
            <img src="assets/img/depann.png" class="img-fluid offset-2" alt="">
        </div>
        </div>
    </div>
        <div style="margin-bottom: -100px; margin-top: 50px;" class="container section-title" data-aos="fade-up">
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
                    </div><!--End Icon Box -->
                    @endforeach
                </div>
            </div>
        </div>

    </section><!-- /Home Section -->

    <!-- About Section -->
    <section id="about" class="about section">

    <div class="container">

        <div class="row gy-4">

        <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <p class="who-we-are">Tentang Kami</p>
            <h3>Hadir Untuk Melestarikan Resep Asli Masakan Khas Kota Bandung</h3>
            <p class="fst-italic">
                Selamat datang di BandungEats, surga bagi pecinta kuliner yang ingin merasakan cita rasa autentik khas Kota Bandung! Kami hadir untuk memperkenalkan kelezatan masakan tradisional Bandung yang kaya akan rempah dan sejarah. Dari kehangatan semangkuk seblak yang menggugah selera hingga manisnya pisang molen yang legendaris, BandungEats mengajak Anda menyelami setiap hidangan dengan cerita dan budaya yang melekat di dalamnya. Di sini, kami tidak hanya berbagi resep, tetapi juga membawa Anda dalam perjalanan mengenal kearifan lokal yang terkandung di balik setiap masakan khas Bandung.
            </p>
            <a href="#contact" class="read-more"><span>More Info</span><i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4">
                <!-- Gambar Besar -->
                <div class="col-lg-6">
                    <img src="assets/img/gedungsate.jpg" class="img-fluid large-img" alt="">
                </div>
        
                <!-- Dua Gambar Kecil di Sebelah Kanan -->
                <div class="col-lg-6">
                    <div class="row gy-4 d-flex flex-column">
                        <div class="col-lg-12">
                            <img src="assets/img/savoy.jpg" class="img-fluid small-img" alt="">
                        </div>
                        <div class="col-lg-12">
                            <img src="assets/img/pasopati2.jpg" class="img-fluid small-img" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        

        </div>

    </div>
    </section><!-- /About Section -->

    <!-- Resep Section -->
    <section id="resep" class="resep section">

    <!-- Resep Title -->
    <div style="margin-top: -50px; margin-bottom: -50px;" class="container section-title" data-aos="fade-up">
        <div><span>Ayo Cari</span> <span class="description-title">Resepnya</span></div>
        <div class="resep">
            <div class="search-container">
                <input type="text" class="search-input" id="searchInput" placeholder="Search for recipes..." />
            </div>
            <!-- Tambahkan div untuk hasil pencarian -->
            <div id="searchResults" class="mt-3"></div>
        </div>
    </div>
    
    <!-- Tambahkan script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    let timeoutId;

    searchInput.addEventListener('input', function() {
        clearTimeout(timeoutId);
        
        timeoutId = setTimeout(() => {
            const keyword = this.value.trim();
            
            if (keyword.length > 0) {
                fetch(`/search?keyword=${keyword}`)
                    .then(response => response.json())
                    .then(data => {
                        searchResults.innerHTML = '';
                        
                        if (data.length > 0) {
                            const resultsContainer = document.createElement('div');
                            resultsContainer.className = 'row';
                            
                            data.forEach(item => {
                                const card = `
                                <div class="col-md-6 mb-2">
                                    <div class="card p-2">
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
                                                <div class="card-body">
                                                    <!-- Judul diperbesar -->
                                                    <h1 class="card-title">${item.judul}</h1>
                                                    <!-- Kategori di bawah judul -->
                                                    <div class="category">${item.kategori}</div>
                                                    <!-- Waktu, kesulitan, dan porsi sejajar di bawah kategori -->
                                                    <div class="details-container">
                                                        <div class="detail-box">${item.waktu}</div>
                                                        <div class="detail-box">${item.kesulitan}</div>
                                                        <div class="detail-box">${item.porsi}</div>
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
    </script>
    
    <style>
    /* Kontainer hasil pencarian */
    #searchResults {
        margin-top: 10px;
        padding: 10px;
        border-radius: 10px;
    }

    /* Kartu hasil pencarian */
    .card {
        display: flex;
        align-items: center;
        padding: 12px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background-color: white;
    }

    /* Gambar pada hasil pencarian */
    .card img {
        width: 130px;  /* Perbesar ukuran gambar */
        height: 130px;
        object-fit: cover;
        border-radius: 8px;
    }

    /* Kontainer informasi */
    .card-body {
        padding: 8px;
        font-size: 14px;
        flex-grow: 1;
    }

    /* Judul resep */
    .card-title {
        font-size: 18px; /* Perbesar judul */
        font-weight: bold;
        margin-bottom: 5px;
    }

    /* Kategori, diletakkan di bawah judul */
    .category {
        font-size: 12px;
        background-color: #007bff;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
        margin-bottom: 5px;
    }

    /* Waktu, kesulitan, dan porsi sejajar */
    .details-container {
        display: flex;
        justify-content: flex-start;
        gap: 8px; /* Beri jarak antar elemen */
    }

    /* Elemen waktu, kesulitan, porsi */
    .detail-box {
        padding: 5px 8px;
        font-size: 12px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 5px;
        min-width: 60px;
    }

    /* Tombol Lihat lebih kecil */
    .btn-sm {
        font-size: 12px;
        padding: 4px 8px;
        margin-top: 5px;
    }

    </style>
    <!-- End Section Title -->

    <div class="container">

        <div class="row gy-4">
            <div class="container section-title" data-aos="fade-up">
                <div style="margin-left: -950px; margin-bottom: -60px;"><span class="description-title">Kategori</span></div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="resep-item position-relative" style="background-image: url('{{ asset('assets/img/pedas.jpg') }}'); background-size: cover; background-position: center; height: 300px;">
                    <a href="/kategori/pedas" class="stretched-link" style="position: absolute; bottom: 10px; left: 10px; color: white; text-decoration: none;">
                        <h3 style="font-size: 40px; font-weight: bold; text-shadow: 2px 2px 10px rgb(0, 0, 0); margin: 0; color: #00BFFF;">Pedas</h3>
                    </a>
                </div>
            </div>
            <!-- End Resep Item -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="resep-item position-relative" style="background-image: url('{{ asset('assets/img/gurih.jpg') }}'); background-size: cover; background-position: center; height: 300px;">
                    <a href="/kategori/gurih" class="stretched-link" style="position: absolute; bottom: 10px; left: 10px; color: white; text-decoration: none;">
                        <h3 style="font-size: 40px; font-weight: bold; text-shadow: 2px 2px 10px rgb(0, 0, 0); margin: 0; color: #00BFFF;">Gurih</h3>
                    </a>
                </div>
            </div>
            <!-- End Resep Item -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="resep-item position-relative" style="background-image: url('{{ asset('assets/img/manis.jpg') }}'); background-size: cover; background-position: center; height: 300px;">
                    <a href="/kategori/manis" class="stretched-link" style="position: absolute; bottom: 10px; left: 10px; color: white; text-decoration: none;">
                        <h3 style="font-size: 40px; font-weight: bold; text-shadow: 2px 2px 10px rgb(0, 0, 0); margin: 0; color: #00BFFF;">Manis</h3>
                    </a>
                </div>
            </div><div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="resep-item position-relative" style="background-image: url('{{ asset('assets/img/jajanan.jpg') }}'); background-size: cover; background-position: center; height: 300px;">
                    <a href="/kategori/jajanan" class="stretched-link" style="position: absolute; bottom: 10px; left: 10px; color: white; text-decoration: none;">
                        <h3 style="font-size: 40px; font-weight: bold; text-shadow: 2px 2px 10px rgb(0, 0, 0); margin: 0; color: #00BFFF;">Jajanan</h3>
                    </a>
                </div>
            </div>
            <!-- End Resep Item -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="resep-item position-relative" style="background-image: url('{{ asset('assets/img/minuman.jpg') }}'); background-size: cover; background-position: center; height: 300px;">
                    <a href="/kategori/minuman" class="stretched-link" style="position: absolute; bottom: 10px; left: 10px; color: white; text-decoration: none;">
                        <h3 style="font-size: 40px; font-weight: bold; text-shadow: 2px 2px 10px rgb(0, 0, 0); margin: 0; color: #00BFFF;">Minuman</h3>
                    </a>
                </div>
            </div>
            <!-- End Resep Item -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="resep-item position-relative" style="background-image: url('{{ asset('assets/img/favorit.jpg') }}'); background-size: cover; background-position: center; height: 300px;">
                    <a class="nav-link" href="{{ route('bookmarks.index') }}" style="position: absolute; bottom: 10px; left: 10px; color: white; text-decoration: none;">
                        <h3 style="font-size: 40px; font-weight: bold; text-shadow: 2px 2px 10px rgb(0, 0, 0); margin: 0; color: #00BFFF;">Favorit</h3>
                    </a>
                </div>
            </div>
            <!-- End Resep Item -->
        </div>
    </div>
    </section><!-- /Resep Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section light-background">

    <div class="container">

        <div class="row gy-4">

        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="content px-xl-5">
            <h3><span>Frequently Asked </span><strong style="color: #00BFFF">Questions</strong></h3>
            </div>
        </div>

        <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">

            <div class="faq-container">
            <div class="faq-item">
                <h3><span class="num">1.</span> <span>Apa itu BandungEats?</span></h3>
                <div class="faq-content">
                <p>BandungEats adalah sebuah website yang menyajikan berbagai resep masakan khas Bandung. Kami bertujuan untuk memperkenalkan cita rasa unik kuliner Bandung kepada seluruh pecinta masakan, baik di dalam maupun di luar kota Bandung.
                </p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
            </div><!-- End Faq item-->

            <div class="faq-item">
                <h3><span class="num">2.</span> <span>Apa saja jenis resep yang tersedia di BandungEats?</span></h3>
                <div class="faq-content">
                <p>Kami menyediakan berbagai resep masakan khas Bandung, seperti:<br>
                    - Makanan utama (contoh: Nasi Timbel, Lotek, Karedok)<br>
                    - Camilan khas (contoh: Cireng, Combro, Surabi)<br>
                    - Minuman khas (contoh: Bandrek, Bajigur, Es Goyobod)<br>
                    - Dessert tradisional (contoh: Colenak, Es Cendol, Es Doger)
                </p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
            </div><!-- End Faq item-->

            <div class="faq-item">
                <h3><span class="num">3.</span> <span> Apakah resep di BandungEats mudah diikuti?</span></h3>
                <div class="faq-content">
                <p>Ya, semua resep di BandungEats dilengkapi dengan langkah-langkah yang mudah diikuti, daftar bahan yang jelas, serta tips tambahan agar hasil masakan maksimal.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
            </div><!-- End Faq item-->

            <div class="faq-item">
                <h3><span class="num">4.</span> <span>Apakah BandungEats menyediakan resep untuk pemula?</span></h3>
                <div class="faq-content">
                <p>Tentu! Kami memiliki kategori khusus untuk pemula, dengan resep-resep sederhana yang bisa dicoba oleh siapa saja, bahkan tanpa pengalaman memasak sekalipun.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
            </div><!-- End Faq item-->

            <div class="faq-item">
                <h3><span class="num">5.</span> <span>Bagaimana jika saya memiliki pertanyaan atau masalah terkait resep?</span></h3>
                <div class="faq-content">
                <p>Jika Anda memiliki pertanyaan atau masalah, Anda dapat menghubungi kami melalui halaman "Contact" di website BandungEats. Kami akan dengan senang hati membantu Anda.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
            </div><!-- End Faq item-->

            </div>

        </div>
        </div>

    </div>

    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

    <!-- Section Title -->
    <div style="margin-top: -40px;" class="container section-title" data-aos="fade-up">
        <div><span>Butuh Bantuan?</span> <span class="description-title">Hubungi Kami!</span></div>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade" data-aos-delay="100">

        <div class="row gy-4">

        <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
            <i class="bi bi-geo-alt flex-shrink-0"></i>
            <div>
                <h3>Address</h3>
                <p>JL. Cijambe No. 2 Kel. PasirEndah Kec. Ujungberung, Bandung, Jawa Barat </p>
            </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
            <i class="bi bi-telephone flex-shrink-0"></i>
            <div>
                <h3>Call Us</h3>
                <p>+62 822 1547 9606</p>
            </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
            <i class="bi bi-envelope flex-shrink-0"></i>
            <div>
                <h3>Email Us</h3>
                <p>bandungeats@gmail.com</p>
            </div>
            </div><!-- End Info Item -->

        </div>

    </div>

    </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer light-background">

    <div class="container">
    <div class="copyright text-center ">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">BandungEats</strong> <span>All Rights Reserved</span></p>
    </div>
    <div class="social-links d-flex justify-content-center">
        <a href=""><i class="bi bi-twitter-x"></i></a>
        <a href=""><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
        <a href=""><i class="bi bi-linkedin"></i></a>
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">AR Developer</a>
    </div>
    </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>