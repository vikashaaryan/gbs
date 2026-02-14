<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserPaneController extends Controller
{
      public function user(){
        
        return view('user.user-panel');
    }
    public function subcat(){
        return view('user.category');
    }
}
