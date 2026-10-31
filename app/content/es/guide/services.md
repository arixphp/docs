# Servicios {#services}

El contenedor de servicios administra las dependencias de la aplicación registradas explícitamente. Los controladores sin parámetros obligatorios en el constructor se pueden resolver directamente; las dependencias que requieren construcción deben registrarse explícitamente.

## Registro {#registration}

Usa el punto de entrada opcional `app/services.php` para registrar los servicios de la aplicación. Devuelve una función de registro. El contenedor no conecta automáticamente los argumentos del constructor.

Por ejemplo, si `ArticleController` necesita un `ArticleRepository`, registra ambas fábricas explícitamente:

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

Estos nombres son ejemplos de clases que creas en tu aplicación. Un binding crea un objeto al resolverse; usa `singleton` cuando deba reutilizarse la misma instancia durante la vida del contenedor.

Mantén el registro de servicios separado del procesamiento de solicitudes. El contexto de solicitud está disponible cuando se resuelven las fábricas, no cuando se declaran inicialmente los registros.
