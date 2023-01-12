<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Config;

class ResetPasswordController extends Controller
{
   
    public function griffinReset()
    {
        return view('auth.griffin-reset-password');
    }

    public function griffinPassword(Request $request){
       
        $method ='POST';
        $url = Config::get('constants.griffin.url.token');
        $data=[
            'username' => Config::get('constants.griffin.admin.username'),
            'password' => Config::get('constants.griffin.admin.password'),
        ];
        
        // fetching token from griffin site
        $validtoken=Helper::PostRequest($data, $method, $url, $token='');
        if($validtoken['success']==false){
            return back()->with('error', $validtoken['message']);
        }

        $url =Config::get('constants.griffin.url.reset_password');
        $method='post';
        $token=$validtoken['data']['token'];
        $data=[
            'email' => $request->email,
        ];

        //send reset password mail with code
        $resetpassword=Helper::PostRequest($data, $method, $url, $token);
        
        if($resetpassword['data']['status'] != 200){
            return back()->with('error', $resetpassword['message']);
        }
        
        return redirect()->route('griffin.set')->with('succes',$resetpassword['message']);      
      
    }

    public function whiskerReset()
    {
        return view('auth.reset-password');
    }

    public function whiskerPassword(Request $request){

        $client = new \GuzzleHttp\Client();
        $url=Config::get('constants.whisker.url.token');
        $method='POST';
        $data=[
            'username' => Config::get('constants.whisker.admin.username'),
            'password' => Config::get('constants.whisker.admin.password'),
        ];

        //getting token from whisker site
        $validtoken= Helper::PostRequest($data, $method, $url, $token='');
        if($validtoken['success']==false){
            return back()->with('error', $validtoken['message']);
        }

        $url=Config::get('constants.whisker.url.reset_password');
        $method='POST';
        $data=[
            'email' => $request->email
        ];
        $token =$validtoken['data']['token'];

        //send email with for reset password with code
        $resetpassword= Helper::PostRequest($data, $method, $url, $token);
        if($resetpassword['data']['status'] != 200){
            return back()->with('error', $resetpassword['message']);
        }
        return redirect()->route('whisker.set')->with('succes',$resetpassword['message']);
    }
}
