# Arix CLI {#arix-cli}

La CLI crea y mantiene aplicaciones en tu entorno de desarrollo. Ejecuta `arix new` desde el directorio donde quieras crear el proyecto; ejecuta los demás comandos desde la raíz de la aplicación.

## Desarrollo {#development}

```sh
arix new my-site
cd my-site
arix dev
```

El servidor continúa ejecutándose hasta que lo detengas. En otra terminal, desde la raíz de la aplicación, ejecuta `arix tests` para probarla o `arix format --test` para comprobar el formato.

Consulta la [guía del servidor de desarrollo](cli-development) para más información.

## Generadores {#generators}

Los generadores crean archivos de la aplicación. Consulta la [guía de generación de código](cli-generators) para conocer los comandos y sus opciones.

## Actualizaciones administradas {#updates}

La CLI actualiza el core del framework y los recursos frontend administrados. Consulta la [guía de actualizaciones administradas](cli-updates) para conocer los comandos, las previsualizaciones y las precauciones.
