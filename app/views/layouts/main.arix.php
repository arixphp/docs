<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} · {{ config('app.name') }}</title>
    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="theme-color" content="#0e8c6f">
    <meta property="og:image" content="{{ media('arix-combinationmark.webp') }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/webp" href="{{ media('arix-icon.webp') }}">
    <link rel="apple-touch-icon" href="{{ media('arix-icon.webp') }}">
    <link rel="stylesheet" href="{{ style('app.css') }}">
    <link rel="stylesheet" href="{{ style('docs.css') }}">
    <script type="module" src="{{ script('app.js') }}"></script>
    @if (!empty($_SERVER['FRANKENPHP_HOT_RELOAD']))
        <meta name="frankenphp-hot-reload:url" content="{{ $_SERVER['FRANKENPHP_HOT_RELOAD'] }}">
        <script type="module" src="{{ script('arix/dev-reload.js') }}"></script>
    @endif
</head>
<body>
    <a class="skip-link" href="#main-content">{{ trans('nav.skip') }}</a>
    <header>
        <a class="brand" href="{{ url('/') }}">
            <img class="brand-mark" src="{{ media('arix-icon.webp') }}" alt="" width="96" height="96" decoding="async">
            <span>{{ config('app.name') }}</span>
        </a>
        @include('partials.navigation')
    </header>
    <main id="main-content" tabindex="-1">@yield('content')</main>
    <footer>
        <div class="footer-identity">
            <a class="brand footer-brand" href="{{ url('/') }}">
                <img class="brand-mark" src="{{ media('arix-icon.webp') }}" alt="" width="96" height="96" decoding="async">
                <span>{{ config('app.name') }}</span>
            </a>
            <span>{{ trans('footer') }}</span>
        </div>
        <nav aria-label="{{ trans('nav.label') }}">
            <a href="{{ url('/') }}">{{ trans('nav.home') }}</a>
            <a href="{{ url('/guide/') }}">{{ trans('guide.navigation') }}</a>
            <a href="https://github.com/arixphp" target="_blank" rel="noopener noreferrer">GitHub</a>
        </nav>
    </footer>
</body>
</html>
