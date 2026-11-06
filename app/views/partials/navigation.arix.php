<nav aria-label="{{ trans('nav.label') }}">
    <div class="nav-pages">
        <a href="{{ url('/') }}" @if(url()->currentPath() === '/') aria-current="page" @endif>{{ trans('nav.home') }}</a>
        <a href="{{ url('/') }}#features">{{ trans('nav.features') }}</a>
        <a href="{{ url('/guide/') }}" @if(url()->currentPath() === '/guide' || str_starts_with(url()->currentPath(), '/guide/')) aria-current="page" @endif>{{ trans('guide.navigation') }}</a>
        <a href="{{ url('/blog') }}" @if(url()->currentPath() === '/blog' || str_starts_with(url()->currentPath(), '/blog/')) aria-current="page" @endif>{{ trans('blog.title') }}</a>
        <a class="external-link" href="https://github.com/arixphp" target="_blank" rel="noopener noreferrer">
            GitHub
            @include('components.icons.arrow-right-up')
        </a>
    </div>
</nav>
