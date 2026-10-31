<?php

declare(strict_types=1);

use App\Controllers\GuideController;
use App\Controllers\WelcomeController;
use App\Services\Guide;
use Arix\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/guide', [GuideController::class, 'index']);

foreach (Guide::pages() as $path => $page) {
    Route::get($path, [GuideController::class, 'show']);
}
