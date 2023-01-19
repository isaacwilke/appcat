<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use App\Helpers\Helper;


class OrderController extends Controller
{
    //
    public function getWhiskerOrder(Request $request){
        if(Session::has('user') && Session::has('token')){
            $user = Session::get('user');
            $data =[
                'username' =>Config::get('constants.whisker.admin.username'),
                'password' => Config::get('constants.whisker.admin.password'),
            ];
            $method='POST';
            $url=Config::get('constants.whisker.url.token');
            $result =  Helper::PostRequest($data, $method, $url, $token='');
            if($result['success']==false){
                return back()->with('error', $result['message']);
            }
            
            $method="GET";
            $url=Config::get('constants.whisker.url.list_order').'?search='.$user['email'];
            $token=$result['data']['token'];
            $orders=Helper::PostRequest($data='', $method, $url, $token);
          
            if(!empty($orders['0'])){
                return view('orders.whisker.view',['orders'=>$orders]);
               
            }else{
                return back()->with('error', $orders['message']);   
               
            }
           
        }elseif(Session::has('griffin_user') && Session::has('token')){
            return redirect()->route('griffin.order');
        }else{
            return redirect()->route('login')->with('error',"You Need to Login First...!!");
        }
    }

    public function editWhiskerOrder(Request $request, $id){
        if(Session::has('user') && Session::has('token')){
            $user = Session::get('user');
            $data =[
                'username' =>Config::get('constants.whisker.admin.username'),
                'password' => Config::get('constants.whisker.admin.password'),
            ];
            $method='POST';
            $url=Config::get('constants.whisker.url.token');
            $result =  Helper::PostRequest($data, $method, $url, $token='');
            if($result['success']==false){
                return back()->with('error', $result['message']);
            }
           
        
            $method ='GET';
            $url =Config::get('constants.whisker.url.get_order').$id;
           
            $token= $result['data']['token'];
            $orders =Helper::PostRequest($data='', $method, $url, $token);
            
            if(!empty($orders['data'])){
                return back()->with('error',  $orders['message']);
            }elseif(!empty($orders) && isset($orders['success'])){
                return back()->with('error',  $orders['message']);
            }else{
                return view('orders.whisker.edit',['order'=>$orders, 'token'=>$result['data']]);
            }           
        }elseif(Session::has('griffin_user') && Session::has('token')){
            return redirect()->route('griffin.edit');
        }else{
            return redirect()->route('login')->with('error', 'You Need To Login First...!!');
        }
    }
    public function storeWhskerOrder(Request $request){
        if(Session::has('user') && Session::has('token')){
            
            $shipping_line = array();
            foreach($request->shipping_lines_id as $key=>$id){
                $shipping_line[$key]['id']=$id;
            }
            foreach($request->shipping_lines_method_title as $key=>$method_title){
                $shipping_line[$key]['method_title']=$method_title;
            }
            foreach($request->shipping_lines_method_id as $key=>$method_id){
                $shipping_line[$key]['method_id']=$method_id;
            }
            foreach($request->shipping_lines_instance_id as $key=>$instance_id){
                $shipping_line[$key]['instance_id']=$instance_id;
            }
            foreach($request->shipping_lines_total as $key=>$total){
                $shipping_line[$key]['total']=$total;
            }
            foreach($request->shipping_lines_total_tax as $key=>$total_tax){
                $shipping_line[$key]['total_tax']=$total_tax;
            }
           
            $feeline = array();
            foreach($request->fees_line_id as $key=>$id){
                $feeline[$key]['id']=$id;
            }
            foreach($request->fees_line_name as $key=>$name){
                $feeline[$key]['name']=$name;
            }
            foreach($request->fees_line_tax_class as $key=>$tax_class){
                $feeline[$key]['tax_class']=$tax_class;
            }
            foreach($request->fees_line_tax_status as $key=>$tax_status){
                $feeline[$key]['tax_status']=$tax_status;
            }
            foreach($request->fees_line_amount as $key=>$amount){
                $feeline[$key]['amount']=$amount;
            }
            foreach($request->fees_line_total as $key=>$total){
                $feeline[$key]['total']=$total;
            }
            foreach($request->fees_line_total_tax as $key=>$total_tax){
                $feeline[$key]['total_tax']=$total_tax;
            }
        
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
                ],
                "shipping_lines" =>$shipping_line,
              "fee_lines" =>$feeline,
            ];
          
            $url =Config::get('constants.whisker.url.get_order').$request->order_id;
            $token=$request->token;
            $method="PUT";
            $orders=Helper::PostRequest($data, $method, $url, $token);
           
