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
            $roomArr['1'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c8/s0/live';
            $roomArr['2'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c9/s0/live';
            $roomArr['3'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c6/s0/live';
            $roomArr['4'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c5/s0/live';
            $roomArr['5'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c4/s0/live';
            $roomArr['6'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c3/s0/live';
            $roomArr['7'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c7/s0/live';
            $roomArr['8'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c10/s0/live';
            $roomArr['9'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c11/s0/live';
            $roomArr['10'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c12/s0/live';
            $roomArr['11'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c13/s0/live';
            $roomArr['12'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c14/s0/live';
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
					    $exists = 1;
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
    	echo json_encode(array_map('utf8_encode', array('exists' => $exists,
			'roomno'=> $roomno,
			'roomnolink'=> $roomnolink
			)));
    }
	
	
}
