<header class="topbar">

    <div>
        <h4>@yield('title')</h4>
    </div>

    <div class="dropdown">
        <a
            class="d-flex align-items-center text-decoration-none dropdown-toggle"
            href="#"
            data-bs-toggle="dropdown">
            <img
                src="{{ Auth::user()->profile_photo_url }}"
                class="rounded-circle me-2"
                width="45"
                height="45">
            <span class="fw-semibold text-dark">
                {{ Auth::user()->name }}
            </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
            <li>
                <a
                    class="dropdown-item"
                    href="{{ route('home') }}">
                    <i class="bi bi-house-door me-2"></i>
                    Home
                </a>
            </li>
            <li>
                <a
                    class="dropdown-item"
                    href="{{ route('profile.edit') }}">
                    <i class="bi bi-person me-2"></i>
                    Edit Akun
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form
                    action="{{ route('logout') }}"
                    method="POST">
                    @csrf
                    <button
                        class="dropdown-item text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</header>