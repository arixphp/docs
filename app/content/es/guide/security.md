# Seguridad {#security}

Proteger una aplicación requiere tanto código seguro como un servidor web correctamente configurado.

## Lista para producción {#production}

- Desactiva el modo de depuración en producción.
- Verifica que tu servidor aplique las reglas de protección incluidas con Arix y protege cualquier copia de seguridad adicional. Las exclusiones de Git por sí solas no impiden el acceso HTTP.
- Configura hosts confiables antes de generar URL absolutas a partir de solicitudes.
- Mantén los directorios públicos de recursos libres de enlaces y archivos privados.
- Valida los datos de los visitantes y escápalos al renderizar HTML.

Arix incluye reglas de denegación para `.env`, sus variantes que comienzan con punto y otras rutas privadas en las configuraciones suministradas para Apache, Caddy e IIS. Asegúrate de que las reglas apropiadas para tu servidor estén activas y verifícalas mediante el servidor desplegado sin exponer contenido privado. Protege las copias de seguridad incluso cuando utilicen otro nombre, restringe los permisos de archivos y nunca registres secretos. Los directorios públicos de recursos no deben contener enlaces simbólicos; Caddy los sigue. Consulta [despliegue](deployment) para generar y verificar la política.

## Alcance del framework {#scope}

No supongas que el entorno actual proporciona autenticación, sesiones, protección CSRF, CORS ni carga de archivos. Evalúa las necesidades de tu aplicación antes de implementar funcionalidades que dependan de ellos.
