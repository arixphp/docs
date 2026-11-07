<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ArticleManager;
use Arix\Constants\HttpStatusCode;
use Arix\Facades\Markdown;
use Arix\Http\HttpException;
use Arix\HttpFoundation\Request;
use Arix\Views\Contracts\View;

class BlogController
{
    public function __construct(private readonly ArticleManager $articles) {}

    public function index(Request $request): View
    {
        return view('blog.index', [
            'title' => trans('blog.title'),
            'description' => trans('blog.description'),
            'articles' => $this->articles->list($this->locale($request)),
        ]);
    }

    public function show(Request $request): View
    {
        $language = $this->locale($request);
        $article = $this->articles->find((string) $request->attributes->get('slug'), $language);

        if ($article === null) {
            throw new HttpException(HttpStatusCode::NOT_FOUND, trans('blog.article_not_found'));
        }

        $document = Markdown::render($article['path']);
        $contents = array_filter($document->headings, static fn ($heading): bool => $heading->level === 2);

        return view('blog.article', [
            'title' => $article['title'],
            'description' => $article['excerpt'],
            'publishedAt' => $article['publishedAt'],
            'content' => $document->html,
            'contentLanguage' => $language,
            'contents' => $contents,
        ]);
    }

    private function locale(Request $request): string
    {
        return $request->getLocale() === 'es' ? 'es' : 'en';
    }
}
