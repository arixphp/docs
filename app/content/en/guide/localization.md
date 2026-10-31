# Localization

Translation catalogs live in `app/lang` as PHP arrays. Arix uses dot-separated keys to look up nested entries.

## Translation Catalogs {#catalogs}

For example, define `app/lang/en.php`:

```php
<?php

declare(strict_types=1);

return [
    'greeting' => [
        'welcome' => 'Welcome, :name!',
    ],
];
```

Retrieve the value and replace its placeholder:

```php
trans('greeting.welcome', ['name' => 'Taylor']);
```

Use nested arrays instead of literal keys containing dots. Escaping remains the responsibility of the output context; use escaped template output for text rendered as HTML.

## Locale and Fallback {#locale}

The application uses `app.default_locale` by default. The runtime does not automatically add a language prefix to routes or negotiate the language from a visitor's request; an application may choose to implement locale selection in middleware.

If a translation is missing for the current locale, the translator tries the default locale as a fallback. If neither catalog supplies a nonempty string, it returns the key itself.

The `trans` helper requires an active application container; outside that scope it throws a `LogicException`.
