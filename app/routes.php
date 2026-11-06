<?php

declare(strict_types=1);

use App\Controllers\BlogController;
use App\Controllers\GuideController;
use App\Controllers\WelcomeController;
use App\Services\Guide;
use Arix\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/guide', [GuideController::class, 'index']);
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{slug}', [BlogController::class, 'show']);

foreach (Guide::pages() as $path => $page) {
    Route::get($path, [GuideController::class, 'show']);
}
