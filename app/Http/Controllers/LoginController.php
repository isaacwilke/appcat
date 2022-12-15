<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        if(Auth::user()){
            return redirect()->route('home');

        }else{
            return view('auth.login');
        }
        
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
       
       
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
          
        }else{
            return back()->with('error' ,'The provided credentials do not match our records.');
        }

       
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function api(){
        return view('api');
    }
    public function updateapi(Request $request){
        dd($request->all());
    }
}
