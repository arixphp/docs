<?php

declare(strict_types=1);

it('introduces Arix and links to the guide', function (): void {
    $this->get('/')
        ->assertOk()
        ->assertSee('Build for the web')
        ->assertSee('<title>Build for the web · ArixPHP</title>')
        ->assertSee('Get Started')
        ->assertSee('arix new');
});
