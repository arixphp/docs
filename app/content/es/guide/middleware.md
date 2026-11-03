# Middleware {#middleware}

El middleware puede inspeccionar o gestionar una solicitud a su paso por la aplicación. Implementa `Arix\Contracts\Middleware` y se registra explícitamente en `app/bootstrap.php`.

## Crear middleware {#writing}

Crea una clase en `app/Middleware`. Llama al siguiente manejador para continuar y después devuelve su respuesta:

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

El middleware puede devolver una respuesta sin llamar al siguiente manejador cuando detiene intencionalmente la solicitud. Explicita su comportamiento y evita exponer información sensible en la respuesta.

## Registrar middleware {#registration}

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

Genera un punto de partida con `arix make:middleware Example`. Revisa la clase generada y regístrala antes de esperar que se ejecute.

## Middleware de ruta {#route-middleware}

Para aplicar middleware únicamente a una ruta específica, añade su clase a la definición de la ruta:

```php
use App\Middleware\ExampleMiddleware;

Route::get('/articles', [ArticleController::class, 'index'])
    ->middleware(ExampleMiddleware::class);
```

Usa un array ordenado para añadir más de una clase de middleware. El middleware debe poder resolverse desde el directorio de middleware de la aplicación o mediante un binding explícito del contenedor.
