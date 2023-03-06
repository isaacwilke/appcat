<?php


namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class WebcamController extends Controller
{
    //

    public function index(){
		
        return view('webcam.view');
    }
	
	public function griffinwebcam(Request $request)
    {
        if ($request->session()->has('griffin_user') && $request->session()->has('token')) {

            $user = Session::get('griffin_user');
            $token = Session::get('token');
            $method = 'GET';
            $url = Config::get('constants.griffin.url.get_bookings') . $user['id'];
            $token = $token['token'];
            $booking =  Helper::PostRequest($data = '', $method, $url, $token = $token);
			return view('webcam.view', compact('booking'));
        }
    }
	
	
}
