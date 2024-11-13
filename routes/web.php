<?php

use App\Http\Controllers\Admin\AdminFormController;
use App\Http\Controllers\Admin\AdminPermissionController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\ChessController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentAnswerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', AdminUserController::class);
        Route::resource('roles', AdminRoleController::class);
        Route::resource('permissions', AdminPermissionController::class);
        Route::resource('forms', AdminFormController::class);

        Route::put('students/update-password/{student}', [AdminStudentController::class, 'updatePassword'])->name('students.update.password');

        Route::resource('students', AdminStudentController::class);

        Route::post('forms/masive-destroy', [AdminFormController::class, 'masiveDestroy'])->name('forms.masive-destroy');
    })->middleware('can:admin.*');


    Route::prefix('answers')->name('answers.')->group(function () {
        Route::get('/forms', [StudentAnswerController::class, 'indexForms'])->name('index.forms');
        Route::get('/forms/{questionnaire}', [StudentAnswerController::class, 'showForm'])->name('show.form');
        Route::get('emotional', [StudentAnswerController::class, 'showEmotionalForm'])->name('emotional');
        Route::put('/', [StudentAnswerController::class, 'store'])->name('store');
    });

    Route::prefix('scores')->name('scores.')->group(function () {
        Route::get('/', [StudentAnswerController::class, 'indexScores'])->name('index');
    });



    // Chesse
    Route::prefix('chess')->name('chess.')->group(function () {
        Route::get('/new', [ChessController::class, 'startGame'])->name('game.new');
        Route::post('/aimove', [ChessController::class, 'aiMove'])->name('game.aimove');
    });

    // Forms

});

require __DIR__ . '/auth.php';
