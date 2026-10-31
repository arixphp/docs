# Configuración {#configuration}

La configuración de la aplicación está en `app/config`. Los archivos de configuración devuelven arrays PHP y están disponibles mediante el helper `config`.

## Archivos de configuración {#configuration-files}

Por ejemplo, los valores de `app/config/app.php` están disponibles bajo la clave `app`:

```php
$name = config('app.name');
$url = config('app.url');
```

Usa `env()` en los archivos de configuración para valores específicos del despliegue y proporciona un valor predeterminado razonable. La configuración es código de la aplicación; no guardes secretos en archivos PHP versionados.

## Variables de entorno {#environment}

Un archivo opcional `.env` en la raíz contiene ajustes específicos del entorno. Por ejemplo:

```text
APP_NAME="My Site"
APP_URL="https://example.com"
APP_DEBUG=false
```

Mantén desactivado el modo de depuración en producción. Nunca incluyas `.env` en el control de versiones ni lo expongas mediante el servidor web; usa `.env.example` para valores predeterminados sin secretos.

Durante la ejecución HTTP, los valores `APP_` del `.env` de la aplicación tienen prioridad mediante `env()` sobre los valores existentes. Esta capa no cambia el entorno del proceso observado por llamadas directas a `getenv()`. Las variables del archivo sin el prefijo `APP_` no se añaden a la capa.

El entorno HTTP se encarga de cargar las variables. El código que inicia una aplicación directamente fuera de él debe envolver la operación completa en `Arix\Runtime\Environment::run($root, $callback)` cuando necesite el mismo ámbito. No añadas otro cargador a `index.php`.

## Hosts confiables {#trusted-hosts}

Configura `app.trusted_hosts` para restringir los hosts de las solicitudes al generar URL absolutas. No confíes implícitamente en cabeceras reenviadas por clientes no confiables.
