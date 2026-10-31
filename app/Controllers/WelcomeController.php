<?php

declare(strict_types=1);

namespace App\Controllers;

use Arix\Views\Contracts\View;

class WelcomeController
{
    public function index(): View
    {
        return view('index', [
            'title' => 'Build for the web',
            'description' => 'Build PHP websites with Arix and deploy them on traditional hosting.',
        ]);
    }
}
