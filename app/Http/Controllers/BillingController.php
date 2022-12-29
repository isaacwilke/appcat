<?php

namespace App\Http\Controllers;

use Hash;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class BillingController extends Controller
{
    //
    public function griffin_billing(Request $request){
        
        if($request->session()->has('griffin_user') && $request->session()->has('token')){
          
            $user = Session::get('griffin_user');
            $credentials = Session::get("user_credentials");
            $token = Session::get('token');
            // dd($token);
            $client = new \GuzzleHttp\Client();
            
            try {
                $response = $client->request('POST', 'https://exceledunet.com/wordpress2/wp-json/jwt-auth/v1/token', [
                    'form_params' => [
                        'username' => "admin2",
                        'password' => 'admin2@3338',
                    ]
                ]);
            
                $result = $response->getBody()->getContents();
                    
                $result = json_decode($result,true);
               
                $billing = $client->request('GET', 'https://exceledunet.com/wordpress2/wp-json/wc/v3/customers/3', [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$result['data']['token']}"
                    ]
                ]);

                $billing1 = $billing->getBody()->getContents();
                $billing_details = json_decode($billing1,true);
                return view('pages.griffin_billing',['billing'=>$billing_details]);
            }catch (\GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
        
                $responseBodyAsString = json_decode($responseBodyAsString,true);
                //    dd($responseBodyAsString);
                return back()->with('error', $responseBodyAsString['message']);
            } 
            
        }elseif($request->session()->has('user')){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('griffin');
        }
    }
}
