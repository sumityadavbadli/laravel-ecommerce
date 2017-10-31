<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class dashboard extends Controller
{

    public function showHome(){
         return view('user.dashboard');    
    }
    
    public function showProduct(){
         return view('product-view');    
    }
    
}
