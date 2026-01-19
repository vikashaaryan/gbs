<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPanelControler extends Controller
{
    public function user(){
        return view('user.user-panel');
    }
}
