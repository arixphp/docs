# Deployment

Arix applications are designed for traditional PHP hosting. The application ships the code it needs at runtime, without Composer, Node, or a frontend build on the server.

## Server Requirements {#requirements}

Use PHP 8.4.1 or newer with the mbstring extension and a supported web server integration. PHP's built-in development server and running `php index.php` are not supported.

## Preparing Your Application {#preparing}

Point your web server at the application root and configure its front-controller and asset policy. Make `storage/cache` writable, keep debug mode disabled, and protect `.env` and other private files from HTTP access.

```sh
arix assets:policy apache
arix assets:policy caddy
arix assets:policy iis
```

Review the policy for your server and its surrounding configuration before deployment. Never expose private application files or linked files through public asset directories.
