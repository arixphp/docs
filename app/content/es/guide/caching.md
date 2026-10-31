# Caché {#caching}

Arix almacena las plantillas compiladas separadas del código de la aplicación. Compilar plantillas no equivale a guardar una respuesta HTTP en caché.

## Comportamiento de la caché {#behavior}

El framework guarda las plantillas compiladas en `storage/cache`. Este directorio debe ser privado y la aplicación debe tener permisos de escritura. Configura la versión de la caché en `app/config/cache.php`; `cache.path` está reservado.

La API de rutas instalada actualmente no ofrece una caché HTML de rutas opcional. No supongas que compilar una plantilla almacena en caché el resultado de una página ni datos externos.
