# Controllers

Controllers organize the actions that respond to your application's routes. Place them in `app/Controllers`, with filenames and namespace casing that match exactly.

## Writing Controllers {#writing-controllers}

```php
<?php

declare(strict_types=1);

namespace App\Controllers;

use Arix\Views\Contracts\View;

class WelcomeController
{
    public function index(): View
    {
        return view('welcome', ['name' => 'Arix']);
    }
}
```

Register the action in `app/routes.php`. Actions must be public instance methods with either no arguments or one required request argument, and return a response or view.

## Dependencies {#dependencies}

Controllers without required constructor parameters can be resolved directly. Register required constructor dependencies explicitly in the container; Arix does not automatically wire them. See [services](services) for a registration example.
