# Seguridad {#security}

Proteger una aplicación requiere tanto código seguro como un servidor web correctamente configurado.

## Lista para producción {#production}

- Desactiva el modo de depuración en producción.
- Deniega el acceso HTTP a `.env`, sus copias, el código privado, la configuración y los archivos de pruebas.
- Configura hosts confiables antes de generar URL absolutas a partir de solicitudes.
- Mantén los directorios públicos de recursos libres de enlaces y archivos privados.
- Valida los datos de los visitantes y escápalos al renderizar HTML.

## Alcance del framework {#scope}

No supongas que el entorno actual proporciona autenticación, sesiones, protección CSRF, CORS ni carga de archivos. Evalúa las necesidades de tu aplicación antes de implementar funcionalidades que dependan de ellos.
