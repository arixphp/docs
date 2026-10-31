# Troubleshooting

When an application does not behave as expected, check the runtime and server configuration before changing framework files.

## Development Server {#server}

Start local development with `arix dev`, not `php -S` or `php index.php`. Run `arix dev --help` to inspect options and check the server output for startup errors.

## Views and Cache {#views}

Ensure `storage/cache` is writable. A view name must resolve to either an `.arix.php` template or a `.php` template, not both. Confirm that controller class and filename casing match exactly.

Keep debug mode off on public deployments. Review server logs privately and never expose environment files or secrets while diagnosing an error.
