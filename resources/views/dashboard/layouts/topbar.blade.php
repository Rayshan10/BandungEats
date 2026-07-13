<header class="topbar">
    <div>
        <h4>
            @yield('title')
        </h4>
    </div>
    <div class="topbar-profile">
        <img
            src="{{ auth()->user()->getProfilePhotoUrl() }}"
            alt="">
        <span>
            {{ auth()->user()->name }}
        </span>
    </div>
</header>