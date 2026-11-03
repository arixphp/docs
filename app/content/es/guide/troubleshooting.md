# Solución de problemas {#troubleshooting}

Cuando una aplicación no se comporta como esperas, comprueba el entorno de ejecución y la configuración del servidor antes de cambiar archivos del framework.

## Servidor de desarrollo {#server}

Inicia el desarrollo local con `arix dev`, no con `php -S` ni `php index.php`. Ejecuta `arix dev --help` para consultar las opciones y revisa la salida del servidor en busca de errores de inicio.

## Vistas y caché {#views}

Comprueba que `storage/cache` permita escritura. El nombre de una vista debe resolverse a una plantilla `.arix.php` o a una plantilla `.php`, no a ambas. Confirma que las mayúsculas del nombre de la clase controladora y del archivo coincidan exactamente.

Mantén desactivado el modo de depuración en despliegues públicos. Revisa los registros del servidor de forma privada y nunca expongas archivos de entorno ni secretos al diagnosticar un error.

## Servidor y recursos {#resources}

Si se bloquea un recurso público, comprueba su extensión frente a la política instalada y verifica la configuración del servidor como se describe en [recursos](assets) y [despliegue](deployment). Si fallan los enlaces derivados de la solicitud por el host, revisa `app.trusted_hosts` y el host real de la solicitud en lugar de confiar en cabeceras reenviadas por clientes arbitrarios. Si `arix dev` no inicia, revisa el error mostrado, la disponibilidad del puerto, la descarga del entorno y `arix dev --help`.
