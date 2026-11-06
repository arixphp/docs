---
title: Despliega Arix en Hostinger con GitHub
excerpt: Conecta tu repositorio y publica cambios automáticamente con Hostinger y GitHub.
publishedAt: 2026-11-04
---
# Despliega Arix en Hostinger con GitHub {#deploy-arix-hostinger-github}

Publica una aplicación Arix en Hostinger conectando tu cuenta de GitHub y seleccionando tu repositorio. Esta guía sigue la conexión directa con GitHub; los nombres y la disponibilidad del panel pueden cambiar, así que consulta la [guía de Git de Hostinger](https://www.hostinger.com/es/support/1583302-como-implementar-un-repositorio-git-en-hostinger/) para conocer otras opciones de despliegue.

## Antes de empezar {#before-you-begin}

Necesitas una aplicación Arix en tu computadora, un repositorio de GitHub con los archivos necesarios para ejecutarla y un plan de Hostinger con Git y un dominio configurado. La aplicación debe incluir su `core/` administrado y sus recursos públicos. Comprueba que el alojamiento admita PHP 8.4.1 o posterior, la extensión mbstring y una integración de servidor web compatible. Selecciona una versión compatible de PHP en hPanel.

Ejecuta `arix tests` localmente antes de publicar. Arix no necesita Composer, Node ni compilación frontend en el servidor. Haz commit y envía la aplicación a la rama que vas a desplegar. Nunca subas `.env`, credenciales ni otros secretos; utiliza un repositorio privado si el código fuente no debe ser público.

## Prepara producción {#prepare-production}

Establece `APP_DEBUG=false` en producción y configura los hosts confiables para el dominio público. Si utilizas un archivo `.env`, créalo por separado en el servidor, restringe sus permisos y mantenlo fuera de Git. Asegúrate de que `storage/cache` permita escritura para las plantillas compiladas; las tareas programadas también pueden necesitar acceso de escritura a `storage/logs`.

Revisa la [guía de despliegue](../guide/deployment) y la [guía de seguridad](../guide/security). El servidor web debe aplicar las reglas de reescritura y protección de archivos privados de la aplicación, incluidas las variantes de `.env`, `.git`, la configuración y otros archivos no públicos. La política generada para Apache requiere una configuración compatible; no supongas que un despliegue Git correcto implica que esas protecciones están activas. Ejecuta `arix assets:policy apache` localmente para revisar la política y confirmar que el alojamiento puede aplicarla.

## Conecta el repositorio {#connect-repository}

En hPanel, abre **Hosting**, selecciona **Administrar** en tu sitio y busca la opción para conectar GitHub. Conecta tu cuenta de GitHub y, cuando GitHub lo solicite, autoriza a Hostinger a acceder a los repositorios que quieras desplegar. Revisa los permisos solicitados y limita el acceso cuando sea posible. Selecciona tu repositorio de Arix, la rama y el directorio de instalación si se te solicita.

Comprueba la raíz real del dominio y selecciona el destino correcto. El despliegue Git manual de Hostinger requiere un destino vacío; consulta las instrucciones que aparezcan para la conexión elegida antes de continuar. Haz una copia de seguridad del sitio existente y no elimines sus archivos sin confirmar las consecuencias. Si la conexión directa con GitHub no está disponible, consulta la [guía de Git de Hostinger](https://www.hostinger.com/es/support/1583302-como-implementar-un-repositorio-git-en-hostinger/) para conocer la alternativa manual.

Completa la configuración en hPanel y despliega el repositorio seleccionado. Revisa la salida de Hostinger para detectar errores. Si el destino debía estar vacío, crea el `.env` de producción después del despliegue inicial y verifica que los despliegues posteriores lo conserven, al igual que los datos de ejecución, antes de depender de las actualizaciones automáticas.

## Activa el despliegue automático {#automatic-deployment}

Con la conexión directa con GitHub no necesitas configurar manualmente un webhook ni una clave SSH como parte de la vinculación de la cuenta. Confirma la configuración de despliegue que muestra hPanel y si el despliegue automático está activado para la rama seleccionada; las opciones disponibles pueden variar.

Envía un cambio pequeño y no sensible a la rama seleccionada. Revisa el estado y la salida del despliegue en Hostinger; después comprueba el cambio en el sitio publicado. Un push a otra rama no actualiza la rama seleccionada. Si falla el despliegue, revisa la rama elegida, la conexión con GitHub y los permisos del repositorio, además de la salida de Hostinger.

## Comprueba el sitio publicado {#verify}

Abre el sitio y varias rutas, y comprueba el CSS, JavaScript y demás recursos. Verifica HTTPS y que la información de depuración esté desactivada. Comprueba que se deniegue el acceso a `.env` y sus variantes, `.git`, la configuración y otros archivos privados sin revelar su contenido. Confirma que `storage/cache` permita escritura y que el archivo de entorno y los datos de ejecución permanezcan intactos tras un despliegue posterior.

Si un archivo no debe desplegarse o exponerse, mantenlo fuera del repositorio de despliegue o asegúrate de que el servidor lo bloquee. Ignorarlo en Git no es protección HTTP. Consulta la [guía de seguridad de Arix](../guide/security) y verifica el comportamiento real del servidor; contacta con Hostinger si su configuración no puede aplicar las reglas necesarias.
