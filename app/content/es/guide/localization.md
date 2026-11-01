# Localización {#localization}

Los catálogos de traducción están en `app/lang` como arrays PHP. Arix usa claves separadas por puntos para buscar entradas anidadas.

## Catálogos de traducción {#catalogs}

Por ejemplo, define `app/lang/en.php`:

```php
<?php

declare(strict_types=1);

return [
    'greeting' => [
        'welcome' => 'Welcome, :name!',
    ],
];
```

Obtén el valor y reemplaza el marcador:

```php
trans('greeting.welcome', ['name' => 'Taylor']);
```

Utiliza arrays anidados en lugar de claves literales que contengan puntos. El escape sigue siendo responsabilidad del contexto de salida; usa salida escapada en las plantillas para texto renderizado como HTML.

## Idioma y valor alternativo {#locale}

La aplicación utiliza `app.default_locale` por defecto. El entorno no añade automáticamente un prefijo de idioma a las rutas ni negocia el idioma a partir de la solicitud; una aplicación puede implementar la selección de idioma en middleware.

Si falta una traducción para el idioma actual, el traductor busca en el idioma predeterminado. Si ningún catálogo proporciona una cadena no vacía, devuelve la propia clave.
