# Troubleshooting

When an application does not behave as expected, check the runtime and server configuration before changing framework files.

## Development Server {#server}

Start local development with `arix dev`, not `php -S` or `php index.php`. Run `arix dev --help` to inspect options and check the server output for startup errors.

## Views and Cache {#views}

Ensure `storage/cache` is writable. A view name must resolve to either an `.arix.php` template or a `.php` template, not both. Confirm that controller class and filename casing match exactly.

Keep debug mode off on public deployments. Review server logs privately and never expose environment files or secrets while diagnosing an error.

## Server and Resources {#resources}

If a public asset is blocked, check its extension against the installed policy and verify the server configuration as described in [assets](assets) and [deployment](deployment). If request-derived links fail because of the host, check `app.trusted_hosts` and the actual request host rather than trusting forwarded headers from arbitrary clients. If `arix dev` cannot start, check the printed error, port availability, runtime download, and `arix dev --help`.
