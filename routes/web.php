<?php

use App\Http\Controllers\Admin\GenerateRegisterUrl;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QueryListController;
use App\Http\Controllers\Settings\GptApiKeyController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', HomeController::class)->name('home');
    Route::get('/query-list', QueryListController::class)->name('query-list');

    /** Работа с ключами */
    Route::prefix('/settings/gpt-api-keys')->group(function () {
        Route::get('/', [GptApiKeyController::class, 'index'])->name('settings.gpt-api-keys');
        Route::put('/', [GptApiKeyController::class, 'update']);
        Route::post('/', [GptApiKeyController::class, 'create']);
    });
});

Route::middleware(['auth', 'admin'])->group(function () {

    /** Генерация URL для регистрации */
    Route::prefix('/settings/generate-register-url')->group(function () {
        Route::get('/', [GenerateRegisterUrl::class, 'index'])->name('settings.generate-register-url');
        Route::get('admin', [GenerateRegisterUrl::class, 'admin'])->name('settings.generate-register-url.admin');
        Route::get('member', [GenerateRegisterUrl::class, 'member'])->name('settings.generate-register-url.member');
    });
});

require __DIR__ . '/auth.php';
