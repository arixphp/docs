# Tareas programadas {#scheduling}

Arix proporciona un planificador para definir tareas recurrentes de la aplicación en un solo lugar. Un trabajo cron invoca el planificador, que comprueba qué tareas corresponden y ejecuta sus funciones. Las funciones programadas son código confiable de la aplicación.

## Definir tareas {#defining-tasks}

Registra las tareas en `app/schedules.php`. El archivo devuelve una función que recibe el planificador. Asigna un nombre único a cada tarea y proporciona el código que debe ejecutar:

```php
<?php

declare(strict_types=1);

use Arix\Scheduling\Schedule;

return static function (Schedule $schedule): void {
    $schedule->call('site:refresh', static function (): void {
        // Perform the task.
    })->hourly();
};
```

Este ejemplo declara una tarea cada hora; el comentario es un marcador, no una implementación. Añade la lógica de tu aplicación dentro de la función.

## Elegir una frecuencia {#frequency}

Elige la frecuencia de cada tarea independientemente del trabajo cron que invoca el planificador:

```php
$schedule->call('site:refresh', static function (): void {
    // Perform the task.
})->everyFiveMinutes();

$schedule->call('report:generate', static function (): void {
    // Generate the report.
})->dailyAt('09:30');
```

También están disponibles métodos como `everyMinute()`, `hourly()`, `daily()`, `weekly()` y `monthly()`. Usa `cron('15 9 * * *')` para una expresión cron personalizada de cinco campos. Al llamar a un método de frecuencia se reemplaza la expresión anterior; `at('09:30')` cambia su hora y minuto.

## Ejecutar tareas {#running-tasks}

Definir una tarea no hace que se ejecute por sí sola. Configura el servicio cron de tu proveedor de hosting para ejecutar `core/cron.php` de la aplicación con PHP. Una configuración habitual lo invoca cada minuto (`* * * * *`); el planificador comprueba entonces la frecuencia de cada tarea. Usa el ejecutable de PHP CLI proporcionado por tu proveedor, con PHP 8.4.1 o superior y la extensión mbstring.

Por ejemplo, un panel que acepta un comando completo podría usar:

```sh
/usr/bin/php /home/USERNAME/domains/example.com/public_html/core/cron.php
```

Sustituye ambas rutas por las del ejecutable de PHP y la aplicación en tu cuenta de hosting. Las rutas anteriores son ejemplos, no valores predeterminados. Si el panel ya proporciona el ejecutable de PHP o una parte de la ruta, introduce solamente lo que solicite. Selecciona cada minuto en los campos de programación, guarda el trabajo y revisa el resultado de ejecución que proporciona el proveedor. Si el proveedor impone un intervalo mínimo, respeta sus límites; una invocación menos frecuente no puede comprobar las tareas cada minuto.

No invoques `core/cron.php` mediante una URL ni lo expongas por HTTP. Mantén activas las reglas del servidor que impiden el acceso público a `core/`. El ejemplo es un comando ejecutado por el programador del hosting, no un endpoint HTTP. Arix no utiliza el comando `artisan schedule:run` de Laravel.

## Zona horaria y registros {#timezone-and-logs}

`app/config/schedule.php` controla los valores predeterminados de `schedule.timezone` y `schedule.grace`. La zona horaria predeterminada es `UTC`; utiliza una zona IANA como `America/Mexico_City` cuando corresponda. Una tarea puede sobrescribirla con `->timezone('America/Mexico_City')`. Las horas indicadas en `dailyAt()` se interpretan en la zona horaria de la tarea.

El planificador guarda su registro en `storage/logs/cron.log`. Asegúrate de que el proceso cron pueda escribir en `storage/`, incluido `storage/logs/`, y revisa tanto el registro como el resultado del panel de hosting al diagnosticar errores. El framework administra la ubicación del registro; `schedule.log` está reservado. Mantén los registros privados y no escribas secretos en ellos.
