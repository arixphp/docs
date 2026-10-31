# Assets

Stylesheets, scripts, fonts, and media live in public directories at your application root. The web server serves them directly; they do not pass through a PHP asset endpoint.

## Asset Helpers {#asset-helpers}

```php
style('app.css')
script('app.js')
font('inter.woff2', versioned: true)
media('logo.webp', versioned: true)
```

Stylesheets and scripts use content-based versions. Fonts and media can opt in to versioning. Paths are relative to the corresponding public directory.

## Managed Assets {#managed-assets}

The CLI manages `styles/arix/` and `scripts/arix/`. Put application-specific code outside those directories so updates do not overwrite it.
