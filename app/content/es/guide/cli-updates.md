# Actualizaciones administradas {#managed-updates}

La CLI mantiene el core del framework y sus recursos frontend administrados por separado del código de tu aplicación. Previsualiza los cambios y reserva una ventana de mantenimiento antes de aplicarlos.

## Previsualizar una actualización {#preview}

```sh
arix core:update --dry-run
arix css:update --dry-run
arix js:update --dry-run
```

Cada previsualización valida el candidato e informa de los cambios previstos sin reemplazar archivos de la aplicación. Las previsualizaciones del core en línea necesitan acceso a la red y espacio temporal para la descarga.

## Actualizar el core {#core}

`arix core:update` reemplaza el directorio `core/` administrado de una aplicación compatible con el paquete incluido en la CLI. No migra aplicaciones antiguas, no reescribe su bootstrap ni verifica el estado HTTP del sitio.

```sh
arix core:update --online --dry-run
arix core:update --online
```

`--online` selecciona la última versión estable de la CLI. Si falla la actualización en línea no se usa silenciosamente el paquete incluido; ejecuta de nuevo sin `--online` si deseas utilizarlo. Para una actualización no interactiva, `--yes` confirma la operación, pero no omite la validación. No existe una opción `--force` para actualizar el core.

## Actualizar recursos frontend {#frontend}

`arix css:update` administra `styles/arix/`; `arix js:update` administra `scripts/arix/`. Guarda tus archivos fuera de esos directorios. Su opción `--force` puede sobrescribir archivos administrados modificados; úsala solo después de revisar la previsualización.
