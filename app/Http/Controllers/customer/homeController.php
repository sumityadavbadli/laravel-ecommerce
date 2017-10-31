<?php

namespace App\Http\Controllers\customer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class homeController extends Controller
{
    public function showHome() {
        return view('customer.home');
    }
}
