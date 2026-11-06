<?php

declare(strict_types=1);

use App\Controllers\BlogController;
use App\Controllers\GuideController;
use App\Services\ArticleManager;
use App\Services\GuidePage;
use Arix\Container\Container;

return static function (Container $container): void {
    $container->bind(ArticleManager::class, static fn (): ArticleManager => new ArticleManager(__DIR__ . DIRECTORY_SEPARATOR . 'content'));
    $container->bind(BlogController::class, static fn (Container $container): BlogController => new BlogController(
        $container->get(ArticleManager::class),
    ));
    $container->bind(GuidePage::class, static fn (): GuidePage => new GuidePage());
    $container->bind(GuideController::class, static fn (Container $container): GuideController => new GuideController(
        $container->get(GuidePage::class),
    ));
};
