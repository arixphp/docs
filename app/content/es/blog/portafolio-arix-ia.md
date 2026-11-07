---
title: Crea un portafolio con Arix y un agente de IA
excerpt: Construye un portafolio con blog desde cero con Arix, Impeccable y desarrollo guiado por IA.
publishedAt: 2026-11-06
---
# Crea un portafolio con Arix y un agente de IA {#portfolio-with-ai}

Crea un portafolio de desarrollador con un blog, desde la instalación de la CLI hasta las pruebas. Prepara el contexto y los archivos iniciales; después pide a un agente de IA que proponga un plan antes de implementar. Usa Impeccable para orientar el diseño y, opcionalmente, Anatomy para una ilustración interactiva que explique uno de tus proyectos.

## Antes de empezar {#prerequisites}

Necesitas una terminal, conexión a internet, un agente de programación compatible con skills y Node.js 18.19 o posterior con `npx` en tu computadora. Node se utiliza aquí para instalar las herramientas de IA, no es un requisito de la aplicación en producción. Arix no requiere Composer, Node ni compilación frontend en el servidor. El alojamiento necesita PHP 8.4.1 o posterior, mbstring y un servidor compatible; consulta la [guía de despliegue](../guide/deployment).

## Instala Arix y crea la aplicación {#install-arix}

En macOS o Linux, con Homebrew:

```sh
brew install arixphp/tap/arix
```

En Windows, con WinGet:

```sh
winget install ArixPHP.CLI
```

La CLI empaquetada incluye PHP para el desarrollo. Crea la aplicación y entra en su directorio:

```sh
arix new portfolio
cd portfolio
```

Ejecuta los siguientes comandos desde esa raíz. Consulta la [guía de instalación](../guide/installation) si necesitas más detalles.

## Instala las skills {#install-skills}

Instala Impeccable y elige tu agente y la instalación para este proyecto cuando se te pregunte:

```sh
npx impeccable install
```

Instala Anatomy para tener disponible la ilustración opcional:

```sh
npx skills add https://github.com/wheresryan22/anatomy --skill anatomy
```

