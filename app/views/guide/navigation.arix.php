<nav class="guide-nav" aria-label="{{ trans('guide.navigation') }}">
    @foreach ($groups as $group => $pages)
        <div class="guide-group">
            <strong>{{ trans('guide.groups.' . $group) }}</strong>
            @foreach ($pages as $path => $entry)
                <a href="{{ url($path) }}" @if ($currentPath === $path) aria-current="page" @endif>{{ trans('guide.titles.' . $entry[2]) }}</a>
            @endforeach
        </div>
    @endforeach
</nav>
