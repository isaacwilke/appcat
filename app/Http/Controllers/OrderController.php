<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    //
    public function getWhiskerOrder(Request $request){
        if(Session::has('user') && Session::has('token')){
            $user = Session::get('user');
           
            
            $client = new \GuzzleHttp\Client();
            try{
                $response = $client->request('POST', Config::get('constants.whisker.url.token'), [
                    'form_params' => [
                        'username' =>Config::get('constants.whisker.admin.username'),
                        'password' => Config::get('constants.whisker.admin.password'),
                    ]
                ]);
                $result = $response->getBody()->getContents();
                $result = json_decode($result,true);
              
                $orderlistobj= $client->request('GET', Config::get('constants.whisker.url.list_order').'?search='.$user['email'],[
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$result['data']['token']}"
                    ]
                ]);
                $orderlistobj = $orderlistobj->getBody()->getContents();
                $orders = json_decode($orderlistobj,true);
                return view('orders.whisker.view',['orders'=>$orders]);
            }catch (\GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
        
                $responseBodyAsString = json_decode($responseBodyAsString,true);
                  
                return back()->with('error', $responseBodyAsString['message']);
            }
             catch (\Throwable $th) {
                return back()->with('error',  $th->getMessage());
            }
        }
    }

    public function editWhiskerOrder(Request $request, $id){
      if(Session::has('user') && Session::has('token')){
            $client = new \GuzzleHttp\Client();
            try {
                $response = $client->request('POST', Config::get('constants.whisker.url.token'), [
                    'form_params' => [
                        'username' =>Config::get('constants.whisker.admin.username'),
                        'password' => Config::get('constants.whisker.admin.password'),
                    ]
                ]);
                $result = $response->getBody()->getContents();
                $result = json_decode($result,true);
                $orderlistobj= $client->request('GET', Config::get('constants.whisker.url.get_order').$id,[
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$result['data']['token']}"
                    ]
                ]);
                $orderlistobj = $orderlistobj->getBody()->getContents();
                $orders = json_decode($orderlistobj,true);
                return view('orders.whisker.edit',['order'=>$orders, 'token'=>$result['data']]);
            }catch (\GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
        
                $responseBodyAsString = json_decode($responseBodyAsString,true);
                    
                return back()->with('error', $responseBodyAsString['message']);
            } catch (\Throwable $th) {
                return back()->with('error',  $th->getMessage());
            }
        }
    }
    public function storeWhskerOrder(Request $request){
        if(Session::has('user') && Session::has('token')){
            $data = [
                'transaction_id'=>!empty($request->transaction_id)?$request->transaction_id:'',
                'payment_method' =>!empty($request->payment_method) ?$request->payment_method:'',
                'order_key'=>!empty($request->order_key) ? $request->order_key:'',
                'discount_total'=>!empty($request->discount_total) ? $request->discount_total:'',
                'discount_tax'=>!empty($request->discount_tax) ? $request->discount_tax:'',
                'discount_total'=>!empty($request->discount_total) ? $request->discount_total:'',
                'shipping_total'=>!empty($request->shipping_total) ? $request->shipping_total:'',
                'shipping_tax'=>!empty($request->shipping_tax) ? $request->shipping_tax:'',
                'cart_tax'=>!empty($request->cart_tax) ? $request->cart_tax:'',
                'total'=>!empty($request->total) ? $request->total:'',
                'total_tax'=>!empty($request->total_tax) ? $request->total_tax:'',
                'status'=>!empty($request->status) ? $request->status:'',
                'currency'=>!empty($request->currency) ? $request->currency:'',
                'date_completed'=>!empty($request->date_completed) ? $request->date_completed:'',
                'date_paid'=>!empty($request->date_paid) ? $request->date_paid:'',

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
            try{
                $orderlistobj = $client->request('PUT',Config::get('constants.whisker.url.get_order').$request->order_id, [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$request->token}"
                    ],'form_params' => $data
                ]);
                $orderlistobj = $orderlistobj->getBody()->getContents();
                $orders = json_decode($orderlistobj,true);
                
                if(!empty($orders)){
                    return redirect()->route('whisker.order')->with('succes','Order Details Updated Successfully...!!');
                }
            }catch (\GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
        
                $responseBodyAsString = json_decode($responseBodyAsString,true);
                    
                return back()->with('error', $responseBodyAsString['message']);
            } catch (\Throwable $th) {
                return back()->with('error',  $th->getMessage());
            }
        }
    }
}
