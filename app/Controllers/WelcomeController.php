<?php

declare(strict_types=1);

namespace App\Controllers;

use Arix\Views\Contracts\View;

class WelcomeController
{
    public function index(): View
    {
        return view('index', [
            'title' => trans('home.page_title'),
            'description' => trans('home.page_description'),
        ]);
    }
}
