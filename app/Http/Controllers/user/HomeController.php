<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     public function home()
    {
        return view('homepage');
    }
    public function register(){
        return view('register');

    }
    public function login(){
        return view('login');
    }
}
