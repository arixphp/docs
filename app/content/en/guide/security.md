# Security

Protecting an application requires both safe application code and a correctly configured web server.

## Production Checklist {#production}

- Disable debug mode in production.
- Verify that your server applies the protection rules included with Arix, and protect any additional backups. Git ignore rules alone do not prevent HTTP access.
- Configure trusted hosts before generating request-derived absolute URLs.
- Keep public asset directories free of links and private files.
- Validate visitor input and escape it when rendering HTML.

Arix includes deny rules for `.env`, its dot-file variants, and other private paths in the supplied Apache, Caddy, and IIS configurations. Ensure the rules appropriate to your server are active and verify them through the deployed server without exposing private contents. Protect backups even when they use a different name, restrict filesystem permissions, and never log secrets. Public asset trees must not contain symbolic links; Caddy follows them. See [deployment](deployment) for policy generation and verification.

## Framework Scope {#scope}

Do not assume that authentication, sessions, CSRF protection, CORS, or file uploads are provided by the current application runtime. Evaluate your application's requirements before implementing features that depend on them.
