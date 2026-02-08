<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Circle; // Add this line

class HomeController extends Controller
{
    public function home()
    {
        // Get all active circles
        $circles = Circle::where('status', true)->get();
        
        return view('homepage', compact('circles'));
    }
}