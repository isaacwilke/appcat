<?php

namespace App\Http\Controllers;

use Auth;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->session()->has('user')){
            return view('pages.dashboard');
        }elseif($request->session()->has('griffin_user')){
            return redirect()->route('home');
        }else{
            return redirect()->route('login');
        }
    }

    public function index1(Request $request)
    {
        if($request->session()->has('griffin_user') && $request->session()->has('token')){
            $user = Session::get('griffin_user');
            $token = Session::get('token');
            $method='GET';
            $url =Config::get('constants.griffin.url.get_bookings').$user['id'];
            $token =$token['token']; 
            $booking =  Helper::PostRequest($data='', $method, $url, $token=$token);  
            
            return view('pages.griffin-dashboard', compact('booking'));
        }elseif($request->session()->has('user')){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('griffin');
        }
    }

    public function griffinbooking(Request $request){
        if($request->session()->has('griffin_user') && $request->session()->has('token')){
            if($request->ajax()){
                $user = Session::get('griffin_user');
                $token = Session::get('token');
                $method='GET';
                $url =Config::get('constants.griffin.url.get_bookings').$user['id'];
                $token =$token['token']; 
                $booking =  Helper::PostRequest($data='', $method, $url, $token=$token);  
                foreach($booking as $bookings ){
                    if($bookings['unique_id'] == $request->id){
                     
                      if(isset($bookings['details']['additional_info'] ) && !empty($bookings['details']['additional_info'])){
                        $data = json_decode($bookings['details']['additional_info'], true);
                        return Response::json(['success' => $data], 200);
                      }
                       
                    }
                }
            }
        }
    }

    public function contactus(Request $request){
        if($request->session()->has('griffin_user') && $request->session()->has('token')){
            return view('help.contactus');
        }
    }
    public function sendContactus(Request $request){
        if($request->session()->has('griffin_user') && $request->session()->has('token')){
          
           $data =[
            "Message"=>$request->message,
            "Name"=>$request->name,
            'Email'=>$request->email,
           ];
            Mail::send('mail.contactus', ['contactus' => $data], function($message) use($request){
                $message->to("test@test.com");
                $message->from($request->email);
                $message->subject('Contact us');
            });

            return redirect()->back();
        }
    }
}
