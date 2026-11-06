<?php

declare(strict_types=1);

namespace App\Services;

use Arix\Markdown\DocumentReader;
use Arix\Markdown\Markdown;
use RuntimeException;

use function in_array;
use function is_array;
use function is_string;

class ArticleManager
{
    public function __construct(private readonly string $contentPath) {}

    public function list(string $locale): array
    {
        if (! in_array($locale, ['en', 'es'], true)) {
            return [];
        }

        $directory = $this->directory($locale);

        if (is_link($directory) || is_link(dirname($directory)) || ! is_dir($directory)) {
            return [];
        }

        $articles = [];

        foreach (scandir($directory) ?: [] as $filename) {
            if (! preg_match('/\A([a-z0-9]+(?:-[a-z0-9]+)*)\.md\z/D', $filename, $matches)) {
                continue;
            }

            $path = $directory . DIRECTORY_SEPARATOR . $filename;

            if (is_link($path) || ! is_file($path)) {
                continue;
            }

            $articles[] = $this->read($locale, $matches[1]);
        }

        usort($articles, static fn (array $a, array $b): int => strcmp($b['publishedAt'], $a['publishedAt']) ?: strcmp($a['slug'], $b['slug']));

        return $articles;
    }

    public function find(string $slug, string $locale): array|null
    {
        if (! preg_match('/\A[a-z0-9]+(?:-[a-z0-9]+)*\z/D', $slug) || ! in_array($locale, ['en', 'es'], true)) {
            return null;
        }

        foreach ($this->list($locale) as $article) {
            if ($article['slug'] === $slug) {
                return $article;
            }
        }

        return null;
    }

    private function directory(string $locale): string
    {
        return $this->contentPath . DIRECTORY_SEPARATOR . $locale . DIRECTORY_SEPARATOR . 'blog';
    }

    private function read(string $locale, string $slug): array
    {
        $path = "{$locale}/blog/{$slug}.md";
        $markdown = new Markdown(new DocumentReader($this->contentPath));
        $metadata = $markdown->render($path)->frontmatter;

        if (! $this->metadataIsValid($metadata)) {
            throw new RuntimeException("Invalid article metadata: {$slug}");
        }

        return [
            'slug' => $slug,
            'title' => $metadata['title'],
            'excerpt' => $metadata['excerpt'],
            'publishedAt' => $metadata['publishedAt'],
            'path' => $path,
        ];
    }

    private function metadataIsValid(array|null $metadata): bool
    {
        return is_array($metadata)
            && is_string($metadata['title'] ?? null) && trim($metadata['title']) !== ''
            && is_string($metadata['excerpt'] ?? null) && trim($metadata['excerpt']) !== ''
            && is_string($metadata['publishedAt'] ?? null)
            && preg_match('/\A(\d{4})-(\d{2})-(\d{2})\z/D', $metadata['publishedAt'], $date) === 1
            && checkdate((int) $date[2], (int) $date[3], (int) $date[1]);
    }
}
