# HTTP Client

The HTTP client sends requests to remote services using the PHP cURL extension. Configuration methods return a new configured client, leaving the original unchanged.

## Making Requests {#making-requests}

```php
use Arix\Http\Client\Http;

$client = Http::create()->withTimeout(10);
$response = $client->get('https://example.com');
```

Handle connection failures and responses that are not successful in your application. Choose the destination according to your own trust policy.

```php
if ($response->successful()) {
    $body = $response->body();
}

$status = $response->status();
```

Use `json()` for a JSON response; invalid JSON raises an HTTP client exception. You may call `throw()` to raise an exception for a non-successful HTTP status.

## Security {#security}

Redirects are disabled by default. The client verifies TLS and applies timeouts and response-size limits. Without an allowlist, it rejects reserved addresses, including private and loopback addresses. An explicit host allowlist permits only the listed hosts, including their resolved addresses; allowing a host is a deliberate trust decision. Never treat a visitor-supplied URL as inherently safe.

```php
$client = Http::create()->withAllowedHosts(['api.example.com']);
```

If redirects are enabled, credentials are removed when crossing to another origin, and HTTPS-to-HTTP redirects are rejected. These protections do not make untrusted request bodies safe to forward.
