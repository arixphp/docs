# Markdown {#markdown}

Arix puede leer documentos Markdown propiedad del desarrollador desde `app/content` y convertirlos a HTML. Este directorio es opcional hasta que la aplicación lea un documento.

## Leer documentos {#reading-documents}

Usa `Markdown::html()` cuando necesites una cadena HTML de un documento. Desde una acción de controlador, pasa su ruta a la fachada Markdown:

```php
use Arix\Facades\Markdown;
use Arix\Views\Contracts\View;

public function show(): View
{
    $html = Markdown::html('docs/intro.md');

    return view('document', ['content' => $html]);
}
```

El ejemplo lee `app/content/docs/intro.md`. Las rutas son relativas, distinguen mayúsculas, terminan en `.md` y no deben contener recorrido de directorios. Mantén el árbol de contenido libre de enlaces y permite su escritura solo a usuarios confiables; no dependas de la validación de rutas como autorización.

Para otros usos, `Markdown::read('docs/intro.md')` devuelve el contenido Markdown, mientras que `Markdown::parse($source)` convierte una cadena Markdown a HTML. La fachada utiliza el `DocumentReader` del core para leer documentos.

Usa `Markdown::render()` cuando también necesites encabezados, por ejemplo para construir un índice:

```php
use Arix\Facades\Markdown;
use Arix\Views\Contracts\View;

public function show(): View
{
    $document = Markdown::render('docs/intro.md');

    return view('document', [
        'content' => $document->html,
        'headings' => $document->headings,
    ]);
}
```

El resultado contiene `html` y una lista ordenada `headings`. Cada encabezado tiene las propiedades `level`, `id` y `title`. Por ejemplo, en `app/views/document.arix.php` muestra los encabezados de nivel dos como enlaces al HTML renderizado:

```blade
<nav aria-label="On this page">
    @foreach ($headings as $heading)
        @if ($heading->level === 2)
            <a href="#{{ $heading->id }}">{{ $heading->title }}</a>
        @endif
    @endforeach
</nav>
<article>{!! $content !!}</article>
```

A diferencia de `html()`, `render()` añade los IDs correspondientes a los encabezados HTML. La salida sin escapar anterior solo es adecuada para contenido confiable; los IDs y títulos de encabezados usan salida escapada.

Para mantener estable un enlace cuando cambia el nombre de un encabezado, declara su ID en el documento:

```markdown
## Define a Route {#route}
```

Los encabezados sin ID explícito reciben uno generado. Escapa títulos e IDs al mostrarlos en una plantilla.

## Seguridad del contenido {#safety}

El analizador Markdown usa modo seguro, pero no es un sanitizador HTML de propósito general. Trata los documentos como contenido del desarrollador y asigna los valores de ruta a una lista fija de documentos permitidos en lugar de construir rutas a partir de entradas del visitante.

Al renderizar el HTML convertido, usa salida sin escapar solo para contenido cuyo origen y tratamiento sean confiables. La salida escapada normal muestra las etiquetas HTML como texto.
