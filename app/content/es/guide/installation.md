# Instalación {#installation}

La CLI de Arix crea y mantiene aplicaciones en tu entorno de desarrollo.

## Instalar la CLI {#install-the-cli}

En macOS o Linux, instala la CLI con Homebrew:

```sh
brew install arixphp/tap/arix
```

En Windows, utiliza WinGet:

```sh
winget install ArixPHP.CLI
```

La CLI empaquetada incluye PHP. Los requisitos de PHP del servidor de despliegue son independientes del entorno incluido en la CLI.

## Crear una aplicación {#create-an-application}

```sh
arix new example
cd example
arix dev
```

El servidor de despliegue requiere PHP 8.4.1 o posterior y la extensión mbstring.

Normalmente, el servidor de desarrollo se inicia en `http://127.0.0.1:8181`. Abre la dirección que aparece en la terminal y continúa con [tu primera aplicación](first-application). Pulsa Ctrl+C para detener el servidor. Ejecuta `arix dev --help` para consultar sus opciones.