Sigue las opciones del instalador para tu agente y recarga tu herramienta de programación. Los nombres de comandos y la compatibilidad dependen del agente: consulta las instrucciones actuales de [Impeccable](https://impeccable.style/tutorials/getting-started) y [Anatomy](https://www.skills.sh/wheresryan22/anatomy/anatomy) si no aparecen las skills. Instala únicamente herramientas en las que confíes.

## Describe el producto en el README {#product-readme}

Antes de inicializar Impeccable, reemplaza el contenido de `README.md` de la aplicación recién creada por el siguiente texto. Si trabajas en un proyecto existente, conserva primero cualquier información que necesites. Personaliza los marcadores con tus datos.

```markdown
# Portafolio de desarrollador

## Propósito y público
Presentar mi trabajo a posibles clientes, colaboradores y empleadores. Las visitas
deben poder entender qué hago, explorar proyectos y artículos y encontrar cómo
contactarme rápidamente, también desde el móvil.

## Contenido
- Inicio: presentación breve, especialidades y proyectos destacados.
- Proyectos: contexto, solución y tecnologías; usar ejemplos claramente ficticios
  hasta que proporcione proyectos reales.
- Blog: listado y detalle de artículos de ejemplo sobre desarrollo de software.
- Contacto: enlaces de contacto que yo proporcione, sin formulario funcional.

## Requisitos
- Diseño original, legible, adaptable y accesible con teclado y lector de pantalla.
- Respetar la preferencia de movimiento reducido; cualquier ilustración es opcional.
- Usar Arix y sus convenciones, sin base de datos, autenticación ni panel de edición.
- Guardar los artículos como archivos Markdown creados por el desarrollador.
- No requerir Composer, Node ni una compilación frontend en el servidor.

## Datos por completar
- Nombre y presentación: [añadir mis datos]
- Proyectos y enlaces: [añadir proyectos reales]
- Correo y redes: [añadir enlaces reales]
```

## Inicializa Impeccable {#initialize-impeccable}

En el chat de tu agente, ejecuta:

```text
/impeccable init
```

Impeccable lee el proyecto, pregunta por los datos que faltan y guarda el contexto acordado en `PRODUCT.md`. Responde sus preguntas y revisa ese archivo: corrige cualquier suposición y deja claras las decisiones pendientes. El README aporta contexto; no reemplaza `PRODUCT.md`. Para otro agente, consulta la sintaxis correspondiente en la [documentación de Impeccable](https://impeccable.style/docs/init).

## Prepara controladores, vistas y pruebas {#generate-files}

La aplicación ya incluye `WelcomeController` y una vista de bienvenida: reutilízalos para el portafolio. No los generes de nuevo ni los sobrescribas. Crea el controlador del blog:

```sh
arix make:controller BlogController
```

Ahora crea las vistas para el listado y el detalle:

```sh
arix make:view blog.index
arix make:view blog.show
```

Por último, crea la prueba funcional del blog. La aplicación ya incluye `tests/Feature/WelcomeTest.php`: reutilízala y adáptala a la nueva portada.

```sh
arix make:test BlogTest
```

Estos archivos son puntos de partida: todavía no implementan el blog ni registran rutas. Los generadores no reemplazan archivos existentes por defecto; si un nombre ya existe, inspecciónalo y reutilízalo o elige otro. El agente completará el comportamiento y registrará las rutas explícitamente en `app/routes.php`.

## Define el servicio de artículos {#article-service}

Para separar la lectura de artículos del controlador, pide al agente que cree `App\Services\ArticleService` en `app/Services/ArticleService.php`. Su responsabilidad será listar los artículos Markdown que crees y buscar uno por su slug. El controlador recibirá el servicio por constructor y lo utilizará para preparar las vistas; si no encuentra un artículo, responderá con 404.

Arix no conecta automáticamente los argumentos del constructor. Para inyectar el servicio, registra una fábrica para cada clase en `app/services.php`. Este ejemplo muestra la conexión que el agente implementará; presupone que `ArticleService` tiene un constructor sin argumentos y que `BlogController` recibe el servicio:

```php
<?php

declare(strict_types=1);

use App\Controllers\BlogController;
use App\Services\ArticleService;
use Arix\Container\Container;

return static function (Container $container): void {
    $container->bind(ArticleService::class, static fn (): ArticleService => new ArticleService());
    $container->bind(BlogController::class, static fn (Container $container): BlogController =>
        new BlogController($container->get(ArticleService::class))
    );
};
```

El contenedor crea el servicio al resolver la fábrica del controlador y lo pasa a su constructor. Si `app/services.php` ya contiene registros, consérvalos y añade estos a la función existente. El siguiente prompt pide al agente crear las clases y completar esta conexión después de que apruebes el plan. Consulta la [guía de servicios](../guide/services) para conocer más opciones de registro.

## Pide un plan al agente {#agent-prompt}

Activa el **modo planificación** de tu agente y pega el siguiente prompt. Ajusta los marcadores y, si no quieres la ilustración, indícalo. En este paso pide un plan, no cambios de código.

```text
Quiero desarrollar el portafolio y blog descritos en README.md.
Lee README.md, PRODUCT.md, las instrucciones del proyecto y el código existente.
Usa Impeccable para proponer una dirección visual original y accesible. Si aporta
valor y lo apruebo, usa Anatomy para una ilustración interactiva opcional que
explique uno de los proyectos; debe respetar la preferencia de movimiento reducido
y seguir siendo comprensible sin animación.

Antes de editar archivos, presenta un plan por pasos y espera mi aprobación.
Incluye archivos afectados, decisiones de diseño, riesgos y cómo verificarlo.

Para la implementación posterior:
- Respeta la arquitectura y las instrucciones de Arix. No modifiques core/ ni
  agregues dependencias o pasos de compilación necesarios en el servidor.
- Reutiliza WelcomeController y la vista de bienvenida para la página principal.
- Completa BlogController, las vistas blog.index y blog.show y las rutas explícitas
  para /blog y /blog/{slug}. Conserva el resto de rutas existentes.
- Crea ArticleService para listar y buscar artículos de ejemplo en archivos
  Markdown creados por el desarrollador, sin base de datos ni publicación por
  visitantes. Inyéctalo por constructor en BlogController y registra las fábricas
  de ambas clases en app/services.php, conservando los registros existentes.
- Resuelve el slug mediante una lista permitida, nunca como ruta directa a un
  archivo; responde 404 si no existe. Escapa los datos al mostrarlos y consulta
  la guía de Markdown para renderizar los artículos.
- Adapta `tests/Feature/WelcomeTest.php` para comprobar la portada y completa
  `BlogTest` con pruebas del listado, un artículo existente y un slug inexistente.
  Usa las API reales de pruebas de Arix y conserva las demás pruebas existentes.
- Diseña para pantallas pequeñas, teclado, lectores de pantalla y movimiento
  reducido. Usa solo datos reales que te proporcione o ejemplos identificados.
- No implementes filtrado, despliegue, autenticación ni formularios de contacto.
```

Revisa el plan y solicita cambios si hace falta. Cuando estés conforme, apruébalo y cambia al modo de implementación de tu agente. Revisa los cambios y sustituye los ejemplos por tu contenido antes de publicar.

## Ejecuta la aplicación y las pruebas {#run-and-test}

Inicia el servidor desde la raíz del proyecto:

```sh
arix dev
```

Abre la dirección mostrada en la terminal, normalmente `http://127.0.0.1:8181`. Comprueba la portada, el blog, un artículo y una URL inexistente; prueba también el teclado y una pantalla pequeña. Detén el servidor con Ctrl+C. En otra terminal, desde la raíz, ejecuta:

```sh
arix tests
arix format --test
```

La CLI proporciona el ejecutor Pest y el formateador. Las pruebas HTTP de Arix se ejecutan dentro del proceso: no verifican el servidor web, las reescrituras ni sus reglas de protección. Revisa esos aspectos por separado antes de desplegar.

## Sigue explorando Arix {#next-steps}

Arix también admite traducciones mediante catálogos en `app/lang` y `trans()`; utiliza `app.default_locale` por defecto. No añade automáticamente prefijos de idioma ni negocia el idioma de la solicitud. Consulta la [guía de localización](../guide/localization) si quieres adaptar el portafolio a otros idiomas.

Como retos opcionales, añade filtrado al listado del blog con pruebas para resultados y estado vacío; o publica el proyecto siguiendo la [guía de despliegue con Hostinger y GitHub](deploy-arix-hostinger-github), comprobando las protecciones del servidor y manteniendo los secretos fuera del repositorio.
