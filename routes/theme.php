<?php

use App\Http\Controllers\ThemeController;

Route::group(['middleware' => ['installed', 'auth'], 'prefix' => 'dashboard'], function () {
    Route::get('theme/manager', [ThemeController::class, 'theme_manager'])->name('theme.manager.index');
    Route::get('theme/installation', [ThemeController::class, 'installui'])->name('theme.manager.installui');
    Route::get('theme/status/{theme}', [ThemeController::class, 'theme_status'])->name('theme.status');
    Route::post('theme/install', [ThemeController::class, 'index'])->name('theme.install.index');
    Route::get('theme/preview/{theme}', [ThemeController::class, 'theme_preview'])->name('theme.preview');
    Route::post('theme/purchase/code/verify/{theme}', [ThemeController::class, 'purchase_code_verify'])
        ->name('theme.purchase_code.verify');

    Route::get('theme/index/page', [ThemeController::class, 'get_index_page'])->name('theme.get.index.page');
    Route::get('theme/install/page', [ThemeController::class, 'get_install_page'])->name('theme.get.install.page');
});
