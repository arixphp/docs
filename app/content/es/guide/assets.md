# Recursos {#assets}

Las hojas de estilo, scripts, fuentes y medios están en directorios públicos en la raíz de la aplicación. El servidor los entrega directamente, sin pasar por un endpoint PHP.

## Helpers de recursos {#asset-helpers}

```php
style('app.css')
script('app.js')
font('inter.woff2', versioned: true)
media('logo.webp', versioned: true)
```

Las hojas de estilo y los scripts utilizan versiones basadas en su contenido. Las fuentes y los medios pueden activar el versionado. Las rutas son relativas al directorio público correspondiente.

## Recursos administrados {#managed-assets}

La CLI administra `styles/arix/` y `scripts/arix/`. Coloca el código propio de la aplicación fuera de esos directorios para que las actualizaciones no lo sobrescriban.
