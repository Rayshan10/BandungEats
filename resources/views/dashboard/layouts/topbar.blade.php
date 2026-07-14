<header class="topbar">

    <div>
        <h4>@yield('title')</h4>
    </div>

    <div class="topbar-profile">

        @auth
            <img
                src="{{ auth()->user()->getProfilePhotoUrl() }}"
                alt="Profile">

            <span>{{ auth()->user()->name }}</span>
        @else

            <img
                src="{{ asset('assets/img/default-profile.png') }}"
                alt="Guest">

            <span>Guest</span>

        @endauth

    </div>

</header>