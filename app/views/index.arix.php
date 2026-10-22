<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="arix-deployment-id" content="arix-docs-beb8dc1931ff1403c70449eba094fe45">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ArixPHP documentation is currently being prepared.">
    <meta name="theme-color" content="#f5f8f9" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#101820" media="(prefers-color-scheme: dark)">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" href="{{ media('arix-icon.webp') }}" type="image/webp">
    <link rel="stylesheet" href="{{ style('notice.css') }}">
    <title>Documentation is under construction · ArixPHP</title>
    @if (!empty($_SERVER['FRANKENPHP_HOT_RELOAD']))
        <meta name="frankenphp-hot-reload:url" content="{{ $_SERVER['FRANKENPHP_HOT_RELOAD'] }}">
        <script type="module" src="{{ script('arix/dev-reload.js') }}"></script>
    @endif
</head>
<body>
    <main class="notice" aria-labelledby="home-title">
        <div class="brand">
            <img src="{{ media('arix-combinationmark.webp') }}" width="750" height="500" alt="ArixPHP" fetchpriority="high" decoding="async">
        </div>
        <h1 id="home-title">Documentation is under construction.</h1>
        <p class="lead">We’re preparing practical guides and references for ArixPHP. Please check back soon.</p>
        <aside class="status" aria-label="Documentation status">
            <span class="status-dot" aria-hidden="true"></span>
            <p class="status-copy">
                <strong>Building the docs</strong>
                New material is on its way.
            </p>
        </aside>
    </main>
</body>
</html>
