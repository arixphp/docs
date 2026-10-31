<nav aria-label="Main navigation">
    <div class="nav-pages">
        <a href="{{ url('/') }}" @if(url()->currentPath() === '/') aria-current="page" @endif>Home</a>
        <a href="{{ url('/guide/') }}">Documentation</a>
    </div>
</nav>
