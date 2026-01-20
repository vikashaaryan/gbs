<?php

use App\Http\Controllers\HomeControler;
use App\Http\Controllers\UserPanelControler;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeControler::class,'home'])->name('home');
Route::get('/register',[HomeControler::class,'register'])->name('register');
Route::get('/login',[HomeControler::class,'login'])->name('login');
Route::get('/user',[UserPanelControler::class,'user'])->name('user');
Route::get('/subcat',[UserPanelControler::class,'subcat'])->name('subcat');