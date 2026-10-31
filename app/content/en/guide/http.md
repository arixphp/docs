# Requests and Responses

Controller actions can receive a request and return a response or a view. Route parameters are available in the request's attributes.

## Requests {#requests}

```php
use Arix\HttpFoundation\Request;
use Arix\HttpFoundation\Response;

public function show(Request $request): Response
{
    $id = $request->attributes->get('id');

    return new Response('Article: ' . htmlspecialchars((string) $id, ENT_QUOTES, 'UTF-8'));
}
```

Parameters are visitor-controlled strings. Validate them for their intended use and escape them for the context in which they are rendered. Request body capture is bounded by `app.max_body_bytes`.

The default body limit is 1 MiB; an oversized captured body produces a 413 response. Your web server or PHP may enforce a smaller limit before Arix runs. Raw body bytes are not automatically validated application data.

## Responses {#responses}

Return an `Arix\HttpFoundation\Response` when you need direct control over the response, or return a view for HTML rendering. HEAD responses and status codes that cannot carry a body are prepared appropriately by the framework.

For a JSON response, return a `JsonResponse`:

```php
use Arix\HttpFoundation\JsonResponse;

public function status(): JsonResponse
{
    return new JsonResponse(['status' => 'ok']);
}
```

Do not return secrets, raw exception details, or unvalidated visitor data merely because the response is encoded as JSON.
