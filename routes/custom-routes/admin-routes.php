<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TrainingScheduleController;
use App\Http\Controllers\TrainingTimelineController;

Route::group(['prefix' => 'admin-dashboard', 'middleware' => ['auth', 'can:isAdmin']], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin-dashboard');

    Route::group(['prefix' => '/admins'], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin-index');
        Route::get('/create', [AdminController::class, 'create'])->name('admin-create');
        Route::post('/', [AdminController::class, 'save'])->name('admin-save');
        Route::get('/{id}', [AdminController::class, 'edit'])->name('admin-edit');
        Route::put('/{id}', [AdminController::class, 'update'])->name('admin-update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin-delete');
    });

    Route::group(['prefix' => '/participants'], function () {
        Route::get('/get-template', [ParticipantController::class, 'getTemplate'])->name('participant-get-template');
        Route::get('/', [ParticipantController::class, 'index'])->name('participant-index');
        Route::get('/create', [ParticipantController::class, 'create'])->name('participant-create');
        Route::post('/create', [ParticipantController::class, 'save'])->name('participant-save');
        Route::get('/create-bulk', [ParticipantController::class, 'create_bulk'])->name('participant-create-bulk');
        Route::get('/{id}', [ParticipantController::class, 'edit'])->name('participant-edit');
        Route::put('/{id}', [ParticipantController::class, 'update'])->name('participant-update');
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
        Route::get('/report/{id}', [TrainingScheduleController::class, 'report'])->name('training-schedule-report');
        Route::get('/bap/{id}', [TrainingScheduleController::class, 'generateBap'])->name('training-schedule-bap');
        Route::get('/absence/{id}', [TrainingScheduleController::class, 'generateAbsence'])->name('training-schedule-absence');
        Route::get('/requirement/{id}', [TrainingScheduleController::class, 'generateRequirementDocument'])->name('training-schedule-requirement');
        Route::put('/{id}', [TrainingScheduleController::class, 'update'])->name('training-schedule-update');
        Route::delete('/{id}', [TrainingScheduleController::class, 'destroy'])->name('training-schedule-delete');
    });

    Route::group(['prefix' => '/trainer'], function () {
        Route::get('/', [TrainerController::class, 'index'])->name('trainer-index');
        Route::get('/create', [TrainerController::class, 'create'])->name('trainer-create');
        Route::get('/{id}', [TrainerController::class, 'edit'])->name('trainer-edit');
        Route::put('/{id}', [TrainerController::class, 'update'])->name('trainer-update');
        Route::post('/create', [TrainerController::class, 'save'])->name('trainer-save');
        Route::delete('/{id}', [TrainerController::class, 'destroy'])->name('trainer-delete');
    });

    Route::group(['prefix' => '/registration'], function () {
        Route::get('/', [RegistrationController::class, 'index'])->name('registration-index');
        Route::get('/create', [RegistrationController::class, 'create'])->name('registration-create');
        Route::get('/{id}', [RegistrationController::class, 'edit'])->name('registration-edit');
        Route::post('/create', [RegistrationController::class, 'save'])->name('registration-save');
        Route::put('/{id}', [RegistrationController::class, 'update'])->name('registration-update');
        Route::delete('/{id}', [RegistrationController::class, 'destroy'])->name('registration-delete');
    });

    Route::group(['prefix' => '/training-timeline'], function () {
        Route::get('/', [TrainingTimelineController::class, 'index'])->name('training-timeline-index');
        Route::get('/{id}', [TrainingTimelineController::class, 'show'])->name('training-timeline-show');
        Route::post('/{id?}', [TrainingTimelineController::class, 'update'])->name('training-timeline-update');
    });

    Route::group(['prefix' => '/training'], function () {
        Route::get('/', [TrainingController::class, 'index'])->name('training-index');
        Route::get('/create', [TrainingController::class, 'create'])->name('training-create');
        Route::post('/create', [TrainingController::class, 'save'])->name('training-save');
        Route::get('/{id}}', [TrainingController::class, 'edit'])->name('training-edit');
        Route::put('/{id}', [TrainingController::class, 'update'])->name('training-update');
        Route::delete('/{id}', [TrainingController::class, 'destroy'])->name('training-delete');
    });
});
