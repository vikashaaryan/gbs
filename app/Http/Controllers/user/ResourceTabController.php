<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResourceTabController extends Controller
{
   public function tab(){
    return view('user.partials.resource-tab');
   }
}
