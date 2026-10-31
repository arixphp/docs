<?php

declare(strict_types=1);

use App\Documentation\Guide;
use App\Documentation\GuideMarkdown;
use Arix\Application;
use Arix\HttpFoundation\Request;
use Arix\Markdown\DocumentReader;
use Arix\Markdown\Markdown;

it('renders the introduction and installation guides', function (): void {
    $this->get('/guide/')->assertOk()->assertSee('Introduction')->assertSee('Installation');
    $this->get('/guide/installation')->assertOk()->assertSee('Installation')->assertSee('arix');
});

it('redirects the guide root to its trailing-slash URL', function (): void {
    $response = $this->get('/guide')->assertStatus(302);

    expect($response->response->headers->get('Location'))->toBe('http://localhost/guide/');
});

it('preserves the application mount when redirecting the guide root', function (string $uri, string $target): void {
    $request = Request::create($uri, server: [
        'SCRIPT_NAME' => '/site/index.php',
        'SCRIPT_FILENAME' => '/srv/index.php',
    ]);
    $response = Application::create((string) getcwd())->kernel()->handle($request);

    expect($response->getStatusCode())->toBe(302)
        ->and($response->headers->get('Location'))->toBe($target);
})->with([
    ['/site/guide', 'http://localhost/site/guide/'],
    ['/site/index.php/guide', 'http://localhost/site/index.php/guide/'],
]);

it('renders the first guides from the Markdown catalog', function (): void {
    $directory = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR . 'guide';

    expect(is_file($directory . DIRECTORY_SEPARATOR . 'installation.md'))->toBeTrue()
        ->and(is_file($directory . DIRECTORY_SEPARATOR . 'first-application.md'))->toBeTrue();

    $this->get('/guide/installation')->assertOk()->assertSee('id="install-the-cli"');
    $this->get('/guide/first-application')->assertOk()->assertSee('id="route"')->assertSee('Hello,');
});

it('returns not found for an unknown guide', function (): void {
    $this->get('/guide/not-a-page')->assertStatus(404);
});

it('provides the major documentation sections', function (string $path, string $heading): void {
    $this->get($path)->assertOk()->assertSee($heading);
})->with([
    ['/guide/structure', 'Application Structure'],
    ['/guide/routing', 'Routing'],
    ['/guide/views', 'Views'],
    ['/guide/testing', 'Testing'],
    ['/guide/cli', 'Arix CLI'],
    ['/guide/deployment', 'Deployment'],
    ['/guide/configuration', 'Configuration'],
    ['/guide/middleware', 'Middleware'],
    ['/guide/assets', 'Assets'],
    ['/guide/services', 'Services'],
    ['/guide/localization', 'Localization'],
    ['/guide/caching', 'Caching'],
    ['/guide/security', 'Security'],
    ['/guide/scheduling', 'Scheduling'],
    ['/guide/http-client', 'HTTP Client'],
    ['/guide/controllers', 'Controllers'],
    ['/guide/http', 'Requests and Responses'],
    ['/guide/helpers', 'Helpers'],
    ['/guide/troubleshooting', 'Troubleshooting'],
    ['/guide/first-application', 'Your First Application'],
    ['/guide/storage', 'File Storage'],
    ['/guide/markdown', 'Markdown'],
    ['/guide/cli-development', 'Development Server'],
    ['/guide/cli-generators', 'Code Generation'],
    ['/guide/cli-updates', 'Managed Updates'],
]);

it('provides page contents and links to adjacent guides', function (): void {
    $this->get('/guide/installation')
        ->assertOk()
        ->assertSee('On this page')
        ->assertSee('#install-the-cli')
        ->assertSee('Introduction')
        ->assertSee('Deployment');
});

it('explains CLI update and server safety boundaries', function (): void {
    $this->get('/guide/cli-development')->assertOk()->assertSee('--strict-port')->assertSee('--no-reload');
    $this->get('/guide/cli-generators')->assertOk()->assertSee('--force')->assertSee('--unit');
    $this->get('/guide/cli-updates')->assertOk()->assertSee('--dry-run')->assertSee('does not migrate');
});

it('documents named routes and response handling', function (): void {
    $this->get('/guide/routing')
        ->assertOk()
        ->assertSee('Named Routes')
        ->assertSee("route('article.show'")
        ->assertSee('capturing groups');

    $this->get('/guide/http')
        ->assertOk()
        ->assertSee('JsonResponse')
        ->assertSee('413');
});

it('explains environment precedence and translation fallbacks', function (): void {
    $this->get('/guide/configuration')
        ->assertOk()
        ->assertSee('APP_')
        ->assertSee('getenv()')
        ->assertSee('Environment::run');

    $this->get('/guide/localization')
        ->assertOk()
        ->assertSee(':name')
        ->assertSee('fallback')
        ->assertSee('middleware');
});

