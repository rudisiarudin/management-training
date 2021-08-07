<?php

use App\Http\Controllers\FrontAppController;

Route::group(['prefix' => 'front-app', 'middleware' => 'auth'], function () {
    Route::get('/', [FrontAppController::class, 'index'])->name('front-app-home');
    Route::get('/training-list', [FrontAppController::class, 'trainingList'])->name('front-app-training-list');
    Route::get('/training-list/register/{id}', [FrontAppController::class, 'register'])->name('front-app-register');
    Route::get('/profile', [FrontAppController::class, 'profile'])->name('front-app-profile');
    Route::put('/profile/{id}', [FrontAppController::class, 'updateProfile'])->name('front-app-profile-update');
    Route::post('/training-list/register/{id}', [FrontAppController::class, 'saveRegistration'])->name('front-app-registration-save');
    Route::post('/generate-certificate/{id}', [FrontAppController::class, 'generateCertificate'])->name('front-app-generate-certificate');
});
