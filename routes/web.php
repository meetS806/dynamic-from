<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\FormFieldController;
use App\Http\Controllers\User\FormController as UserFormController;
use App\Http\Controllers\User\SubmissionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Forms
        Route::get('/forms', [FormController::class, 'index'])
            ->name('forms.index');

        Route::get('/forms/create', [FormController::class, 'create'])
            ->name('forms.create');

        Route::post('/forms', [FormController::class, 'store'])
            ->name('forms.store');

        Route::get('/forms/{form}/edit', [FormController::class, 'edit'])
            ->name('forms.edit');

        // Fields
        Route::post(
            '/forms/{form}/fields',
            [FormFieldController::class, 'store']
        )->name('forms.fields.store');
    });

    Route::middleware('auth')
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get('/forms', [UserFormController::class, 'index'])
            ->name('forms.index');

        Route::get('/forms/{form}', [UserFormController::class, 'show'])
            ->name('forms.show');

        Route::post('/forms/{form}/submit', [SubmissionController::class, 'store'])
            ->name('forms.submit');
    });


require __DIR__.'/auth.php';
