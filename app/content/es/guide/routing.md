# Enrutamiento {#routing}

Las rutas conectan una solicitud HTTP con una acción de controlador. Regístralas en `app/routes.php` usando la fachada `Route`.

## Rutas básicas {#basic-routes}

```php
<?php

declare(strict_types=1);

use App\Controllers\WelcomeController;
use Arix\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('home');
```

Las acciones de controlador son métodos públicos de instancia que devuelven una respuesta o una vista.

## Parámetros de ruta {#parameters}

Una ruta puede contener un parámetro y una restricción opcional:

```php
Route::get('/articles/{id:\d+}', [ArticleController::class, 'show']);
```

Lee `id` de los atributos de la solicitud en el controlador. Un parámetro corresponde a un segmento de ruta; su valor es una cadena controlada por el visitante. Valídalo para el uso previsto y escápalo al renderizar la salida.

Las restricciones deben ser patrones válidos sin grupos de captura ni el delimitador `~`. Los nombres que comienzan por `_arix_` están reservados. Los segmentos finales opcionales usan corchetes:

```php
Route::get('/archive[/{year:\d+}]', [ArchiveController::class, 'index']);
```

## Rutas con nombre {#named-routes}

Los nombres permiten generar enlaces sin repetir la ruta:

```php
Route::get('/articles/{id:\d+}', [ArticleController::class, 'show'])->name('article.show');

$url = route('article.show', ['id' => 5]);
```

La URL es absoluta por defecto e incluye el punto de montaje. Los parámetros ausentes o adicionales y los valores que no cumplen la restricción generan una excepción. Para generar una ruta interna relativa a la raíz sin el montaje, pasa `false` como tercer argumento.

## Métodos HTTP {#http-methods}

Arix admite GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS, QUERY y métodos adicionales mediante `match`. Las rutas GET también atienden HEAD cuando no hay una ruta HEAD explícita; OPTIONS se responde automáticamente salvo que se registre una ruta para él. Las rutas desconocidas devuelven 404; los métodos no soportados devuelven 405 con una cabecera Allow.

Las barras finales son significativas. Configura [hosts confiables](configuration) antes de generar URL absolutas a partir de los datos de la solicitud.
