# Cliente HTTP {#http-client}

El cliente HTTP envía solicitudes a servicios remotos mediante la extensión cURL de PHP. Los métodos de configuración devuelven un nuevo cliente configurado sin modificar el original.

## Realizar solicitudes {#making-requests}

```php
use Arix\Http\Client\Http;

$client = Http::create()->withTimeout(10);
$response = $client->get('https://example.com');
```

Gestiona en tu aplicación los fallos de conexión y las respuestas que no sean satisfactorias. Elige el destino según tu propia política de confianza.

```php
if ($response->successful()) {
    $body = $response->body();
}

$status = $response->status();
```

Usa `json()` para una respuesta JSON; un JSON no válido genera una excepción del cliente HTTP. Puedes llamar a `throw()` para generar una excepción ante un estado HTTP no satisfactorio.

## Seguridad {#security}

Las redirecciones están desactivadas por defecto. El cliente verifica TLS, aplica límites de tiempo y tamaño de respuesta, y restringe las conexiones a direcciones pertenecientes al despliegue salvo que se permita un host explícitamente. Nunca consideres intrínsecamente segura una URL proporcionada por un visitante.

Si se habilitan las redirecciones, se eliminan las credenciales al pasar a otro origen y se rechazan las redirecciones de HTTPS a HTTP. Estas protecciones no hacen seguro reenviar cuerpos de solicitud no confiables.
