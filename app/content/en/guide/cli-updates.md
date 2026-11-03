# Managed Updates

The CLI maintains the framework core and its managed frontend assets separately from your application-owned code. Preview changes and arrange a maintenance window before applying updates.

## Previewing an Update {#preview}

```sh
arix core:update --dry-run
arix css:update --dry-run
arix js:update --dry-run
```

Each preview validates the candidate and reports the intended changes without replacing application files. Online core previews still need network access and temporary download storage.

## Updating the Core {#core}

`arix core:update` replaces the managed `core/` of a compatible application using the bundle embedded in the CLI. It does not migrate a legacy application, rewrite its bootstrap, or verify the site's HTTP health.

```sh
arix core:update --online --dry-run
arix core:update --online
```

`--online` selects the latest stable CLI release. An online failure does not silently fall back to the embedded bundle; rerun without `--online` if you intend to use it. For a non-interactive update, `--yes` confirms the operation but does not bypass validation. Stop HTTP traffic before updating, refresh application caches and OPcache before reopening, and verify the site through its actual web server afterward. There is no core-update `--force` option.

## Updating Frontend Assets {#frontend}

`arix css:update` manages `styles/arix/`; `arix js:update` manages `scripts/arix/`. Put your own files outside those directories. Their `--force` option can overwrite modified managed files, so use it only after reviewing the preview.
