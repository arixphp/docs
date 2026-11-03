# Estructura de la aplicación {#application-structure}

Una aplicación Arix mantiene tu código y el framework juntos, con una separación clara entre ambos.

## Directorios {#directories}

```text
app/       Código, rutas, vistas y configuración de la aplicación
core/      Código del framework administrado por la CLI
styles/    Hojas de estilo públicas
scripts/   JavaScript público
media/     Imágenes y otros medios públicos
fonts/     Archivos de fuentes públicas
storage/   Archivos privados de la aplicación, caché y registros
tests/     Pruebas de la aplicación
```

La aplicación comienza en `index.php`. Define las rutas en `app/routes.php` y guarda los controladores en `app/Controllers`. No edites `core/`; la CLI lo administra.

Los archivos privados administrados por `storage()` están bajo `storage/app/`. Los documentos Markdown del desarrollador pueden estar en el directorio opcional `app/content/`; consulta [almacenamiento de archivos](storage) y [Markdown](markdown).

## Carga automática {#autoloading}

El archivo `.arix.json` de la raíz declara los mapeos PSR-4. Las clases del espacio de nombres `App\` se resuelven desde `app/`; las mayúsculas de los directorios y archivos deben coincidir exactamente con sus espacios de nombres.
