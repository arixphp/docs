<?php

declare(strict_types=1);

use App\Controllers\GuideController;
use App\Documentation\GuideMarkdown;
use Arix\Container\Container;
use Arix\Markdown\DocumentReader;
use Arix\Markdown\Markdown;

return static function (Container $container): void {
    $container->bind(GuideMarkdown::class, static fn (Container $container): GuideMarkdown => new GuideMarkdown(
        $container->get(DocumentReader::class),
        $container->get(Markdown::class),
    ));
    $container->bind(GuideController::class, static fn (Container $container): GuideController => new GuideController(
        $container->get(GuideMarkdown::class),
    ));
};
