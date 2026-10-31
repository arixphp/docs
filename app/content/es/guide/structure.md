# Estructura de la aplicación {#application-structure}

Una aplicación Arix mantiene tu código y el framework juntos, con una separación clara entre ambos.

## Directorios {#directories}

```text
app/       Application code, routes, views, and configuration
core/      Framework code managed by the CLI
styles/    Public stylesheets
scripts/   Public JavaScript
media/     Public images and other media
fonts/     Public font files
storage/   Private cache and logs
tests/     Application tests
```

La aplicación comienza en `index.php`. Define las rutas en `app/routes.php` y guarda los controladores en `app/Controllers`. No edites `core/`; la CLI lo administra.

## Carga automática {#autoloading}

El archivo `.arix.json` de la raíz declara los mapeos PSR-4. Las clases del espacio de nombres `App\` se resuelven desde `app/`; las mayúsculas de los directorios y archivos deben coincidir exactamente con sus espacios de nombres.