            if(!empty($orders['data'])){
                return back()->with('error',  $orders['message']);
            }elseif(!empty($orders) && isset($orders['success'])){
                return back()->with('error',  $orders['message']);
            }else{
                return redirect()->route('whisker.order')->with('succes','Order Details Updated Successfully...!!');
            } 
           
        }elseif(Session::has('griffin_user') && Session::has('token')){
            return redirect()->route('griffin.edit');
        }else{
            return redirect()->route('login')->with('error','You Need To Login First....!!!');
        }
    }

    public function getGriffinOrder(){
        if(Session::has('griffin_user') && Session::has('token')){
           
            $user = Session::get('griffin_user');
            $method='POST';
            $url =Config::get('constants.griffin.url.token');
            $data=[
                'username' =>Config::get('constants.griffin.admin.username'),
                'password' => Config::get('constants.griffin.admin.password'),
            ];
            $result =  Helper::PostRequest($data, $method, $url, $token='');
            if($result['success']==false){
                return back()->with('error', $result['message']);
            }
            $method="GET";
            $url= Config::get('constants.griffin.url.list_order').'?search='.$user['email'];
            $token=$result['data']['token'];
            $orders=Helper::PostRequest($data='', $method, $url, $token);
          
            if(!empty($orders['0'])){
                return view('orders.griffin.view',['orders'=>$orders]);
               
            }else{
                return back()->with('error', $orders['message']);   
               
            }
        }elseif(Session::has('user') && Session::has('token')){
            return redirect()->route('whisker.order');
        }else{
            return redirect()->route('griffin')->with('error',"You Need to Login First...!!");
        }
    }

    public function editGriffinOrder(Request $request, $id){
        if(Session::has('griffin_user') && Session::has('token')){
            
            $method ="POST";
            $data=[
                'username' =>Config::get('constants.griffin.admin.username'),
                'password' => Config::get('constants.griffin.admin.password'),
            ];
            $url = Config::get('constants.griffin.url.token');
            $result = Helper::PostRequest($data, $method, $url , $token='');
            if($result['success']==false){
                return back()->with('error', $result['message']);
            }

            $method ="GET";
            $url=Config::get('constants.griffin.url.get_order').$id;
            $token=$result['data']['token'];
            $orders= Helper::PostRequest($data='', $method, $url, $token);
             
            if(!empty($orders['data'])){
                return back()->with('error',  $orders['message']);
            }elseif(!empty($orders) && isset($orders['success'])){
                return back()->with('error',  $orders['message']);
            }else{
                return view('orders.griffin.edit',['order'=>$orders, 'token'=>$result['data']]);
            }   
          
        }elseif(Session::has('user') && Session::has('token')){
            return redirect()->route('whisker.edit');
        }else{
            return redirect()->route('griffin')->with('error', 'You Need To Login First...!!');
        }
    }

    public function storeGriffinOrder(Request $request){
        if(Session::has('griffin_user') && Session::has('token')){
           
            $shipping_line = array();
            foreach($request->shipping_lines_id as $key=>$id){
                $shipping_line[$key]['id']=$id;
            }
            foreach($request->shipping_lines_method_title as $key=>$method_title){
                $shipping_line[$key]['method_title']=$method_title;
            }
            foreach($request->shipping_lines_method_id as $key=>$method_id){
                $shipping_line[$key]['method_id']=$method_id;
            }
            foreach($request->shipping_lines_instance_id as $key=>$instance_id){
                $shipping_line[$key]['instance_id']=$instance_id;
            }
            foreach($request->shipping_lines_total as $key=>$total){
                $shipping_line[$key]['total']=$total;
            }
            foreach($request->shipping_lines_total_tax as $key=>$total_tax){
                $shipping_line[$key]['total_tax']=$total_tax;
            }
           
           
            $feeline = array();
            foreach($request->fees_line_id as $key=>$id){
                $feeline[$key]['id']=$id;
            }
            foreach($request->fees_line_name as $key=>$name){
                $feeline[$key]['name']=$name;
            }
            foreach($request->fees_line_tax_class as $key=>$tax_class){
                $feeline[$key]['tax_class']=$tax_class;
            }
            foreach($request->fees_line_tax_status as $key=>$tax_status){
                $feeline[$key]['tax_status']=$tax_status;
            }
            foreach($request->fees_line_amount as $key=>$amount){
                $feeline[$key]['amount']=$amount;
            }
            foreach($request->fees_line_total as $key=>$total){
                $feeline[$key]['total']=$total;
            }
            foreach($request->fees_line_total_tax as $key=>$total_tax){
                $feeline[$key]['total_tax']=$total_tax;
            }
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
                ],
                "shipping_lines" =>$shipping_line,
              "fee_lines" =>$feeline,
                    
            ];
            
            $method= "PUT";
            $url=Config::get('constants.griffin.url.get_order').$request->order_id;
            $token=$request->token;
            $orders= Helper::PostRequest($data, $method, $url, $token);
            if(!empty($orders['data'])){
                return back()->with('error',  $orders['message']);
            }elseif(!empty($orders) && isset($orders['success'])){
                return back()->with('error',  $orders['message']);
            }else{
                return redirect()->route('griffin.order')->with('succes','Order Details Updated Successfully...!!');
            }       
           
        }elseif(Session::has('user') && Session::has('token')){
            return redirect()->route('whisker.edit');
        }else{
            return redirect()->route('griffin')->with('error','You Need To Login First....!!!');
        }
    }

}
