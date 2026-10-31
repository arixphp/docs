# Scheduling

Arix provides a scheduler for defining recurring application tasks in one place. Scheduled callbacks are trusted application code.

## Defining Tasks {#defining-tasks}

Register tasks in `app/schedules.php`. The file returns a closure that receives the schedule:

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

## Running Tasks {#running-tasks}

Defining a task does not by itself arrange for it to run. Your deployment needs a trusted scheduler integration that invokes the application scheduler. Review the integration available for your application before setting up a cron job; do not expose a scheduler endpoint to the public.

The scheduler's log is stored in `storage/logs/cron.log`. Its location is framework-managed; `schedule.log` is reserved.
