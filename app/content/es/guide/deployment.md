# Despliegue {#deployment}

Las aplicaciones Arix están diseñadas para alojamiento PHP tradicional. La aplicación incluye el código necesario en ejecución, sin Composer, Node ni compilación frontend en el servidor.

## Requisitos del servidor {#requirements}

Utiliza PHP 8.4.1 o posterior con la extensión mbstring y una integración de servidor web compatible. El servidor de desarrollo integrado de PHP y la ejecución de `php index.php` no están soportados.

## Preparar la aplicación {#preparing}

En tu computadora, ejecuta `arix tests` y prepara los archivos de la aplicación. No es necesario ejecutar Composer, Node ni comandos de compilación en el servidor. Mantén privados los secretos locales y los archivos exclusivos de desarrollo.

Concede permisos de escritura a `storage/cache` si es necesario y desactiva el modo de depuración. Configura [hosts confiables](configuration#trusted-hosts) antes de generar URL absolutas a partir de solicitudes.

```sh
arix assets:policy apache
arix assets:policy caddy
arix assets:policy iis
```

Estos comandos muestran la política generada para su revisión; no la aplican al servidor. Ejecuta en tu computadora el comando correspondiente e incorpora la salida a la configuración adecuada. Usa `--check=/ruta/a/configuracion` para comparar un archivo de configuración con la política administrada; una comprobación satisfactoria no sustituye la verificación nativa del servidor. Los archivos `.htaccess` de los directorios públicos de Apache pueden comprobarse con `arix assets:policy apache --directory=styles`, y de igual forma para `scripts`, `fonts` y `media`.

Después del despliegue, verifica el sitio y sus recursos estáticos mediante el servidor web real. Comprueba que se deniegue el acceso a archivos privados y variantes de `.env`, sin exponer su contenido. Verifica la configuración nativa y las reescrituras, incluido cualquier subdirectorio de la aplicación. Nunca expongas archivos privados ni enlaces simbólicos mediante los directorios públicos de recursos. Consulta la lista de producción en [seguridad](security).
