# Configuration

Application configuration lives in `app/config`. Configuration files return PHP arrays and are available through the `config` helper.

## Configuration Files {#configuration-files}

For example, values returned by `app/config/app.php` are available under the `app` key:

```php
$name = config('app.name');
$url = config('app.url');
```

Use `env()` in configuration files for deployment-specific values and provide a sensible default. Configuration is application code; do not place secrets in committed PHP files.

## Environment Variables {#environment}

An optional `.env` file at the application root contains environment-specific settings. For example:

```text
APP_NAME="My Site"
APP_URL="https://example.com"
APP_DEBUG=false
```

Keep debug mode disabled in production. Never commit your `.env` file or expose it through your web server; use `.env.example` for non-secret defaults.

During HTTP runtime, `APP_` values from the application's `.env` take precedence through `env()` over existing environment values. The overlay does not change the process environment observed by direct `getenv()` calls. Variables without the `APP_` prefix in that file are not added to the overlay.

The HTTP runtime owns environment loading. Code that boots an application directly outside it must use `Arix\Runtime\Environment::run($root, $callback)` around the complete operation when it needs the same environment scope. Do not add a second loader to `index.php`.

## Trusted Hosts {#trusted-hosts}

Configure `app.trusted_hosts` to constrain request hosts when generating absolute URLs. Do not implicitly trust forwarded headers from untrusted clients.
