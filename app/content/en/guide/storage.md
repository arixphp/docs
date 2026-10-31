# File Storage

The `storage()` helper provides access to private application files under `storage/app`. This directory is separate from the publicly served media, fonts, styles, and scripts directories.

## Reading and Writing {#reading-writing}

```php
storage()->put('notes/welcome.txt', 'Hello from Arix');

if (storage()->has('notes/welcome.txt')) {
    $message = storage()->get('notes/welcome.txt');
}
```

`put` creates missing parent directories. Use `append` and `prepend` for an existing readable file, or `delete` to remove one. Reads and operations on missing files can throw exceptions; handle failures appropriate to your application.

## Paths and Safety {#paths}

Paths are relative to the storage root. Empty segments, `.`, `..`, absolute paths, and linked paths are rejected. Do not treat those checks as authorization: map visitor input to explicitly allowed files and keep the storage directory private.

Writes use a temporary file and rename it into place. Append and prepend read and rewrite the file; they are not a substitute for concurrent-write coordination.
