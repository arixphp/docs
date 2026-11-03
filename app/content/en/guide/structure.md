# Application Structure

An Arix application keeps your code and the framework together, with a clear boundary between them.

## Directories {#directories}

```text
app/       Application code, routes, views, and configuration
core/      Framework code managed by the CLI
styles/    Public stylesheets
scripts/   Public JavaScript
media/     Public images and other media
fonts/     Public font files
storage/   Private application files, cache, and logs
tests/     Application tests
```

Your application begins at `index.php`. Define routes in `app/routes.php` and keep your controllers in `app/Controllers`. Do not edit `core/`; it is managed by the CLI.

Private files managed by `storage()` live under `storage/app/`. Developer-owned Markdown can live under the optional `app/content/` directory; see [file storage](storage) and [Markdown](markdown).

## Autoloading {#autoloading}

The root `.arix.json` declares PSR-4 mappings. Classes in the `App\` namespace resolve from `app/`; directory and filename case must match their namespaces exactly.
