<?php

namespace App\Http\Controllers;
use DB;
use Mail; 
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class ResetPasswordController extends Controller
{
   

    public function show()
    {
        return view('auth.reset-password');
    }

  

    public function send(Request $request)
    {
        
        $email = $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(64);

        $user = User::where('email', $email)->first();

        if ($user) {
            DB::table('password_resets')->insert([
                'email' => $request->email, 
                'token' => $token, 
                'created_at' => Carbon::now()
              ]);
              $encrypted = Crypt::encryptString($request->email);
              Mail::send('emails.forget-password', ['token' => $token,  'email' => $encrypted], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });
    
            return redirect()->route('reset.password')->with('succes', 'An email was send to your email address');
        }
    }
}
