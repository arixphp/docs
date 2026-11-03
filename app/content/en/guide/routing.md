# Routing

Routes connect an HTTP request to a controller action. Register routes in `app/routes.php` using the `Route` facade.

## Basic Routes {#basic-routes}

```php
<?php

declare(strict_types=1);

use App\Controllers\WelcomeController;
use Arix\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('home');
```

Controller actions are public instance methods returning a response or a view.

## Route Parameters {#parameters}

A route can contain a parameter and an optional constraint:

```php
Route::get('/articles/{id:\d+}', [ArticleController::class, 'show']);
```

Read `id` from the request attributes in the controller. A parameter matches one path segment; its value is a string controlled by the visitor. Validate it for your use and escape it when rendering output.

For a complete controller example that reads and escapes an `id`, see [requests and responses](http#requests).

Constraints must be valid patterns without capturing groups or the `~` delimiter. Names beginning with `_arix_` are reserved. Optional trailing segments use square brackets:

```php
Route::get('/archive[/{year:\d+}]', [ArchiveController::class, 'index']);
```

## Named Routes {#named-routes}

Names let you generate links without repeating a route's path:

```php
Route::get('/articles/{id:\d+}', [ArticleController::class, 'show'])->name('article.show');

$url = route('article.show', ['id' => 5]);
```

The URL is absolute by default and includes the application mount. Missing or extra parameters and values that fail the route constraint cause an exception. To generate an internal root-relative path without the mount, pass `false` as the third argument.

## HTTP Methods {#http-methods}

Arix supports GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS, QUERY, and additional methods through `match`. GET routes also handle HEAD when no explicit HEAD route exists; OPTIONS is answered automatically unless a route is registered for it. Unknown paths return 404, while unsupported methods return 405 with an Allow header.

Trailing slashes are significant. Configure [trusted hosts](configuration) before generating absolute URLs from request data.
