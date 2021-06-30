<?php

use App\Http\Controllers\FrontAppController;

Route::group(['prefix' => 'front-app', 'middleware' => 'auth'], function () {
    Route::get('/', [FrontAppController::class, 'index'])->name('front-app-home');
    Route::get('/training-list', [FrontAppController::class, 'trainingList'])->name('front-app-training-list');
    Route::get('/training-list/register/{id}', [FrontAppController::class, 'register'])->name('front-app-register');
});
