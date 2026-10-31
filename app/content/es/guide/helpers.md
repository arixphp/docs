# Helpers {#helpers}

Arix proporciona helpers para tareas habituales de la aplicación. Los helpers que acceden a servicios deben ejecutarse dentro de un contenedor de aplicación activo.

## URL {#urls}

```php
url('/about')
route('home')
style('app.css')
script('app.js')
```

Los helpers de URL y recursos generan URL absolutas. Durante una solicitud HTTP, Arix deduce el punto de montaje a partir de sus metadatos; configura hosts confiables al generar enlaces basados en la solicitud.

## Helpers de aplicación {#application}

```php
use Arix\Markdown\DocumentReader;

app(DocumentReader::class)
app()
view('welcome', ['name' => 'Arix'])
config('app.name')
trans('nav.home')
env('APP_NAME', 'My Site')
```

Usa `app(DocumentReader::class)` para resolver un servicio del contenedor activo, o `app()` sin argumento para acceder al propio contenedor. Los servicios de la aplicación que requieren dependencias de constructor deben registrarse explícitamente; consulta [servicios](services).

Usa variables de entorno para valores específicos del despliegue y archivos de configuración para ajustes de la aplicación. Consulta [configuración](configuration) para obtener recomendaciones de seguridad.
