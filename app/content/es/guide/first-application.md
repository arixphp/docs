# Tu primera aplicación {#your-first-application}

Construyamos juntos una página sencilla. Después de [instalar Arix](installation) y crear una aplicación, abre el directorio del proyecto e inicia el servidor de desarrollo con `arix dev`.

## Definir una ruta {#route}

Añade una ruta a `app/routes.php`. Conserva las importaciones y rutas existentes y añade la importación del controlador y la ruta:

```php
use App\Controllers\HelloController;

Route::get('/hello', [HelloController::class, 'index']);
```

## Crear un controlador {#controller}

Crea `app/Controllers/HelloController.php`:

```php
<?php

declare(strict_types=1);

namespace App\Controllers;

use Arix\Views\Contracts\View;

class HelloController
{
    public function index(): View
    {
        return view('hello', ['name' => 'Arix']);
    }
}
```

## Crear una vista {#view}

Crea `app/views/hello.arix.php`. Las llaves dobles escapan el valor para HTML:

```html
<!doctype html>
<html lang="en">
<head><title>Hello</title></head>
<body>
    <h1>Hello, {{ $name }}!</h1>
</body>
</html>
```

Visita `/hello` en tu servidor local de desarrollo. La ruta selecciona el controlador, que devuelve la vista con sus datos.

## Probar la página {#test}

Añade una prueba en `tests/Feature/HelloTest.php`:

```php
<?php

declare(strict_types=1);

it('shows a greeting', function (): void {
    $this->get('/hello')->assertOk()->assertSee('Hello, Arix!');
});
```

Ejecuta `arix tests` desde la raíz de la aplicación. Continúa con [enrutamiento](routing) para conocer las rutas dinámicas y los métodos HTTP.
