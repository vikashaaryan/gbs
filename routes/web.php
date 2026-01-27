<?php

use App\Http\Controllers\admin\CircleController;
use App\Http\Controllers\admin\SubCircleController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\RegisterController;
use App\Http\Controllers\user\UserPaneController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/register', [RegisterController::class, 'register'])->name('register');
// Registration Routes
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// API route for dynamic sub-circles
Route::get('/api/circles/{circle}/sub-circles', [RegisterController::class, 'getSubCircles']);
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
    Route::get('/sub-circles', [SubCircleController::class, 'index'])->name('sub-circles.index');
    Route::post('/sub-circles', [SubCircleController::class, 'store'])->name('sub-circles.store');
    Route::put('/sub-circles/{subCircle}', [SubCircleController::class, 'update'])->name('sub-circles.update');
    Route::delete('/sub-circles/{subCircle}', [SubCircleController::class, 'destroy'])->name('sub-circles.destroy');

});
