<?php

use App\Http\Controllers\GameController;

Route::group(['middleware' => ['installed', 'auth'], 'prefix' => 'dashboard'], function () {
    Route::get('games', [GameController::class, 'index'])->name('dashboard.games.index');

    Route::get('game/rush', [GameController::class, 'rush'])->name('games.rush');
    Route::post('game/rush/store', [GameController::class, 'rush_score_store'])->name('games.rush.score.store')->middleware('can:student');
    Route::post('game/rank/{game_id}', [GameController::class, 'rush_score_store'])->name('game.rank')->middleware('can:student');
    Route::get('game/giveaway/reward', [GameController::class, 'giveaway_reward'])->name('game.giveaway.reward')->middleware('can:admin');
    Route::get('game/rules/{game_id}', [GameController::class, 'game_rules'])->name('game.rules')->middleware('can:admin');
    Route::post('game/rules/{game_id}/update', [GameController::class, 'game_rules_update'])->name('game.rules.update')->middleware('can:admin');;
});

Route::get('play-earn-wallet', [GameController::class, 'frontend_index'])->name('frontend.game.index');
