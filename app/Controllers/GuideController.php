<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Documentation\Guide;
use App\Documentation\GuideMarkdown;
use Arix\HttpFoundation\RedirectResponse;
use Arix\HttpFoundation\Request;
use Arix\Views\Contracts\View;

class GuideController
{
    public function __construct(
        private readonly GuideMarkdown $markdown
    ) {}

    public function redirect(): RedirectResponse
    {
        $target = url('/guide');

        return new RedirectResponse("{$target}/");
    }

    public function show(Request $request): View
    {
        $path = $request->getPathInfo();
        $page = Guide::pages()[$path] ?? Guide::pages()['/guide/'];
        $groups = [];
        $previous = null;
        $next = null;
        $found = false;
        $document = $this->markdown->render($page[2]);
        $contents = array_filter($document->headings, static fn ($heading): bool => $heading->level === 2);

        foreach (Guide::pages() as $url => $entry) {
            $groups[$entry[1]][$url] = $entry;

            if ($found && $next === null) {
                $next = ['url' => $url, 'title' => $entry[0]];
            }

            if ($url === $path) {
                $found = true;
            } elseif (! $found) {
                $previous = ['url' => $url, 'title' => $entry[0]];
            }
        }

        return view('guide.show', [
            'title' => $page[0],
            'description' => 'Learn how to build with ArixPHP.',
            'page' => $page,
            'groups' => $groups,
            'currentPath' => $path,
            'contents' => $contents,
            'content' => $document->html,
            'previous' => $previous,
            'next' => $next,
        ]);
    }
}
