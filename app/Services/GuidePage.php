<?php

declare(strict_types=1);

namespace App\Services;

use Arix\Facades\Markdown;
use Arix\HttpFoundation\Request;

class GuidePage
{
    public function prepare(Request $request): array
    {
        $path = $request->getPathInfo();
        $pages = Guide::pages();
        $page = $pages[$path] ?? $pages['/guide/'];
        $groups = [];
        $previous = null;
        $next = null;
        $found = false;
        $document = Markdown::render("guide/{$page[2]}.md");
        $contents = array_filter($document->headings, static fn ($heading): bool => $heading->level === 2);

        foreach ($pages as $url => $entry) {
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

        return [
            'page' => $page,
            'groups' => $groups,
            'currentPath' => $path,
            'contents' => $contents,
            'content' => $document->html,
            'previous' => $previous,
            'next' => $next,
        ];
    }
}
