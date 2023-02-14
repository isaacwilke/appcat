<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

use App\Helpers\Helper;

class MembershipController extends Controller
{
    //
    public function getMember(){
        if(Session::has('user') && Session::has('token')){
           
            $user = Session::get('user');
            $token= Session::get('token');
            
            $method='GET';
            $token=$token['token'];
            $url=Config::get('constants.whisker.url.user_memberhip_details').'arm_api_key='.Config::get('constants.whisker.armember_api_key').'&arm_user_id='.$user['id'];
            $result =  Helper::PostRequest($data='', $method, $url, $token);
           
            if($result['status']==0){
                return back()->with('error', $result['message']);
            }
            return view('membership.view',['response'=>$result['response']['result']]);
           
        }else{
            return redirect()->route('login')->with('error',"You Need to Login First...!!");
        }
    }

    Public function listMembership(){
        if(Session::has('user') && Session::has('token')){
           
            $user = Session::get('user');
            $token= Session::get('token');
            $method = "GET";
            $token = $token['token'];
           
            $url = Config::get('constants.whisker.url.membership_list').'arm_api_key='.Config::get('constants.whisker.armember_api_key');
            $result =  Helper::PostRequest($data='', $method, $url, $token);
          
           
            if($result['status']==0){
                return back()->with('error', $result['message']);
            }
            return view('membership.list',['response'=>$result['response']['result']]);
           
        }else{
            return redirect()->route('login')->with('error',"You Need to Login First...!!");
        }
    }
    public function membershipdetails($id){
        if(Session::has('user') && Session::has('token')){
           
            $token= Session::get('token');
            $method = "GET";
            $token = $token['token'];
          
           
            $url = Config::get('constants.whisker.url.membership_details').'arm_api_key='.Config::get('constants.whisker.armember_api_key').'&arm_plan_id='.$id;
            
            $result =  Helper::PostRequest($data='', $method, $url, $token);
          
           
            if($result['status']==0){
                return back()->with('error', $result['message']);
            }
            return view('membership.detail',['response'=>$result['response'], 'plan_id'=>$id]);
           
        }else{
            return redirect()->route('login')->with('error',"You Need to Login First...!!");
        } 
    }

    public function addmember($id){
        if(Session::has('user') && Session::has('token')){
           $user= Session::get('user');
          
            $token= Session::get('token');
            $method = "GET";
            $token = $token['token'];
           
           
            $url = Config::get('constants.whisker.url.add_member_plan').'arm_api_key='.Config::get('constants.whisker.armember_api_key').'&arm_user_id='.$user['id'].'&arm_plan_id='.$id;
            
            $result =  Helper::PostRequest($data='', $method, $url, $token);
          
          
            if($result['status']==0){
                return back()->with('error', $result['message']);
            }
            return redirect()->route('whisker.memberlist')->with('succes',$result['message']);
           
        }else{
            return redirect()->route('login')->with('error',"You Need to Login First...!!");
        } 
    }
}
