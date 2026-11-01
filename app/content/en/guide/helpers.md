# Helpers

Arix provides helpers for common application tasks.

## URLs {#urls}

```php
url('/about')
route('home')
style('app.css')
script('app.js')
```

URL and asset helpers generate absolute URLs. During an HTTP request, Arix derives the application mount from request metadata; configure trusted hosts when generating request-derived links.

## Application Helpers {#application}

```php
use Arix\Markdown\DocumentReader;

app(DocumentReader::class)
app()
view('welcome', ['name' => 'Arix'])
config('app.name')
trans('nav.home')
env('APP_NAME', 'My Site')
```

Use `app(DocumentReader::class)` to resolve a service from the active container, or `app()` without an argument to access the container itself. Application services requiring constructor dependencies must be registered explicitly; see [services](services).

Use environment variables for deployment-specific values and configuration files for application settings. See [configuration](configuration) for security guidance.
