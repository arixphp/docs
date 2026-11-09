---
title: Crea un portafolio PHP con Arix y un agente de IA
excerpt: Construye un portafolio PHP con blog Markdown y pruébalo sin Composer ni compilación frontend en producción.
publishedAt: 2026-11-06
---
# Crea un portafolio PHP con Arix y un agente de IA {#portfolio-with-ai}

Crea un portafolio de desarrollador con PHP y un blog Markdown, desde la instalación de la CLI hasta las pruebas. Arix genera HTML en el servidor y organiza rutas, controladores, servicios y vistas; un agente de IA te ayudará a planificar e implementar el proyecto. El resultado está pensado para hosting PHP compatible sin Composer, Node ni compilación frontend en producción.

## Qué construirás {#what-youll-build}

- `/`: presentación, habilidades y proyectos destacados.
- `/blog`: listado de artículos de ejemplo escritos en Markdown.
- `/blog/{slug}`: detalle de un artículo y respuesta 404 si no existe.
- Una interfaz adaptable y accesible, con pruebas automatizadas.

No necesitas base de datos, autenticación, panel de administración ni formulario de contacto funcional. Arix es una opción para este proyecto porque permite generar páginas con PHP y mantener los archivos necesarios para ejecutarlas en el servidor; si solo necesitas páginas que no cambian, un sitio estático también puede ser suficiente.

## Antes de empezar {#prerequisites}

Necesitas una terminal, conexión a internet y un agente de programación con modo planificación. La CLI empaquetada incluye PHP para desarrollo. Impeccable y Anatomy son opcionales: si decides instalarlos, necesitas Node y `npx` en tu computadora. Arix no requiere Composer, Node ni compilación frontend en el servidor. El alojamiento necesita PHP 8.4.1 o posterior, mbstring y un servidor compatible; consulta la [guía de despliegue](../guide/deployment).

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

## Describe el producto en el README {#product-readme}

Reemplaza el contenido inicial de `README.md` de la aplicación recién creada por el siguiente texto para que el agente conozca el producto. Esto sustituye la documentación incluida en ese archivo: guárdala primero si la necesitas. Si trabajas en un proyecto existente, conserva también tu información. Personaliza los marcadores con tus datos.

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

## Opcional: usa Impeccable para el diseño {#install-skills}

