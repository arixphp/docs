# Installation

The Arix CLI creates and maintains applications on your development machine.

## Install the CLI {#install-the-cli}

On macOS or Linux, install the CLI with Homebrew:

```sh
brew install arixphp/tap/arix
```

On Windows, use WinGet:

```sh
winget install ArixPHP.CLI
```

The packaged CLI includes PHP. The PHP requirements of your deployment server are separate from the CLI's embedded runtime.

## Create an Application {#create-an-application}

```sh
arix new example
cd example
arix dev
```

Your deployment server requires PHP 8.4.1 or newer and the mbstring extension.

The development server normally starts at `http://127.0.0.1:8181`. Open the address printed in the terminal, then follow [your first application](first-application). Press Ctrl+C to stop the server. Run `arix dev --help` to see its options.
