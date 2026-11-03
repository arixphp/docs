# Deployment

Arix applications are designed for traditional PHP hosting. The application ships the code it needs at runtime, without Composer, Node, or a frontend build on the server.

## Server Requirements {#requirements}

Use PHP 8.4.1 or newer with the mbstring extension and a supported web server integration. PHP's built-in development server and running `php index.php` are not supported.

## Preparing Your Application {#preparing}

On your development computer, run `arix tests` and prepare the application files. No Composer, Node, or build command is required on the server. Keep local secrets and development-only files private.

Make `storage/cache` writable if necessary and keep debug mode disabled. Configure [trusted hosts](configuration#trusted-hosts) before generating request-derived absolute URLs.

```sh
arix assets:policy apache
arix assets:policy caddy
arix assets:policy iis
```

These commands print the generated policy for inspection; they do not apply it to the server. Run the command for your server on your development computer and incorporate the output into the appropriate server configuration. Use `--check=/path/to/config` to compare a configuration file with the managed policy; a successful check does not replace native server verification. Apache public-directory `.htaccess` files can be checked with `arix assets:policy apache --directory=styles`, and likewise for `scripts`, `fonts`, and `media`.

After deployment, verify the site and static assets through the actual web server. Check that requests for private files and `.env` variants are denied, without exposing their contents. Test the server's native configuration and rewrites, including any application subdirectory. Never expose private application files or symbolic links through public asset directories. See [security](security) for the production checklist.
