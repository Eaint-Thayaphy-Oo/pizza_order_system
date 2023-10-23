<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //user home page
    public function home()
    {
        return view('user.main.home');
    }
}
