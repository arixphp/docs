# Scheduling

Arix provides a scheduler for defining recurring application tasks in one place. A cron job invokes the scheduler, which checks which tasks are due and runs their callbacks. Scheduled callbacks are trusted application code.

## Defining Tasks {#defining-tasks}

Register tasks in `app/schedules.php`. The file returns a closure that receives the schedule. Give each task a unique name and provide the code it should run:

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

This example declares an hourly task; the comment is a placeholder, not an implementation. Add your own application logic inside the callback.

## Choosing a Frequency {#frequency}

Choose how often each task is due independently of the cron job that invokes the scheduler:

```php
$schedule->call('site:refresh', static function (): void {
    // Perform the task.
})->everyFiveMinutes();

$schedule->call('report:generate', static function (): void {
    // Generate the report.
})->dailyAt('09:30');
```

Other available methods include `everyMinute()`, `hourly()`, `daily()`, `weekly()`, and `monthly()`. Use `cron('15 9 * * *')` for a custom five-field cron expression. Calling a frequency method replaces the previous expression; `at('09:30')` changes its hour and minute.

## Running Tasks {#running-tasks}

Defining a task does not make it run by itself. Configure your hosting provider's cron service to run the application's `core/cron.php` with PHP. A common setup invokes it every minute (`* * * * *`); the scheduler then checks each task's own frequency. Use the PHP CLI binary supplied by your provider, with PHP 8.4.1 or newer and the mbstring extension.

For example, a panel that accepts a complete command might use:

```sh
/usr/bin/php /home/USERNAME/domains/example.com/public_html/core/cron.php
```

Replace both paths with the actual PHP executable and application path on your hosting account. The paths above are examples, not defaults. If the panel already supplies the PHP executable or part of the path, enter only what that panel asks for. Select every minute in its scheduling fields, save the job, and check the provider's execution output. If the provider imposes a minimum interval, follow its limits; a less frequent invocation cannot check tasks every minute.

Do not call `core/cron.php` through a URL or expose it to HTTP. Keep the server rules that deny public access to `core/` in place. The example is a command run by the hosting scheduler, not an HTTP endpoint. Arix does not use Laravel's `artisan schedule:run` command.

## Timezone and Logs {#timezone-and-logs}

`app/config/schedule.php` controls the default `schedule.timezone` and `schedule.grace`. The default timezone is `UTC`; use an IANA timezone such as `America/Mexico_City` when appropriate. A task can override it with `->timezone('America/Mexico_City')`. Times passed to `dailyAt()` are interpreted in the task's timezone.

The scheduler writes its log to `storage/logs/cron.log`. Ensure the cron process can write to `storage/`, including `storage/logs/`, and check both the log and the hosting panel's output when diagnosing failures. The log location is framework-managed; `schedule.log` is reserved. Keep logs private and do not write secrets to them.
