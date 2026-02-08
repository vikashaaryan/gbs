<?php

use App\Http\Controllers\admin\CircleController;
use App\Http\Controllers\admin\ManageUser;
use App\Http\Controllers\admin\SubCircleController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\PostController;
use App\Http\Controllers\user\RegisterController;
use App\Http\Controllers\user\UserPaneController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Home and auth routes
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/login', [RegisterController::class, 'login'])->name('login');

// Registration Routes
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// API route for dynamic sub-circles
Route::get('/api/circles/{circle}/sub-circles', [RegisterController::class, 'getSubCircles']);
Route::get('/subcat', [UserPaneController::class, 'subcat'])->name('subcat');

// User panel - this should load posts
Route::get('/user', [PostController::class, 'index'])->name('user');

// Post routes - IMPORTANT: Make sure these come after /user route
Route::middleware(['auth'])->group(function () {
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])->name('posts.like');
    Route::post('/posts/{post}/comment', [PostController::class, 'addComment'])->name('posts.comment');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// Redirect GET /posts to user panel
Route::get('/posts', function() {
    return redirect()->route('user');
})->name('posts.index');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])
        ->name('dashboard');
    Route::get('/manage-user', [ManageUser::class, 'manageUser'])->name('manage-users');
    Route::post('/users/{id}/toggle-verification', [ManageUser::class, 'toggleVerification'])->name('users.toggle-verification');
    
    Route::get('/circles', [CircleController::class, 'index'])->name('circles.index');
    Route::post('/circles', [CircleController::class, 'store'])->name('circles.store');
    Route::put('/circles/{circle}', [CircleController::class, 'update'])->name('circles.update');
    Route::delete('/circles/{circle}', [CircleController::class, 'destroy'])->name('circles.destroy');
    
    Route::get('/sub-circles', [SubCircleController::class, 'index'])->name('sub-circles.index');
    Route::post('/sub-circles', [SubCircleController::class, 'store'])->name('sub-circles.store');
    Route::put('/sub-circles/{subCircle}', [SubCircleController::class, 'update'])->name('sub-circles.update');
    Route::delete('/sub-circles/{subCircle}', [SubCircleController::class, 'destroy'])->name('sub-circles.destroy');
});