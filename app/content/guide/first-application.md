# Your First Application

Let's build a small page together. After [installing Arix](installation) and creating an application, open the project directory and start the development server with `arix dev`.

## Define a Route {#route}

Add a route to `app/routes.php`. Keep the existing imports and routes, then add the controller import and route:

```php
use App\Controllers\HelloController;

Route::get('/hello', [HelloController::class, 'index']);
```

## Create a Controller {#controller}

Create `app/Controllers/HelloController.php`:

```php
<?php

declare(strict_types=1);

namespace App\Controllers;

use Arix\Views\Contracts\View;

class HelloController
{
    public function index(): View
    {
        return view('hello', ['name' => 'Arix']);
    }
}
```

## Create a View {#view}

Create `app/views/hello.arix.php`. Double braces escape the value for HTML:

```html
<!doctype html>
<html lang="en">
<head><title>Hello</title></head>
<body>
    <h1>Hello, {{ $name }}!</h1>
</body>
</html>
```

Visit `/hello` on your local development server. The route selects the controller, which returns the view with its data.

## Test Your Page {#test}

Add a test to `tests/Feature/HelloTest.php`:

```php
<?php

declare(strict_types=1);

it('shows a greeting', function (): void {
    $this->get('/hello')->assertOk()->assertSee('Hello, Arix!');
});
```

Run `arix tests` from the application root. Continue with [routing](routing) to learn about dynamic paths and HTTP methods.
