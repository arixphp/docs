# Development Server

The Arix CLI runs your application locally using a managed FrankenPHP server. It is a development tool, not a production server configuration.

## Starting the Server {#starting}

```sh
arix dev
```

Run the command from the application root, then open the address printed in the terminal. The default is `http://127.0.0.1:8181`; if that port is occupied, the CLI can try subsequent ports. Press Ctrl+C to stop the server.

On first use, the CLI downloads a pinned runtime for supported platforms and checks its SHA-256 before execution. Later starts use the verified local cache. Use `--frankenphp=/absolute/path` only for an executable you explicitly trust.

## Server Options {#options}

```sh
arix dev --port=8080 --strict-port
arix dev --path=/path/to/application
arix dev --host=0.0.0.0 --no-reload
```

`--strict-port` fails instead of falling back to another port. `--path` is relative to your current directory or an absolute application-root path. Binding beyond loopback requires `--no-reload` and exposes the server to the chosen network interface; only do this on a trusted network.

## Live Reload {#reload}

Supported application changes trigger a browser reload when the application's layout includes the development reload client. Disable this behavior with `--no-reload`. Restart the server after changing the core or configuration.
