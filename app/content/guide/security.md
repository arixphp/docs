# Security

Protecting an application requires both safe application code and a correctly configured web server.

## Production Checklist {#production}

- Disable debug mode in production.
- Deny HTTP access to `.env`, its backups, private code, configuration, and test files.
- Configure trusted hosts before generating request-derived absolute URLs.
- Keep public asset directories free of links and private files.
- Validate visitor input and escape it when rendering HTML.

## Framework Scope {#scope}

Do not assume that authentication, sessions, CSRF protection, CORS, or file uploads are provided by the current application runtime. Evaluate your application's requirements before implementing features that depend on them.
