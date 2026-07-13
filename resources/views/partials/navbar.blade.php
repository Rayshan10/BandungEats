<header id="header" class="header d-flex align-items-center sticky-top">
        
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
            
        <a href="/home" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename"><span>Bandung</span>Eats</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#" class="active">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#resep">Resep</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#contact">Contact</a></li>
            
                @guest
                    <!-- Jika user belum login -->
                    <li><a href="{{ route('login') }}">Login</a></li>
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
                        <li><a href="{{ route('dashboard') }}" class="dropdown-item">Kelola Resep</a></li>
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