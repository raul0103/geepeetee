<?php

use App\Http\Controllers\Admin\GenerateRegisterUrl;
use App\Http\Controllers\Parser\ParserImportController;
use App\Http\Controllers\Parser\ParserStatusController;
use App\Http\Controllers\Parser\ParserResultController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Settings\GptApiKeyController;
use App\Http\Controllers\Settings\GptParserUserSettingController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', HomeController::class)->name('home');

    Route::prefix('settings')->group(function () {
        /** Настройки */
        Route::prefix('common')->group(function () {
            Route::get('/', [GptParserUserSettingController::class, 'index'])->name('settings.common');
            Route::put('/', [GptParserUserSettingController::class, 'update']);
            Route::post('/', [GptParserUserSettingController::class, 'create']);
            // Route::delete('/', [GptParserUserSettingController::class, 'delete']);
        });

        /** Работа с ключами */
        Route::prefix('gpt-api-keys')->group(function () {
            Route::get('/', [GptApiKeyController::class, 'index'])->name('settings.gpt-api-keys');
            Route::put('/', [GptApiKeyController::class, 'update']);
            Route::post('/', [GptApiKeyController::class, 'create']);
            Route::delete('/{gpt_api_key}', [GptApiKeyController::class, 'delete']);
        });
    });


    /** Работа с парсером */
    Route::prefix('parser')->group(function () {
        Route::get('import', [ParserImportController::class, 'index'])->name('parser.import');
        Route::post('import', [ParserImportController::class, 'import']);
        Route::delete('import', [ParserImportController::class, 'delete'])->name('parser.import.delete');
        Route::get('status', [ParserStatusController::class, 'index'])->name('parser.status');
        Route::get('results', [ParserResultController::class, 'index'])->name('parser.results');
        Route::get('results-excel', [ParserResultController::class, 'downloadExcel'])->name('parser.results.excel');
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
