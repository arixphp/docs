<?php

declare(strict_types=1);

it('renders the documentation preparation notice on the home page', function (): void {
    $this->get('/')
        ->assertOk()
        ->assertSee('Documentation is under construction.')
        ->assertSee('We’re preparing practical guides and references for ArixPHP. Please check back soon.')
        ->assertSee('Building the docs')
        ->assertSee('New material is on its way.');
});
