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
    
    
    public function griffinwebcamajax(Request $request)
    {
        
        $roomno = '';
        $roomnolink = '';
        if ($request->session()->has('griffin_user') && $request->session()->has('token')) {

            $roomArr=array();
			$roomArr['1'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=01_FFB06_ROOM1&media=video+audio+microphone&micmute=1';
			$roomArr['2'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=02_FF680_ROOM2&media=video+audio+microphone&micmute=1';
			$roomArr['3'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=03_FFB6E_ROOM3&media=video+audio+microphone&micmute=1';
			$roomArr['4'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=04_FFF2D_ROOM4&media=video+audio+microphone&micmute=1';
			$roomArr['5'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=05_FF96F_ROOM5&media=video+audio+microphone&micmute=1';
			$roomArr['6'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=06_FFB3D_ROOM6&media=video+audio+microphone&micmute=1';
			$roomArr['7'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=07_FFF31_ROOM7&media=video+audio+microphone&micmute=1';
			$roomArr['8'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=08_FFCCD_ROOM8&media=video+audio+microphone&micmute=1';
			$roomArr['9'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=09_00081_ROOM9&media=video+audio+microphone&micmute=1';
			$roomArr['10'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=10_FFB78_ROOM10&media=video+audio+microphone&micmute=1';
			$roomArr['11'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=11_FFF7C_ROOM11&media=video+audio+microphone&micmute=1';
			$roomArr['12'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=12_CCF346_ROOM12&media=video+audio+microphone&micmute=1';
            $user = Session::get('griffin_user');
            $token = Session::get('token');
            $method = 'GET';
            $url = Config::get('constants.griffin.url.get_bookings') . $user['id'];
            $token = $token['token'];
            $booking =  Helper::PostRequest($data = '', $method, $url, $token = $token);
        	foreach ($booking as $bookings){
    	    	if($bookings['status'] == 'confirmed' && strtotime(date('Y-m-d'))  <=  strtotime(date('Y-m-d',strtotime($bookings['check_out']))))
				{
				    if($bookings['row_type'] == 'single-room')
					{
					    $roomno .= $bookings['room_no'].',';
					    $roomnolink .= $roomArr[$bookings['room_no']].',';
					}
					if($bookings['row_type'] == 'multiple-room')
					{
					    $roomnoArr = explode(",",$bookings['room_no']);
						foreach($roomnoArr as $room)
						{
						    $roomno .= $room.',';
						    $roomnolink .= $roomArr[$room].',';
						}
					}
				    
				}
        	}
        	$roomno = rtrim($roomno,',');
        	$roomnolink = rtrim($roomnolink,',');
        }
    	echo json_encode(array_map('utf8_encode', array(
			'roomno'=> $roomno,
			'roomnolink'=> $roomnolink
			)));
    }
	
	
}
