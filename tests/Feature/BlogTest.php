<?php

declare(strict_types=1);

use Arix\Constants\HttpStatusCode;

it('lists the Hostinger article and links to it', function (): void {
    $this->get('/blog')->assertOk()
        ->assertSee('Blog')
        ->assertSee('href="http://localhost/blog/deploy-arix-hostinger-github"')
        ->assertSee('Hostinger');
});

it('renders the Hostinger deployment article', function (): void {
    $response = $this->get('/blog/deploy-arix-hostinger-github')->assertOk()
        ->assertSee('GitHub')
        ->assertSee('Connect your GitHub account')
        ->assertSee('storage/cache');

    expect($response->response->getContent())
        ->toContain('href="#before-you-begin"')
        ->not->toContain('publishedAt:');
});

it('returns not found for an unknown article', function (): void {
    $this->get('/blog/unknown')->assertStatus(HttpStatusCode::NOT_FOUND)
        ->assertSee('Article not found.');
});
