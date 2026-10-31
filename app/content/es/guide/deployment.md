# Despliegue {#deployment}

Las aplicaciones Arix están diseñadas para alojamiento PHP tradicional. La aplicación incluye el código necesario en ejecución, sin Composer, Node ni compilación frontend en el servidor.

## Requisitos del servidor {#requirements}

Utiliza PHP 8.4.1 o posterior con la extensión mbstring y una integración de servidor web compatible. El servidor de desarrollo integrado de PHP y la ejecución de `php index.php` no están soportados.

## Preparar la aplicación {#preparing}

Apunta el servidor web a la raíz de la aplicación y configura su controlador frontal y su política de recursos. Concede permisos de escritura a `storage/cache`, desactiva el modo de depuración y protege `.env` y los demás archivos privados contra el acceso HTTP.

```sh
arix assets:policy apache
arix assets:policy caddy
arix assets:policy iis
```

Revisa la política de tu servidor y la configuración relacionada antes del despliegue. Nunca expongas archivos privados ni enlaces mediante los directorios públicos de recursos.
