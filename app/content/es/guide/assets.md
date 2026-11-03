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

Los directorios públicos están sujetos a la política de recursos estáticos instalada, que permite extensiones específicas; colocar un archivo allí no garantiza que el servidor lo entregue. Por ejemplo, la política actual excluye SVG. Consulta `core/Assets/public-policy.json` para conocer la política instalada y [despliegue](deployment) para verificarla en tu servidor. Los directorios públicos de recursos no deben contener enlaces simbólicos ni archivos privados.

## Recursos administrados {#managed-assets}

La CLI administra `styles/arix/` y `scripts/arix/`. Coloca el código propio de la aplicación fuera de esos directorios para que las actualizaciones no lo sobrescriban.
