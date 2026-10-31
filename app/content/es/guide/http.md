# Solicitudes y respuestas {#requests-and-responses}

Las acciones del controlador pueden recibir una solicitud y devolver una respuesta o una vista. Los parámetros de ruta están disponibles en los atributos de la solicitud.

## Solicitudes {#requests}

```php
use Arix\HttpFoundation\Request;
use Arix\HttpFoundation\Response;

public function show(Request $request): Response
{
    $id = $request->attributes->get('id');

    return new Response('Article: ' . htmlspecialchars((string) $id, ENT_QUOTES, 'UTF-8'));
}
```

Los parámetros son cadenas controladas por el visitante. Valídalos para su uso previsto y escápalos según el contexto en que se rendericen. La captura del cuerpo está limitada por `app.max_body_bytes`.

El límite predeterminado es 1 MiB; un cuerpo capturado que lo supere produce una respuesta 413. El servidor web o PHP pueden imponer un límite menor antes de que se ejecute Arix. Los bytes sin procesar del cuerpo no son automáticamente datos de aplicación validados.

## Respuestas {#responses}

Devuelve un `Arix\HttpFoundation\Response` cuando necesites controlar directamente la respuesta, o una vista para renderizar HTML. El framework prepara adecuadamente las respuestas HEAD y los códigos de estado que no pueden llevar cuerpo.

Para una respuesta JSON, devuelve un `JsonResponse`:

```php
use Arix\HttpFoundation\JsonResponse;

public function status(): JsonResponse
{
    return new JsonResponse(['status' => 'ok']);
}
```

No devuelvas secretos, detalles sin procesar de excepciones ni datos no validados de visitantes solo porque la respuesta esté codificada como JSON.
