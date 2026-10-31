<nav class="guide-nav" aria-label="Documentation">
    @foreach ($groups as $group => $pages)
        <div class="guide-group">
            <strong>{{ $group }}</strong>
            @foreach ($pages as $path => $entry)
                <a href="{{ url($path) }}" @if ($currentPath === $path) aria-current="page" @endif>{{ $entry[0] }}</a>
            @endforeach
        </div>
    @endforeach
</nav>
