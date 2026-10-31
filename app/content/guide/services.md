# Services

The service container manages explicitly registered application dependencies. Controllers without required constructor parameters can be resolved directly; dependencies that require construction must be registered explicitly.

## Registration {#registration}

Use the optional `app/services.php` entry point for your application's service registrations. It returns a registration closure. The container does not automatically wire constructor arguments.

For example, if `ArticleController` needs an `ArticleRepository`, register both factories explicitly:

```php
<?php

declare(strict_types=1);

use App\Controllers\ArticleController;
use App\Services\ArticleRepository;
use Arix\Container\Container;

return static function (Container $container): void {
    $container->bind(ArticleRepository::class, static fn (): ArticleRepository => new ArticleRepository());
    $container->bind(ArticleController::class, static fn (Container $container): ArticleController =>
        new ArticleController($container->get(ArticleRepository::class))
    );
};
```

These names are examples of application classes you create. A binding creates an object when resolved; use `singleton` when the same instance should be reused within the container's lifetime.

Keep service registration separate from request handling. Request context is available when factories resolve, not while registrations are first declared.
