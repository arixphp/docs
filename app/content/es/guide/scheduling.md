# Tareas programadas {#scheduling}

Arix proporciona un planificador para definir tareas recurrentes de la aplicación en un solo lugar. Las funciones programadas son código confiable de la aplicación.

## Definir tareas {#defining-tasks}

Registra las tareas en `app/schedules.php`. El archivo devuelve una función que recibe el planificador:

```php
<?php

declare(strict_types=1);

use Arix\Scheduling\Schedule;

return static function (Schedule $schedule): void {
    $schedule->call('cache:prune', static function (): void {
        // Perform the task.
    })->hourly();
};
```

## Ejecutar tareas {#running-tasks}

Definir una tarea no hace que se ejecute por sí sola. El despliegue necesita una integración confiable que invoque el planificador de la aplicación. Revisa la integración disponible antes de configurar un trabajo cron; no expongas un endpoint del planificador al público.

El registro del planificador se guarda en `storage/logs/cron.log`. El framework administra su ubicación; `schedule.log` está reservado.
