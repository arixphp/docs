# Vistas {#views}

Las vistas separan el HTML de la lógica del controlador. Guárdalas en `app/views` y devuélvelas con el helper `view`.

## Crear vistas {#creating-views}

```php
public function index(): View
{
    return view('welcome', ['name' => 'Arix']);
}
```

Una vista llamada `welcome` se resuelve a `app/views/welcome.arix.php` o `app/views/welcome.php`. No crees ambas con el mismo nombre.

## Plantillas {#templates}

Las plantillas compiladas usan la extensión `.arix.php`. El framework las guarda en `storage/cache`, donde la aplicación debe tener permisos de escritura.

Por ejemplo, define un layout compartido en `app/views/layouts/main.arix.php`:

```html
<!doctype html>
<html lang="en">
<body>
    <main>@yield('content')</main>
</body>
</html>
```

Una plantilla hija puede extender `layouts.main` y proporcionar una sección. Las llaves dobles escapan la salida para HTML:

```text
@extends('layouts.main')

@section('content')
    <h1>Hello, {{ $name }}!</h1>
@endsection
```

Usa salida sin escapar únicamente para HTML confiable. Los nombres con puntos seleccionan vistas anidadas y `@include` puede renderizar un parcial compartido. También hay vistas `.php` nativas si prefieres plantillas PHP.
