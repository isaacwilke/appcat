<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if(Auth::user()){
            return view('pages.dashboard');

        }else{
            return redirect()->route('login');
        }
    }

    public function index1()
    {
        if(Auth::user()){
            return view('pages.griffin-dashboard');

        }else{
            return redirect()->route('login');
        }
    }
}
