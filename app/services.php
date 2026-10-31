<?php

declare(strict_types=1);

use App\Controllers\GuideController;
use App\Services\GuidePage;
use Arix\Container\Container;

return static function (Container $container): void {
    $container->bind(GuidePage::class, static fn (): GuidePage => new GuidePage());
    $container->bind(GuideController::class, static fn (Container $container): GuideController => new GuideController(
        $container->get(GuidePage::class),
    ));
};
