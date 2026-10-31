# Views

Views keep your HTML separate from your controller logic. Store them in `app/views` and return them using the `view` helper.

## Creating Views {#creating-views}

```php
public function index(): View
{
    return view('welcome', ['name' => 'Arix']);
}
```

A view named `welcome` resolves to either `app/views/welcome.arix.php` or `app/views/welcome.php`. Do not create both with the same name.

## Templates {#templates}

Compiled templates use the `.arix.php` extension. The framework stores compiled templates in `storage/cache`, which must be writable by the application.

For example, define a shared layout at `app/views/layouts/main.arix.php`:

```html
<!doctype html>
<html lang="en">
<body>
    <main>@yield('content')</main>
</body>
</html>
```

A child template can extend `layouts.main` and supply a section. Double braces escape output for HTML:

```text
@extends('layouts.main')

@section('content')
    <h1>Hello, {{ $name }}!</h1>
@endsection
```

Use raw output only for HTML you trust. Dotted names select nested views, and `@include` can render a shared partial. Native `.php` views are also available when you prefer PHP templates.
