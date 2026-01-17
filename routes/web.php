<?php

use App\Http\Controllers\HomeControler;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeControler::class,'home'])->name('home');
Route::get('/register',[HomeControler::class,'register'])->name('register');
Route::get('/login',[HomeControler::class,'login'])->name('login');