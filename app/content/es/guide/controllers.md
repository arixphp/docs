# Controladores {#controllers}

Los controladores organizan las acciones que responden a las rutas de la aplicación. Guárdalos en `app/Controllers`, con nombres de archivo y mayúsculas de espacio de nombres que coincidan exactamente.

## Crear controladores {#writing-controllers}

```php
<?php

declare(strict_types=1);

namespace App\Controllers;

use Arix\Views\Contracts\View;

class WelcomeController
{
    public function index(): View
    {
        return view('welcome', ['name' => 'Arix']);
    }
}
```

Registra la acción en `app/routes.php`. Las acciones deben ser métodos públicos de instancia sin argumentos o con un argumento de solicitud obligatorio, y devolver una respuesta o una vista.

## Dependencias {#dependencies}

Los controladores sin parámetros obligatorios en el constructor se pueden resolver directamente. Registra explícitamente en el contenedor las dependencias obligatorias; Arix no las conecta automáticamente. Consulta [servicios](services) para ver un ejemplo de registro.
