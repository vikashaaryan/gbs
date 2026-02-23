<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CircleController;
use App\Http\Controllers\admin\ManageUser;
use App\Http\Controllers\admin\ResourceController;
use App\Http\Controllers\admin\SubCircleController;
use App\Http\Controllers\Api\ResourceApiController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\LoginController;
use App\Http\Controllers\user\PostController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\user\RegisterController;
use App\Http\Controllers\user\UserPaneController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Home and auth routes
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/search-locations', [App\Http\Controllers\user\HomeController::class, 'searchLocations'])->name('search.locations');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Registration Routes
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
  Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.update-photo');
    // Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

// ============ API ROUTES - FIXED ============
Route::prefix('api')->group(function () {
    Route::get('/circles/{circleId}/sub-circles', [ResourceApiController::class, 'getSubCircles']);
    Route::get('/sub-circles/{subCircleId}/categories', [ResourceApiController::class, 'getCategoriesBySubCircle']);
    Route::get('/circles/{circleId}/categories', [ResourceApiController::class, 'getCategoriesByCircle']);
    Route::get('/resources', [ResourceApiController::class, 'getResources']); // ✅ ONLY ONE LINE FOR RESOURCES
});

// API route for dynamic sub-circles (for registration)
Route::get('/api/circles/{circle}/sub-circles', [RegisterController::class, 'getSubCircles']); // Ye alag hai, theek hai

Route::get('/subcat', [UserPaneController::class, 'subcat'])->name('subcat');

// User panel - this should load posts
Route::get('/user', [PostController::class, 'index'])->name('user');

// Post routes
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
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/manage-user', [ManageUser::class, 'manageUser'])->name('manage-users');
    Route::post('/users/{id}/toggle-verification', [ManageUser::class, 'toggleVerification'])->name('users.toggle-verification');
    
    Route::get('/circles', [CircleController::class, 'index'])->name('circles.index');
    Route::post('/circles', [CircleController::class, 'store'])->name('circles.store');
    Route::get('circles/search-locations', [CircleController::class, 'searchLocations'])->name('circles.search-locations');
    Route::put('/circles/{circle}', [CircleController::class, 'update'])->name('circles.update');
    Route::delete('/circles/{circle}', [CircleController::class, 'destroy'])->name('circles.destroy');
    
    Route::get('/sub-circles', [SubCircleController::class, 'index'])->name('sub-circles.index');
    Route::post('/sub-circles', [SubCircleController::class, 'store'])->name('sub-circles.store');
    Route::put('/sub-circles/{subCircle}', [SubCircleController::class, 'update'])->name('sub-circles.update');
    Route::delete('/sub-circles/{subCircle}', [SubCircleController::class, 'destroy'])->name('sub-circles.destroy');

    Route::get('/manage-category', [CategoryController::class, 'category'])->name('manage-categories');
    Route::post('/manage-category', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/manage-category/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/manage-category/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/manage-resources', [ResourceController::class, 'manageResources'])->name('manage-resources');
    Route::get('/resources/create', [ResourceController::class, 'createResource'])->name('resources.create');
    Route::post('/resources', [ResourceController::class, 'store'])->name('resources.store');
    Route::get('/resources/{id}/edit', [ResourceController::class, 'edit'])->name('resources.edit');
    Route::put('/resources/{id}', [ResourceController::class, 'update'])->name('resources.update');
    Route::delete('/resources/{id}', [ResourceController::class, 'destroy'])->name('resources.destroy');
    Route::get('/resources/{id}', [ResourceController::class, 'show'])->name('resources.show');
    Route::get('/resources/{id}/preview', [ResourceController::class, 'preview'])->name('resources.preview');
});