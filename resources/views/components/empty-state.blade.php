<div class="text-center py-5">

    <div class="mb-4">
        <i class="bi {{ $icon }} display-1 text-primary"></i>
    </div>

    <h3 class="fw-bold mb-3">
        {{ $title }}
    </h3>

    <p class="text-muted mb-4" style="max-width: 500px; margin:auto;">
        {{ $text }}
    </p>

    @isset($url)
        <a href="{{ $url }}" class="btn btn-primary rounded-pill px-4">
            {{ $button }}
        </a>
    @endisset

</div>