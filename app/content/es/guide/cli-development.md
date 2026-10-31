# Servidor de desarrollo {#development-server}

La CLI de Arix ejecuta tu aplicación localmente mediante un servidor FrankenPHP administrado. Es una herramienta de desarrollo, no una configuración de servidor de producción.

## Iniciar el servidor {#starting}

```sh
arix dev
```

Ejecuta el comando desde la raíz de la aplicación y abre la dirección que aparece en la terminal. Por defecto es `http://127.0.0.1:8181`; si el puerto está ocupado, la CLI puede probar puertos posteriores. Pulsa Ctrl+C para detener el servidor.

En el primer uso, la CLI descarga una versión fijada del entorno para plataformas compatibles y verifica su SHA-256 antes de ejecutarlo. Los inicios posteriores utilizan la caché local verificada. Utiliza `--frankenphp=/absolute/path` únicamente con un ejecutable en el que confíes expresamente.

## Opciones del servidor {#options}

```sh
arix dev --port=8080 --strict-port
arix dev --path=/path/to/application
arix dev --host=0.0.0.0 --no-reload
```

`--strict-port` falla en lugar de probar otro puerto. `--path` es relativo al directorio actual o una ruta absoluta a la raíz de la aplicación. Escuchar fuera de loopback requiere `--no-reload` y expone el servidor en la interfaz elegida; hazlo únicamente en una red confiable.

## Recarga automática {#reload}

Los cambios compatibles de la aplicación provocan una recarga del navegador cuando el layout incluye el cliente de recarga de desarrollo. Desactiva este comportamiento con `--no-reload`. Reinicia el servidor después de cambiar el core o la configuración.
