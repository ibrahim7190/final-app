<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DriveController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

//=============================================================
Route::middleware(['auth'])->group(function () {

    Route::prefix('drives')->group(function () {
        Route::get('index', [DriveController::class, 'index'])->name('drive.index');
        Route::get('create', [DriveController::class, 'create'])->name('drive.create');
        Route::post('store', [DriveController::class, 'store'])->name('drive.store');

        Route::get('show/{id}', [DriveController::class, 'show'])->name('drive.show');
        Route::get('edit/{id}', [DriveController::class, 'edit'])->name('drive.edit');
        Route::post('update/{id}', [DriveController::class, 'update'])->name('drive.update');
        Route::get('destroy/{id}', [DriveController::class, 'destroy'])->name('drive.destroy');
        Route::get('download/{id}', [Drivecontroller::class, 'download'])->name('drive.download');
    });
});
