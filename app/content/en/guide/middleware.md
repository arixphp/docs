# Middleware

Middleware can inspect or handle a request as it passes through your application. Middleware implements `Arix\Contracts\Middleware` and is registered explicitly in `app/bootstrap.php`.

## Writing Middleware {#writing}

Create a class in `app/Middleware`. Call the next handler to continue, then return its response:

```php
<?php

declare(strict_types=1);

namespace App\Middleware;

use Arix\Contracts\Middleware;
use Arix\HttpFoundation\Request;
use Arix\HttpFoundation\Response;
use Closure;

class ExampleMiddleware implements Middleware
{
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
}
```

Middleware may return a response without calling the next handler when it intentionally stops the request. Be explicit about the behavior and avoid exposing sensitive information in a response.

## Registering Middleware {#registration}

```php
use App\Middleware\SetLocale;
use Arix\Application;
use Arix\Http\MiddlewareConfiguration;

return Application::configure(dirname(__DIR__))
    ->withMiddleware(static function (MiddlewareConfiguration $middleware): void {
        $middleware->append(SetLocale::class);
    })
    ->create();
```

Generate a starting point with `arix make:middleware Example`. Review the generated class and register it before expecting it to run.

## Route Middleware {#route-middleware}

To apply middleware only to a specific route, attach its class to the route definition:

```php
use App\Middleware\ExampleMiddleware;

Route::get('/articles', [ArticleController::class, 'index'])
    ->middleware(ExampleMiddleware::class);
```

Use an ordered array to attach more than one middleware class. Middleware must be resolvable under the application's middleware directory or through an explicit container binding.
