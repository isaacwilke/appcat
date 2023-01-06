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
    public function griffinBilling(Request $request){
        
        if($request->session()->has('griffin_user') && $request->session()->has('token')){
          
            $user = Session::get('griffin_user');
            
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
               
                $billing = $client->request('GET', 'https://exceledunet.com/wordpress2/wp-json/wc/v3/customers/'.$user['id'], [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$result['data']['token']}"
                    ]
                ]);

                $billing1 = $billing->getBody()->getContents();
                $billing_details = json_decode($billing1,true);
                // 
                // $result = json_decode($result,true);
                return view('pages.griffin_billing',['billing'=>$billing_details, 'result'=>$result['data']]);
            }catch (\GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
        
                $responseBodyAsString = json_decode($responseBodyAsString,true);
                //    dd($responseBodyAsString);
                return back()->with('error', $responseBodyAsString['message']);
            } 
            
        }elseif($request->session()->has('user')){
            return redirect()->route('whisker-billing');
        }else{
            return redirect()->route('griffin')->with("You Need To Login First...!!");
        }
    }

    public function storeGriffinBilling(Request $request ){
        
        if(Session::has('griffin_user') &&  Session::has('token')){
           
            $data = [
                'email'=>!empty($request->email)?$request->email:'',
                'first_name' =>!empty($request->first_name) ?$request->first_name:'',
                'last_name'=>!empty($request->last_name) ? $request->last_name:'',
                'username'=>!empty($request->username) ? $request->username:'',
                'billing' => [
                    'first_name' =>!empty($request->billing_first_name)?$request->billing_first_name :'' ,
                    'last_name'  => !empty($request->billing_lastt_name) ? $request->billing_lastt_name:'',
                    'company'=>!empty($request->billing_company) ?$request->billing_company :"",
                    'address_1'=>!empty($request->billing_address1)? $request->billing_address1:'',
                    'address_2'=>!empty($request->billing_address2)?$request->billing_address2:'',
                    'city'=>!empty($request->billing_city)?$request->billing_city:'',
                    'postcode'=>!empty($request->billing_postcode)?$request->billing_postcode:'',
                    'country'=>!empty($request->billing_country)?$request->billing_country:'',
                    'state'=>!empty($request->billing_state)?$request->billing_state:'',
                    'email'=>!empty($request->billing_email)?$request->billing_email:'',
                    'phone'=>!empty($request->billing_phone)? $request->billing_phone:''
                ],
                'shipping' => [
                    'first_name' => !empty($request->shipping_first_name)?$request->shipping_first_name:'',
                    'last_name'=> !empty($request->shipping_last_name)?$request->shipping_last_name:'',
                    'company'=>!empty($request->shipping_company)?$request->shipping_company:'',
                    'address_1'=>!empty($request->shipping_address1)?$request->shipping_address1:'',
                    'address_2'=> !empty($request->shipping_address2)?$request->shipping_address2 :'',
                    'city'=>!empty($request->shipping_city)?$request->shipping_city:'',
                    'postcode'=>!empty($request->shipping_postcode)?$request->shipping_postcode:'',
                    'country'=>!empty($request->shipping_country)?$request->shipping_country:'',
                    'state'=>!empty($request->shipping_state)?$request->shipping_state:'',
                    'phone'=>!empty($request->shipping_phone)?$request->shipping_phone:'',
                ]
            ];
            // dd($data);
            $client = new \GuzzleHttp\Client();
            try {
           
                $billing = $client->request('PUT','https://exceledunet.com/wordpress2/wp-json/wc/v3/customers/'.$request->user_id, [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$request->auth_token}"
                    ],'form_params' => $data
                ]);

                $billing1 = $billing->getBody()->getContents();
                $billing_details = json_decode($billing1,true);
                return redirect()->route('griffin-billing')->with('succes',"Billing & Shipping Information Update Successfully...!!");
                //return view('pages.griffin_billing',['billing'=>$billing_details, 'result'=>$result['data']]);
            }catch (\GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
        
                $responseBodyAsString = json_decode($responseBodyAsString,true);
                //    dd($responseBodyAsString);
                return back()->with('error', $responseBodyAsString['message']);
            }    
        }else{
            return redirect()->route('griffin')->with('error',"You Need To Login First...!!"); 
        }
    }

    public function whiskerBilling(Request $request){
        if($request->session()->has('user') && $request->session()->has('token')){
          
            $user = Session::get('user');
            
            
            $client = new \GuzzleHttp\Client();
            
            try {
                $response = $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/jwt-auth/v1/token', [
                    'form_params' => [
                        'username' => "admin",
                        'password' => 'admin@3338',
                    ]
                ]);
            
                $result = $response->getBody()->getContents();
                    
                $result = json_decode($result,true);
               
                $billing = $client->request('GET', 'https://exceledunet.com/wordpress/wp-json/wc/v3/customers/'.$user['id'], [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$result['data']['token']}"
                    ]
                ]);

                $billing1 = $billing->getBody()->getContents();
                $billing_details = json_decode($billing1,true);
                // 
                // $result = json_decode($result,true);
                return view('pages.billing',['billing'=>$billing_details, 'result'=>$result['data']]);
            }catch (\GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
        
                $responseBodyAsString = json_decode($responseBodyAsString,true);
                //    dd($responseBodyAsString);
                return back()->with('error', $responseBodyAsString['message']);
            } 
            
        }elseif($request->session()->has('griffin_user')){
            return redirect()->route('griffin-billing');
        }else{
            return redirect()->route('login')->with("You Need To Login First...!!");
        }
    }

    public function storeWhiskerBilling(Request $request ){
        
        if(Session::has('user') &&  Session::has('token')){
           
            $data = [
                'email'=>!empty($request->email)?$request->email:'',
                'first_name' =>!empty($request->first_name) ?$request->first_name:'',
                'last_name'=>!empty($request->last_name) ? $request->last_name:'',
                'username'=>!empty($request->username) ? $request->username:'',
                'billing' => [
                    'first_name' =>!empty($request->billing_first_name)?$request->billing_first_name :'' ,
                    'last_name'  => !empty($request->billing_lastt_name) ? $request->billing_lastt_name:'',
                    'company'=>!empty($request->billing_company) ?$request->billing_company :"",
                    'address_1'=>!empty($request->billing_address1)? $request->billing_address1:'',
                    'address_2'=>!empty($request->billing_address2)?$request->billing_address2:'',
                    'city'=>!empty($request->billing_city)?$request->billing_city:'',
                    'postcode'=>!empty($request->billing_postcode)?$request->billing_postcode:'',
                    'country'=>!empty($request->billing_country)?$request->billing_country:'',
                    'state'=>!empty($request->billing_state)?$request->billing_state:'',
                    'email'=>!empty($request->billing_email)?$request->billing_email:'',
                    'phone'=>!empty($request->billing_phone)? $request->billing_phone:''
                ],
                'shipping' => [
                    'first_name' => !empty($request->shipping_first_name)?$request->shipping_first_name:'',
                    'last_name'=> !empty($request->shipping_last_name)?$request->shipping_last_name:'',
                    'company'=>!empty($request->shipping_company)?$request->shipping_company:'',
                    'address_1'=>!empty($request->shipping_address1)?$request->shipping_address1:'',
                    'address_2'=> !empty($request->shipping_address2)?$request->shipping_address2 :'',
                    'city'=>!empty($request->shipping_city)?$request->shipping_city:'',
                    'postcode'=>!empty($request->shipping_postcode)?$request->shipping_postcode:'',
                    'country'=>!empty($request->shipping_country)?$request->shipping_country:'',
                    'state'=>!empty($request->shipping_state)?$request->shipping_state:'',
                    'phone'=>!empty($request->shipping_phone)?$request->shipping_phone:'',
                ]
            ];
             
            $client = new \GuzzleHttp\Client();
            try {
           
                $billing = $client->request('PUT','https://exceledunet.com/wordpress/wp-json/wc/v3/customers/'.$request->user_id, [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$request->auth_token}"
                    ],'form_params' => $data
                ]);

                $billing1 = $billing->getBody()->getContents();
                $billing_details = json_decode($billing1,true);
                return redirect()->route('whisker-billing')->with('succes',"Billing & Shipping Information Update Successfully...!!");
                
            }catch (\GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
        
                $responseBodyAsString = json_decode($responseBodyAsString,true);
                //    dd($responseBodyAsString);
                return back()->with('error', $responseBodyAsString['message']);
            }    
        }else{
            return redirect()->route('login')->with('error',"You Need To Login First...!!"); 
        }
    }

}