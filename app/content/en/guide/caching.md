# Caching

Arix stores compiled templates separately from your application code. Template compilation is not the same as caching an HTTP response.

## Cache Behavior {#behavior}

The framework keeps compiled templates in `storage/cache`. This directory must be private and writable by the application. Configure the cache version in `app/config/cache.php`.

The currently installed routing API does not provide an opt-in route HTML cache. Do not assume that compiling a template caches a page's rendered output or external data.
