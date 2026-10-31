# Markdown

Arix can read developer-owned Markdown documents from `app/content` and convert them to HTML. This directory is optional until your application reads a document.

## Reading Documents {#reading-documents}

Use `Markdown::html()` when you need an HTML string from a document. From a controller action, pass its path to the Markdown facade:

```php
use Arix\Facades\Markdown;
use Arix\Views\Contracts\View;

public function show(): View
{
    $html = Markdown::html('docs/intro.md');

    return view('document', ['content' => $html]);
}
```

The example reads `app/content/docs/intro.md`. Document paths are relative and case-sensitive, end in `.md`, and must not contain traversal. Keep the content tree free of links and writable only by trusted users; do not rely on path validation as authorization.

For other uses, `Markdown::read('docs/intro.md')` returns the Markdown source, while `Markdown::parse($source)` converts a Markdown string to HTML. The facade uses the core `DocumentReader` to read documents.

Use `Markdown::render()` when you also need headings, for example to build a table of contents:

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

The result contains `html` and an ordered `headings` list. Each heading has `level`, `id`, and `title` properties. In `app/views/document.arix.php`, for example, display level-two headings as links to the rendered HTML:

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

Unlike `html()`, `render()` adds the corresponding IDs to the HTML headings. The raw output above is appropriate only for trusted document content; heading IDs and titles use escaped template output.

To keep a link stable when a heading is renamed, declare its ID in the document:

```markdown
## Define a Route {#route}
```

Headings without an explicit ID receive a generated ID. Escape heading titles and IDs when displaying them in a template.

## Content Safety {#safety}

The Markdown parser uses safe mode, but it is not a general-purpose HTML sanitizer. Treat documents as developer-owned content and map incoming route values to a fixed list of permitted documents rather than constructing paths from visitor input.

When rendering the converted HTML, use raw template output only for content whose source and handling you trust. Ordinary escaped template output displays HTML tags as text.
