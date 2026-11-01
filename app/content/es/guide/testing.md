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

Las pruebas HTTP despachan solicitudes dentro del proceso.

La respuesta de prueba admite `assertStatus()`, `assertOk()` y `assertSee()`. El caso de prueba también proporciona métodos como `post()`, `put()`, `patch()` y `delete()` para probar otras rutas.

Para comprobar el formato sin modificar archivos, ejecuta `arix format --test`. Ni las pruebas ni el formato requieren instalar Composer en la aplicación.
