# Arix CLI

The CLI creates and maintains applications from your development machine. Run `arix new` from the directory where you want the project created; run the other commands below from the application root.

## Development {#development}

```sh
arix new my-site
arix dev
arix tests
arix format --test
```

## Generators {#generators}

```sh
arix make:controller WelcomeController
arix make:middleware Example
arix make:view welcome
arix make:test Example
arix make:test Example --unit
```

Generators do not replace existing files unless you explicitly use `--force`.

Use `--path=/path/to/application` to target an application from another directory. The `--unit` option creates a unit test rather than a feature test.

## Managed Updates {#updates}

```sh
arix core:update --dry-run
arix css:update --dry-run
arix js:update --dry-run
```

Use `--dry-run` to inspect changes before updating managed framework files. Consult each command's `--help` for its current options.

`arix core:update` uses the CLI's embedded bundle by default. To fetch the latest stable release instead, use `arix core:update --online`. Review the changes and compatibility before applying an update; application-owned files are not the managed core.

For details, see the guides to the [development server](cli-development), [code generation](cli-generators), and [managed updates](cli-updates).
