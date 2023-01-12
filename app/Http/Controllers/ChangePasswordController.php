<?php

namespace App\Http\Controllers;
use DB;
use Mail; 
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Config;
use App\Helpers\Helper;


class ChangePasswordController extends Controller
{

    public function griffinDisplayPassword()
    {
    
        return view('auth.griffin-change-password');
    }

    public function griffinSetPassword(Request $request)
    {
      
        $method = 'POST';
        $url=Config::get('constants.griffin.url.token');
        $data=[
            'username' => Config::get('constants.griffin.admin.username'),
            'password' => Config::get('constants.griffin.admin.password'),
        ];
        
        //gettting token
        $validtoken= Helper::PostRequest($data, $method, $url, $token='');
        if($validtoken['success']==false){
            return back()->with('error', $validtoken['message']);
        }

        $data =[
            'email' => $request->email,
            'code' => $request->code,
        ];

        $token=$validtoken['data']['token'];
        $method='POST';
        $url=Config::get('constants.griffin.url.reset_validate');
        // validating code
        $validcode= Helper::PostRequest($data, $method, $url, $token);
        
        if($validcode['data']['status'] != 200){
            return back()->with('error', $validcode['message']);
        }
        
        if($validcode['message']=='The code supplied is valid.'){

            $url =Config::get('constants.griffin.url.set_password');
            $method = 'POST';
            $token=$validtoken['data']['token'];
            $data =[
                'email' => $request->email,
                'password'=>$request->password,
                'code'=>$request->code
            ];
            
            //Set password
            $setpassword = Helper::PostRequest($data, $method, $url, $token);
            
            if($setpassword['data']['status']!=200){
                return back()->with('error', $setpassword['message']);  
            }
            return redirect()->route('griffin')->with('succes', $setpassword['message']);
        }
       
    }

    public function whiskerDisplayPassword()
    {
    
        return view('auth.change-password');
    }
    public function whiskerSetPassword(Request $request)
    {
        
        $client = new \GuzzleHttp\Client();
        $method='POST';
        $url = Config::get('constants.whisker.url.token');
        $data=[
            'username' => Config::get('constants.whisker.admin.username'),
            'password' => Config::get('constants.whisker.admin.password'),
        ];

        //getting token
        $validtoken=Helper::PostRequest($data, $method, $url, $token='');
        if($validtoken['success']==false){
            return back()->with('error', $validtoken['message']);
        }

        $data =[
            'email' => $request->email,
            'code' => $request->code,
        ];

        $token=$validtoken['data']['token'];
        $method='POST';
        $url=Config::get('constants.whisker.url.reset_validate');

        //checking with code validation
        $validcode= Helper::PostRequest($data, $method, $url, $token);   
          
        if($validcode['message']=='The code supplied is valid.'){
            $method='POST';
            $token=$validtoken['data']['token'];
            $url=Config::get('constants.whisker.url.set_password');
            $data=[
                'email' => $request->email,
                'password'=>$request->password,
                'code'=>$request->code
            ];

            //Set password change he pasword
            $setpassword = Helper::PostRequest($data, $method, $url, $token);

            if($setpassword['data']['status']!=200){
                return back()->with('error', $setpassword['message']);  
            }    

            return redirect()->route('login')->with('succes', $setpassword['message']);
        }  
       
    }
}
