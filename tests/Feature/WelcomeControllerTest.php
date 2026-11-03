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
