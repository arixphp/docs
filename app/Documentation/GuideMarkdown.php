<?php

declare(strict_types=1);

namespace App\Documentation;

use Arix\Markdown\DocumentReader;
use Arix\Markdown\Markdown;
use Arix\Markdown\RenderedMarkdown;

class GuideMarkdown
{
    public function __construct(
        private readonly DocumentReader $reader,
        private readonly Markdown $markdown,
    ) {}

    public function render(string $name): RenderedMarkdown
    {
        $source = $this->reader->read("guide/{$name}.md");

        return $this->markdown->render($source);
    }
}
