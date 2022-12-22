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
    public function index(Request $request)
    {
        if($request->session()->has('user')){
            return view('pages.dashboard');
        }else{
            return redirect()->route('login');
        }  
    }

    public function index1(Request $request)
    {
        if($request->session()->has('griffin_user')){
            return view('pages.griffin-dashboard');
        }else{
            return redirect()->route('griffin');
        }
    }
}
