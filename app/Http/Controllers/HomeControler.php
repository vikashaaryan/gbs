<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeControler extends Controller
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
