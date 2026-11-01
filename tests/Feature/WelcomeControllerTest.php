<?php

declare(strict_types=1);

it('introduces Arix and links to the guide', function (): void {
    $this->get('/')
        ->assertOk()
        ->assertSee('The PHP framework for')
        ->assertSee('<title>Content-driven websites · ArixPHP</title>')
        ->assertSee('Get Started')
        ->assertSee('Pause')
        ->assertSee('Create, publish, and share');
});