it('documents middleware execution and in-process test boundaries', function (): void {
    $this->get('/guide/middleware')
        ->assertOk()
        ->assertSee('implements Middleware')
        ->assertSee('$next($request)')
        ->assertSee('-&gt;middleware');

    $this->get('/guide/testing')
        ->assertOk()
        ->assertSee('app/bootstrap.php')
        ->assertSee('in-process')
        ->assertSee('arix format --test');
});

it('does not advertise route HTML caching absent from the installed core', function (): void {
    $response = $this->get('/guide/caching')->assertOk();

    expect($response->content)->toContain('compiled templates')
        ->not->toContain('-&gt;cache()')
        ->not->toContain('Only view output is stored');
});

it('does not claim Markdown rejects every linked path', function (): void {
    $response = $this->get('/guide/markdown')->assertOk();

    expect($response->content)->not->toContain('must not contain traversal or links');
});

it('explains safe storage and developer-owned Markdown', function (): void {
    $this->get('/guide/storage')->assertOk()->assertSee('storage/app')->assertSee('storage()-&gt;put');
    $this->get('/guide/markdown')->assertOk()->assertSee('DocumentReader')->assertSee('developer-owned');
});

it('teaches a complete first application and explicit service registration', function (): void {
    $this->get('/guide/first-application')
        ->assertOk()
        ->assertSee('app/routes.php')
        ->assertSee('app/Controllers/HelloController.php')
        ->assertSee('app/views/hello.arix.php')
        ->assertSee('arix tests');

    $this->get('/guide/services')
        ->assertOk()
        ->assertSee('app/services.php')
        ->assertSee('$container-&gt;bind');
});

it('documents templates and practical CLI options', function (): void {
    $this->get('/guide/views')
        ->assertOk()
        ->assertSee('layouts.main')
        ->assertSee('@extends');

    $this->get('/guide/cli')
        ->assertOk()
        ->assertSee('make:test Example --unit')
        ->assertSee('core:update --online');
});

it('links page contents to headings that exist', function (): void {
    foreach (Guide::pages() as $path => $page) {
        $response = $this->get($path)->assertOk();

        $root = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'content';
        $document = (new GuideMarkdown(new DocumentReader($root), new Markdown()))->render($page[2]);

        foreach ($document->headings as $heading) {
            if ($heading->level !== 2) {
                continue;
            }

            $id = $heading->id;
            $response->assertSee("href=\"#{$id}\"")->assertSee("id=\"{$id}\"");
        }
    }
});

it('provides a native mobile navigation disclosure', function (): void {
    $this->get('/guide/installation')
        ->assertOk()
        ->assertSee('<details class="guide-mobile-menu">')
        ->assertSee('Browse documentation');
});

it('registers every page in the guide catalog', function (): void {
    $directory = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR . 'guide';

    foreach (Guide::pages() as $path => $page) {
        expect(is_file($directory . DIRECTORY_SEPARATOR . "{$page[2]}.md"))->toBeTrue();
        $this->get($path)->assertOk()->assertSee($page[0]);
    }
});

it('keeps relative content links compatible with mounted guides', function (string $uri): void {
    $request = Request::create($uri, server: [
        'SCRIPT_NAME' => '/site/index.php',
        'SCRIPT_FILENAME' => '/srv/index.php',
    ]);
    $response = Application::create((string) getcwd())->kernel()->handle($request);

    expect($response->getStatusCode())->toBe(200)
        ->and($response->getContent())->toContain('href="installation"')->toContain('href="routing"');
})->with([
    '/site/guide/first-application',
    '/site/index.php/guide/first-application',
]);

it('links only to registered local guide pages', function (): void {
    $catalog = Guide::pages();

    foreach ($catalog as $path => $page) {
        $html = $this->get($path)->assertOk()->content;
        preg_match_all('~href="([^"]+)"~', $html, $matches);

        foreach ($matches[1] as $href) {
            $decoded = html_entity_decode($href);
            $target = parse_url($decoded, PHP_URL_PATH);

            if (is_string($target) && str_starts_with($target, '/guide/')) {
                expect($catalog)->toHaveKey($target);
            } elseif (is_string($target) && ! str_starts_with($target, '/') && parse_url($decoded, PHP_URL_HOST) === null) {
                expect($catalog)->toHaveKey("/guide/{$target}");
            }
        }
    }
});

it('renders the selected guide and mount-safe links under a subdirectory', function (string $uri, string $guidePath): void {
    $request = Request::create($uri, server: [
        'SCRIPT_NAME' => '/site/index.php',
        'SCRIPT_FILENAME' => '/srv/index.php',
    ]);
    $response = Application::create((string) getcwd())->kernel()->handle($request);
    $html = (string) $response->getContent();

    expect($response->getStatusCode())->toBe(200)
        ->and($html)->toContain('<h1 id="installation">Installation</h1>')
        ->toContain($guidePath)
        ->toContain('/site/styles/app.css')
        ->not->toContain('/site/site/');
})->with([
    ['/site/guide/installation', '/site/guide/installation'],
    ['/site/index.php/guide/installation', '/site/index.php/guide/installation'],
]);
