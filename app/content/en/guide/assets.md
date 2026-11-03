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

Public directories are subject to the installed static asset policy, which permits specific file extensions; placing a file there does not guarantee the server will serve it. For example, the current policy excludes SVG. Consult `core/Assets/public-policy.json` for the installed policy and [deployment](deployment) for server-specific verification. Public asset directories must not contain symbolic links or private files.

## Managed Assets {#managed-assets}

The CLI manages `styles/arix/` and `scripts/arix/`. Put application-specific code outside those directories so updates do not overwrite it.
