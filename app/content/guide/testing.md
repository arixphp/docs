# Testing

The Arix CLI supplies the test runner. Your application tests live in `tests/` and use Pest syntax; you do not need to install Composer dependencies in the application.

## Running Tests {#running-tests}

```sh
arix tests
```

## HTTP Tests {#http-tests}

```php
it('shows the home page', function (): void {
    $this->get('/')->assertOk()->assertSee('Welcome');
});
```

HTTP tests dispatch requests in process. Keep framework tests in the CLI project and application-specific tests in your application.

The test response supports `assertStatus()`, `assertOk()`, and `assertSee()`. The test case also provides methods such as `post()`, `put()`, `patch()`, and `delete()` for testing other routes.

## Runtime Boundaries {#runtime-boundaries}

The default in-process test helper creates an application and kernel directly; it does not execute `app/bootstrap.php` or automatically load the HTTP runtime's `.env` scope. Therefore, a passing helper test alone does not prove that globally registered bootstrap middleware or web-server configuration works.

Test middleware with an explicitly configured kernel when appropriate, and verify server-specific behavior on a supported web server. If a direct application bootstrap needs `.env`, wrap the complete operation in `Arix\Runtime\Environment::run()`.

To check formatting without changing files, run `arix format --test`. Neither testing nor formatting requires an application-side Composer installation.
