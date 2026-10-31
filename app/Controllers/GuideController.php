<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\GuidePage;
use Arix\HttpFoundation\RedirectResponse;
use Arix\HttpFoundation\Request;
use Arix\Views\Contracts\View;

class GuideController
{
    public function __construct(
        private readonly GuidePage $guidePage
    ) {}

    public function redirect(): RedirectResponse
    {
        $target = url('/guide');

        return new RedirectResponse("{$target}/");
    }

    public function show(Request $request): View
    {
        [
            'page' => $page,
            'groups' => $groups,
            'currentPath' => $path,
            'contents' => $contents,
            'content' => $content,
            'previous' => $previous,
            'next' => $next
        ] = $this->guidePage->prepare($request);

        return view('guide.show', [
            'title' => $page[0],
            'description' => 'Learn how to build with ArixPHP.',
            'page' => $page,
            'groups' => $groups,
            'currentPath' => $path,
            'contents' => $contents,
            'content' => $content,
            'previous' => $previous,
            'next' => $next,
        ]);
    }
}
