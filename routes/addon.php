<?php

use App\Http\Controllers\AddonController;

Route::group(['middleware' => ['installed', 'auth'], 'prefix' => 'dashboard'], function () {
    Route::get('addon/manager', [AddonController::class, 'addons_manager'])->name('addons.manager.index');
    Route::get('addon/installation', [AddonController::class, 'installui'])->name('addons.manager.installui');
    Route::get('addon/status/{addon}', [AddonController::class, 'addon_status'])->name('addon.status');
    Route::post('addon/install', [AddonController::class, 'index'])->name('addon.install.index');
    Route::get('addon/preview/{addon}', [AddonController::class, 'addon_preview'])->name('addon.preview');
    Route::get('addon/setup/{addon}', [AddonController::class, 'addon_setup'])->name('addon.setup');
    Route::post('addons/purchase/code/verify/{addon}', [AddonController::class, 'purchase_code_verify'])
    ->name('addons.purchase_code.verify');

    Route::get('addon/remove/{addon}', [AddonController::class, 'addonRemove'])->name('addon.remove');

    //paytm setup
    Route::post('addon/paytm/account/setup', [AddonController::class, 'paytm_account_setup'])->name('addon.paytm.account.setup');

    // Get Index page
    Route::get('addon/index/page', [AddonController::class, 'get_index_page'])->name('get.index.page');
    Route::get('addon/install/page', [AddonController::class, 'get_install_page'])->name('get.install.page');
});
