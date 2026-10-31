# Pruebas {#testing}

La CLI de Arix proporciona el ejecutor de pruebas. Las pruebas de tu aplicación están en `tests/` y usan sintaxis Pest; no necesitas instalar dependencias de Composer en la aplicación.

## Ejecutar pruebas {#running-tests}

```sh
arix tests
```

## Pruebas HTTP {#http-tests}

```php
it('shows the home page', function (): void {
    $this->get('/')->assertOk()->assertSee('Welcome');
});
```

Las pruebas HTTP despachan solicitudes dentro del proceso. Mantén las pruebas del framework en el proyecto CLI y las pruebas específicas de la aplicación en tu aplicación.

La respuesta de prueba admite `assertStatus()`, `assertOk()` y `assertSee()`. El caso de prueba también proporciona métodos como `post()`, `put()`, `patch()` y `delete()` para probar otras rutas.

## Límites del entorno {#runtime-boundaries}

El helper de pruebas en proceso predeterminado crea una aplicación y un kernel directamente; no ejecuta `app/bootstrap.php` ni carga automáticamente el ámbito `.env` del entorno HTTP. Por tanto, una prueba satisfactoria con ese helper no demuestra por sí sola que funcionen el middleware global registrado en el bootstrap o la configuración del servidor web.

Prueba el middleware con un kernel configurado explícitamente cuando corresponda y verifica el comportamiento específico del servidor en un servidor web compatible. Si un bootstrap directo de la aplicación necesita `.env`, envuelve la operación completa en `Arix\Runtime\Environment::run()`.

Para comprobar el formato sin modificar archivos, ejecuta `arix format --test`. Ni las pruebas ni el formato requieren instalar Composer en la aplicación.