Puedes continuar sin esta herramienta. Si quieres usar [Impeccable](https://impeccable.style/tutorials/getting-started), necesitas Node.js 18.19 o posterior y `npx` en tu computadora, además de un agente compatible. Después de preparar el README, instala Impeccable desde la raíz del proyecto:

```sh
npx impeccable install
```

Selecciona tu agente y la instalación para el proyecto; después recarga tu herramienta de programación.

### Inicializa Impeccable {#initialize-impeccable}

En el chat de tu agente, ejecuta:

```text
/impeccable init
```

Impeccable lee el proyecto, pregunta por los datos que faltan y guarda el contexto acordado en `PRODUCT.md`. Responde sus preguntas y revisa ese archivo: corrige cualquier suposición y deja claras las decisiones pendientes. El README aporta contexto; no reemplaza `PRODUCT.md`. Para otro agente, consulta la sintaxis correspondiente en la [documentación de Impeccable](https://impeccable.style/docs/init). Si omites esta sección, no necesitas crear `PRODUCT.md`.

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

## Pide un plan al agente {#agent-prompt}

Activa el **modo planificación** de tu agente y pega el siguiente prompt. No requiere skills. En este paso pide un plan, no cambios de código.

```text
Quiero desarrollar el portafolio y blog descritos en README.md.
Lee README.md, las instrucciones del proyecto, rutas, controladores, vistas,
servicios y pruebas existentes. Si existe PRODUCT.md, léelo también y señala
cualquier contradicción. No supongas APIs que no estén documentadas.
Propón una dirección visual original y accesible. Si elegí Impeccable y está
disponible, úsalo para el diseño. Usa Anatomy solo si está disponible y lo apruebo;
su ilustración debe respetar movimiento reducido y entenderse sin animación.

Antes de editar archivos, presenta un plan por pasos y espera mi aprobación.
Incluye archivos afectados, arquitectura, decisiones de diseño, riesgos,
preguntas pendientes y cómo verificarlo.

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
- Guarda ejemplos en app/content/blog/ con título y fecha YYYY-MM-DD en front
  matter. Usa slugs con letras minúsculas, números y guiones. Resuelve el slug
  mediante una lista permitida, nunca como ruta directa a un archivo; responde
  404 si no existe. Escapa metadatos según su contexto y consulta la guía de
  Markdown para renderizar el HTML de los archivos del desarrollador.
- Adapta `tests/Feature/WelcomeTest.php` para comprobar la portada y completa
  `BlogTest` con pruebas del listado, un artículo existente y un slug inexistente.
  Usa las API reales de pruebas de Arix y conserva las demás pruebas existentes.
- Diseña para pantallas pequeñas, teclado, lectores de pantalla y movimiento
  reducido. Usa solo datos reales que te proporcione o ejemplos identificados.
- No implementes filtrado, despliegue, autenticación ni formularios de contacto.
```

Revisa el plan y solicita cambios si hace falta. Cuando estés conforme, apruébalo y cambia al modo de implementación de tu agente. Revisa los cambios y sustituye los ejemplos por tu contenido antes de publicar.

## Define el servicio de artículos {#article-service}

El plan debe separar la lectura de artículos del controlador mediante `App\Services\ArticleService` en `app/Services/ArticleService.php`. El servicio lista y busca los artículos; `BlogController` lo recibe por constructor y devuelve 404 si no encuentra uno. Arix no conecta automáticamente argumentos del constructor, por lo que ambas fábricas deben registrarse explícitamente en `app/services.php`.

Este ejemplo ilustra la conexión que implementará el agente; presupone un constructor sin argumentos en `ArticleService` y que `BlogController` recibe el servicio:

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

El contenedor crea el servicio cuando resuelve la fábrica del controlador. Si ya hay registros, consérvalos y añade los nuevos a la función existente. Consulta la [guía de servicios](../guide/services).

Los archivos Markdown del ejemplo son creados por el desarrollador, no por visitantes. La [guía de Markdown](../guide/markdown) explica cómo leerlos y renderizarlos: el modo seguro no es un sanitizador HTML general. Mantén una lista permitida de documentos y escapa títulos y metadatos según su contexto; no construyas rutas directamente con el slug de la solicitud.

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

Comprueba estos resultados antes de dar por terminado el proyecto:

- `/` y `/blog` responden 200; un artículo conocido muestra su título y contenido, y uno inexistente responde 404.
- Los enlaces se pueden usar con teclado y muestran el foco; en pantalla estrecha no hay desbordamiento horizontal significativo.
- El contenido se entiende con movimiento reducido y no depende de animaciones.
- `arix tests` y `arix format --test` terminan correctamente.

La CLI proporciona el ejecutor Pest y el formateador. Las pruebas HTTP de Arix se ejecutan dentro del proceso: no verifican el servidor web, las reescrituras ni sus reglas de protección. Revisa esos aspectos por separado antes de desplegar.

## Sigue explorando Arix {#next-steps}

Arix también admite traducciones mediante catálogos en `app/lang` y `trans()`; utiliza `app.default_locale` por defecto. No añade automáticamente prefijos de idioma ni negocia el idioma de la solicitud. Consulta la [guía de localización](../guide/localization) si quieres adaptar el portafolio a otros idiomas.

Como extensión opcional, [Anatomy](https://www.skills.sh/wheresryan22/anatomy/anatomy) puede ayudarte a crear una ilustración interactiva para explicar un proyecto. Para instalarla durante el desarrollo, con Node y `npx` y un agente compatible, ejecuta `npx skills add https://github.com/wheresryan22/anatomy --skill anatomy` y sigue las opciones para tu agente. No es necesaria para el portafolio.

Como retos opcionales, añade filtrado al listado del blog con pruebas para resultados y estado vacío; o publica el proyecto siguiendo la [guía de despliegue con Hostinger y GitHub](deploy-arix-hostinger-github) y la [guía de seguridad](../guide/security), comprobando las protecciones del servidor y manteniendo los secretos fuera del repositorio. Has utilizado rutas, vistas, servicios, Markdown y pruebas de Arix para crear una aplicación PHP sin dependencias de compilación en producción.
