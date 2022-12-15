<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
Use Hash;
Use DB;
use Illuminate\Support\Facades\Crypt;

class ChangePasswordController extends Controller
{
    //
    protected $user;

    public function __construct()
    {
        Auth::logout();

        $id = intval(request()->id);
        $this->user = User::find($id);
    }

    public function show($token, $email)
    {
        $decrypt= Crypt::decryptString($email);
      
        return view('auth.change-password',['token' => $token,'email' => $decrypt]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6',
            'confirm-password' => 'required|same:password'
        ]);

        $updatePassword = DB::table('password_resets')
                            ->where([
                              'email' => $request->email, 
                              'token' => $request->token
                            ])
                            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();
        return redirect()->route('login')->with('succes', 'Your password has been changed!');
        // return redirect('/login')->with('success', '');
    
    }
}
