<?php

use App\Http\Controllers\admin\CircleController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\UserPaneController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/subcat', [UserPaneController::class, 'subcat'])->name('subcat');
Route::get('/user', [UserPaneController::class, 'user'])->name('user');

use App\Http\Controllers\Admin\DashboardController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])
        ->name('dashboard');
    Route::get('/circles', [CircleController::class, 'index'])->name('circles.index');
    Route::post('/circles', [CircleController::class, 'store'])->name('circles.store');
    Route::put('/circles/{circle}', [CircleController::class, 'update'])->name('circles.update');
    Route::delete('/circles/{circle}', [CircleController::class, 'destroy'])->name('circles.destroy');
});
