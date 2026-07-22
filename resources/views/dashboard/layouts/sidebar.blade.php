<aside class="sidebar">
    <div class="sidebar-logo">
        <h3>
            <span>Bandung</span>Eats
        </h3>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="/dashboard">
                <i class="bi bi-grid-fill"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('dashboard.resep') }}">
                <i class="bi bi-journal-bookmark-fill"></i>
                <span>Kelola Resep</span>
            </a>
        </li>

        <li>
            <a href="{{ route('dashboard.user') }}" class="sidebar-link">
                <i class="bi bi-people-fill"></i>
                <span>Kelola User</span>
            </a>
        </li>

        <li>
            <a href="/bookmarks">
                <i class="bi bi-bookmark-heart-fill"></i>
                Bookmark
            </a>
        </li>

        <li>
            <a href="/profile">
                <i class="bi bi-person-circle"></i>
                Profile
            </a>
        </li>
    </ul>
</aside>