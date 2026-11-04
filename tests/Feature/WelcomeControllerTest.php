<?php

declare(strict_types=1);

it('introduces Arix and links to the guide', function (): void {
    $this->get('/')
        ->assertOk()
        ->assertSee('Build content-driven websites with')
        ->assertSee('<title>Content-driven websites · ArixPHP</title>')
        ->assertSee('Get Started')
        ->assertSee('Create, publish, and share')
        ->assertSee('Build. Publish. Keep improving.')
        ->assertSee('Markdown')
        ->assertSee('Views and components')
        ->assertSee('Localization')
        ->assertSee('Built for traditional PHP hosting')
        ->assertSee('<code>arix new my-site</code>')
        ->assertSee('<code>cd my-site</code>')
        ->assertSee('<code>arix dev</code>')
        ->assertSee('href="http://localhost/guide/first-application"')
        ->assertSee('CSS and JavaScript tools');
});

it('offers a GitHub link in the shared navigation', function (): void {
    foreach (['/', '/guide/'] as $path) {
        $this->get($path)
            ->assertOk()
            ->assertSee('href="https://github.com/arixphp" target="_blank" rel="noopener noreferrer">GitHub <svg');
    }
});

it('links to the home features section from both navigation menus', function (): void {
    foreach (['/', '/guide/'] as $path) {
        $response = $this->get($path)->assertOk();
        preg_match('~<header\b[^>]*>(.*?)</header>~s', $response->response->getContent(), $header);

        expect(substr_count($header[1] ?? '', 'href="http://localhost/#features">Features</a>'))->toBe(2);
    }

    $this->get('/')->assertSee('id="features"');
});

it('provides a mobile navigation disclosure with the site links', function (): void {
    $response = $this->get('/')->assertOk();
    preg_match('~<details class="mobile-navigation"[^>]*>(.*?)</details>~s', $response->response->getContent(), $matches);

    expect($matches[1] ?? '')
        ->toContain('<summary')
        ->toContain('Main navigation')
        ->toContain('href="http://localhost/"')
        ->toContain('href="http://localhost/guide"')
        ->toContain('href="https://github.com/arixphp"');
});

it('identifies the guide as the current mobile navigation page', function (): void {
    $response = $this->get('/guide/')->assertOk();
    preg_match('~<details class="mobile-navigation"[^>]*>(.*?)</details>~s', $response->response->getContent(), $matches);

    preg_match('~<a href="http://localhost/guide"[^>]*>~', $matches[1] ?? '', $link);

    expect($link[0] ?? '')->toContain('aria-current="page"');
});

it('offers site links in the footer', function (): void {
    foreach (['/', '/guide/'] as $path) {
        $response = $this->get($path)->assertOk();
        $html = $response->response->getContent();
        preg_match('~<footer\b[^>]*>(.*?)</footer>~s', $html, $matches);

        expect($matches[1] ?? '')
            ->toContain('href="http://localhost/"')
            ->toContain('href="http://localhost/guide"')
            ->toContain('href="https://github.com/arixphp" target="_blank" rel="noopener noreferrer"');
    }
});
