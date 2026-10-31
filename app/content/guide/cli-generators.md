# Code Generation

Generators create application-owned files with the structure expected by Arix. Run them from your application root.

## Available Generators {#generators}

```sh
arix make:controller ArticleController
arix make:middleware ExampleMiddleware
arix make:view articles.index
arix make:test ArticleTest
arix make:test ArticleUnitTest --unit
```

Controllers, middleware, views, and Pest tests are starting points: add your own behavior and explicitly register routes or middleware where required. `--unit` selects the unit test directory.

## Targets and Existing Files {#targets}

Pass `--path=/path/to/application` when running from another directory. Existing files are not replaced unless you explicitly pass `--force`; inspect the target before doing so. Use a command's `--help` for its accepted arguments.
