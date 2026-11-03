<nav aria-label="{{ trans('nav.label') }}">
    <div class="nav-pages">
        <a href="{{ url('/') }}" @if(url()->currentPath() === '/') aria-current="page" @endif>{{ trans('nav.home') }}</a>
        <a href="{{ url('/guide/') }}" @if(url()->currentPath() === '/guide' || str_starts_with(url()->currentPath(), '/guide/')) aria-current="page" @endif>{{ trans('guide.navigation') }}</a>
        <a class="external-link" href="https://github.com/arixphp" target="_blank" rel="noopener noreferrer">
            GitHub
            @include('components.icons.arrow-right-up')
        </a>
    </div>
</nav>
