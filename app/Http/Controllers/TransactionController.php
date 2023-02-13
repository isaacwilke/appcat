<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

use App\Helpers\Helper;

class TransactionController extends Controller
{
    //https://whiskersandsoda.com/wp-json/armember/v1/arm_member_payments?arm_api_key=80PiekHihrxX9AoSEAsNxkFfp0Q16h&arm_user_id=25

    public function getWhiskerTransaction(){
        if(Session::has('user') && Session::has('token')){
           
            $user = Session::get('user');
            $token= Session::get('token');
            
            $method='GET';
            $token=$token['token'];
            $url=Config::get('constants.whisker.url.user_transaction_details').'arm_api_key='.Config::get('constants.whisker.armember_api_key').'&arm_user_id='.$user['id'].'&arm_perpage=10';
            $result =  Helper::PostRequest($data='', $method, $url, $token);
           
            if($result['status']==0){
                return back()->with('error', $result['message']);
            }
           
            return view('transaction.whisker.view',['response'=>$result['response']['result']]);
           
        }else{
            return redirect()->route('login')->with('error',"You Need to Login First...!!");
        }
    }
}
