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

HTTP tests dispatch requests in process.

The test response supports `assertStatus()`, `assertOk()`, and `assertSee()`. The test case also provides methods such as `post()`, `put()`, `patch()`, and `delete()` for testing other routes.

To check formatting without changing files, run `arix format --test`. Neither testing nor formatting requires an application-side Composer installation.
