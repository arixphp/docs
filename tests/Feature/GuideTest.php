<?php

declare(strict_types=1);

use Arix\Constants\HttpStatusCode;

it('renders the introduction and installation guides', function (): void {
    $this->get('/guide/')
        ->assertOk()
        ->assertSee('Introduction')
        ->assertSee('Installation');

    $this->get('/guide/installation')
        ->assertOk()
        ->assertSee('Installation')
        ->assertSee('arix');
});

it('redirects the guide root to its trailing-slash URL', function (): void {
    $response = $this->get('/guide')
        ->assertStatus(HttpStatusCode::REDIRECT_FOUND);

    expect($response->response->headers->get('Location'))->toBe('http://localhost/guide/');
});

it('returns not found for an unknown guide', function (): void {
    $this->get('/guide/not-a-page')->assertStatus(HttpStatusCode::NOT_FOUND);
});
