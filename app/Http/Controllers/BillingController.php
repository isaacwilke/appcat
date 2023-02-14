<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;


class BillingController extends Controller
{
    //
    public function griffinBilling(Request $request){
        
        if($request->session()->has('griffin_user') && $request->session()->has('token')){
          
            $user = Session::get('griffin_user');
            
            // dd($token);
            $method='POST';
            $url=Config::get('constants.griffin.url.token');
            $data=[
                'username' => Config::get('constants.griffin.admin.username'),
                'password' => Config::get('constants.griffin.admin.password'),
            ];

            $result=Helper::PostRequest($data, $method, $url, $token='');
            if( $result['success']==false){
                return back()->with('error', $result['message']);
            }

            $method='GET';
            $url=Config::get('constants.griffin.url.get_billing').$user['id'];
           
            $token=$result['data']['token'];

            $billing_details= Helper::PostRequest($data='', $method, $url, $token);
           
            if(!empty($billing_details['message'])){
                return back()->with('error', $billing_details['message']);
            }

            return view('pages.griffin_billing',['billing'=>$billing_details, 'result'=>$result['data']]);     
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
            $method="PUT";
            $url=Config::get('constants.griffin.url.get_billing').$request->user_id;
            $token = $request->auth_token;

            $billing_details=Helper::PostRequest($data, $method, $url, $token);
           
            if(!empty($billing_details['message']) && !empty($billing_details['data']['status'])){
                return back()->with('error', $billing_details['message']);
            }elseif(!empty($billing_details['message'])){
                return redirect()->route('home')->with('error', $billing_details['message']);
            }else{
                return redirect()->route('griffin-billing')->with('succes',"Billing & Shipping Information Update Successfully...!!");

            }      
        }else{
            return redirect()->route('griffin')->with('error',"You Need To Login First...!!"); 
        }
    }

    public function whiskerBilling(Request $request){
        if($request->session()->has('user') && $request->session()->has('token')){
          
            $user = Session::get('user');
            
            $method="POST";
            $url=Config::get('constants.whisker.url.token');
            $data=[
                'username' => Config::get('constants.whisker.admin.username'),
                'password' => Config::get('constants.whisker.admin.password'),
            ];
            $result= Helper::PostRequest($data, $method, $url, $token='');
            if( $result['success']==false){
                return back()->with('error', $result['message']);
            }
        
            $method= "GET";
            $token=$result['data']['token'];
            $url = Config::get('constants.whisker.url.get_billing').$user['id'];
            $billing_details = Helper::PostRequest($data='', $method, $url, $token);
            dd( $billing_details);
            if(!empty($billing_details['message'])){
                return back()->with('error', $billing_details['message']);
            }    
            return view('pages.billing',['billing'=>$billing_details, 'result'=>$result['data']]);   
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

            $method="PUT";
            $url=Config::get('constants.whisker.url.get_billing').$request->user_id;
            $token = $request->auth_token;

            $billing_details=Helper::PostRequest($data, $method, $url, $token);

            if(!empty($billing_details['message']) && !empty($billing_details['data']['status'])){
                return back()->with('error', $billing_details['message']);
            }elseif(!empty($billing_details['message'])){
                return redirect()->route('dashboard')->with('error', $billing_details['message']);
            }else{
                return redirect()->route('whisker-billing')->with('succes',"Billing & Shipping Information Update Successfully...!!");
            }      
        }else{
            return redirect()->route('login')->with('error',"You Need To Login First...!!"); 
        }
    }

}
