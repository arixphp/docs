<nav aria-label="{{ trans('nav.label') }}">
    <div class="nav-pages">
        <a href="{{ url('/') }}" @if(url()->currentPath() === '/') aria-current="page" @endif>{{ trans('nav.home') }}</a>
        <a href="{{ url('/guide/') }}">{{ trans('guide.navigation') }}</a>
        <a href="https://github.com/arixphp" target="_blank" rel="noopener noreferrer">GitHub</a>
    </div>
</nav>
