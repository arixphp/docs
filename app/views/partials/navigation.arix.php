<nav aria-label="{{ trans('nav.label') }}">
    <div class="nav-pages">
        <a href="{{ url('/') }}" @if(url()->currentPath() === '/') aria-current="page" @endif>{{ trans('nav.home') }}</a>
        <a href="{{ url('/guide/') }}">{{ trans('guide.navigation') }}</a>
    </div>
</nav>
