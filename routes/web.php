<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TrainingScheduleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin-dashboard'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin-index');

    Route::group(['prefix' => '/participants'], function () {
        Route::get('/get-template', [ParticipantController::class, 'getTemplate'])->name('participant-get-template');
        Route::get('/', [ParticipantController::class, 'index'])->name('participant-index');
        Route::get('/create', [ParticipantController::class, 'create'])->name('participant-create');
        Route::get('/create-bulk', [ParticipantController::class, 'create_bulk'])->name('participant-create-bulk');
        Route::get('/{id}', [ParticipantController::class, 'edit'])->name('participant-edit');
        Route::post('/create-bulk', [ParticipantController::class, 'save_bulk'])->name('participant-save-bulk');
        Route::delete('/{id}', [ParticipantController::class, 'destroy'])->name('participant-delete');
    });

    Route::group(['prefix' => '/companies'], function() {
       Route::get('/', [CompanyController::class, 'index'])->name('company-index');
       Route::get('/create', [CompanyController::class, 'create'])->name('company-create');
       Route::post('/create', [CompanyController::class, 'save'])->name('company-save');
       Route::get('/{id}', [CompanyController::class, 'edit'])->name('company-edit');
       Route::put('/{id}', [CompanyController::class, 'update'])->name('company-update');
       Route::delete('/{id}', [CompanyController::class, 'destroy'])->name('company-delete');
    });

    Route::group(['prefix' => '/training-schedule'], function () {
        Route::get('/', [TrainingScheduleController::class, 'index'])->name('training-schedule-index');
        Route::get('/create', [TrainingScheduleController::class, 'create'])->name('training-schedule-create');
        Route::post('/create', [TrainingScheduleController::class, 'save'])->name('training-schedule-save');
        Route::get('/{id}', [TrainingScheduleController::class, 'edit'])->name('training-schedule-edit');
        Route::put('/{id}', [TrainingScheduleController::class, 'update'])->name('training-schedule-update');
        Route::delete('/{id}', [TrainingScheduleController::class, 'destroy'])->name('training-schedule-delete');
    });

    Route::group(['prefix' => '/registration'], function () {
        Route::get('/', [RegistrationController::class, 'index'])->name('registration-index');
        Route::get('/create', [RegistrationController::class, 'createc'])->name('registration-createc');
    });
});
        Route::post('/create', [ParticipantController::class, 'save'])->name('participant-save');
