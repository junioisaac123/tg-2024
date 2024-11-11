<?php

use App\Http\Controllers\Admin\AdminFormController;
use App\Http\Controllers\Admin\AdminPermissionController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\ChessController;
use App\Http\Controllers\ProfileController;
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
        Route::post('forms/masive-destroy', [AdminFormController::class, 'masiveDestroy'])->name('forms.masive-destroy');
    });

    // Chesse
    Route::prefix('chess')->name('chess.')->group(function () {
        Route::get('/new', [ChessController::class, 'startGame'])->name('game.new');
        Route::post('/aimove', [ChessController::class, 'aiMove'])->name('game.aimove');
    });

    // Forms

});

require __DIR__ . '/auth.php';
