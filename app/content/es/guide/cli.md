# Arix CLI {#arix-cli}

La CLI crea y mantiene aplicaciones en tu entorno de desarrollo. Ejecuta `arix new` desde el directorio donde quieras crear el proyecto; ejecuta los demás comandos desde la raíz de la aplicación.

## Desarrollo {#development}

```sh
arix new my-site
arix dev
arix tests
arix format --test
```

## Generadores {#generators}

```sh
arix make:controller WelcomeController
arix make:middleware Example
arix make:view welcome
arix make:test Example
arix make:test Example --unit
```

Los generadores no reemplazan archivos existentes salvo que uses `--force` explícitamente.

Usa `--path=/path/to/application` para seleccionar una aplicación desde otro directorio. La opción `--unit` crea una prueba unitaria en lugar de una prueba funcional.

## Actualizaciones administradas {#updates}

```sh
arix core:update --dry-run
arix css:update --dry-run
arix js:update --dry-run
```

Usa `--dry-run` para inspeccionar los cambios antes de actualizar archivos administrados del framework. Consulta `--help` de cada comando para conocer sus opciones actuales.

Por defecto, `arix core:update` usa el paquete incluido en la CLI. Para descargar la última versión estable, utiliza `arix core:update --online`. Revisa los cambios y la compatibilidad antes de aplicar una actualización; los archivos de la aplicación no son parte del core administrado.

Para más información, consulta las guías del [servidor de desarrollo](cli-development), la [generación de código](cli-generators) y las [actualizaciones administradas](cli-updates).
