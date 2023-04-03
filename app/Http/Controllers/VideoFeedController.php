<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

use App\Helpers\Helper;



class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
   
    public function Display()
    {
        return view('VideoFeed');
    }
}