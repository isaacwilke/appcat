<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Password;
// use Illuminate\Routing\Controller;

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
       
        $user = User::where("email", $request->email)->first();
        if(!empty($user)){
            if(Hash::check($request->password, $user->password)){
                
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

                    $request->session()->regenerate();
                    if($request->site=="Whisker And Soda - Where Cats and Relax Collide"){
                        $request->session()->put('one', $request->site);
                    }
                } 
                Auth::loginUsingId($user->id);
                return redirect()->intended('dashboard');
            }else{
                return back()->with('error' ,'Incorrect password.');
            }
        }else{
            return back()->with('error' ,'invalid user.'); 
        }     
          
    }

    public function logout(Request $request)
    {
        if($request->session()->has('one')){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        
            return redirect('/login');
        
        }
        if($request->session()->has('two')){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        
            return redirect('/login1');
        }
    }
    
    public function api(){
        return view('api');
    }
    
    public function updateapi(Request $request){

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            if($request->site=="Whisker And Soda - Where Cats and Relax Collide"){
                $request->session()->put('one', $request->site);
            }
            return redirect()->intended('dashboard');
        }       
        
    }
    
    public function display(){
        return view('auth.login1');
    }
    public function store(Request $request){
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
       
        $user = User::where("email", $request->email)->first();
        if(!empty($user)){
            if(Hash::check($request->password, $user->password)){
                
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

                    $request->session()->regenerate();
            
                    if($request->site=="Griffin Rock CAT Retreat - Your Cat's Vacation oasis"){
                        $request->session()->put('two', $request->site);
                    }
                 
                } 
            
                Auth::loginUsingId($user->id);
                return redirect()->intended('griffin-dashboard');
            }else{
                return back()->with('error' ,'Incorrect password.');
            }
        }else{
            return back()->with('error' ,'invalid user.'); 
        }     
        
    }
}
