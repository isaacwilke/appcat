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
        if ($request->session()->has('user')) {
            return view('pages.dashboard');
        } elseif ($request->session()->has('griffin_user')) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login');
        }
    }

  

    public function index1(Request $request, $status = "")
    {
        if ($request->session()->has('griffin_user') && $request->session()->has('token')) {

            if (!empty($status) &&  $status != "All") {
                Session::put('Status', $status);
                $user = Session::get('griffin_user');

                $token = Session::get('token');
                $method = 'GET';
                $url = Config::get('constants.griffin.url.get_bookings') . $user['id'];
                $token = $token['token'];
                $booking =  Helper::PostRequest($data = '', $method, $url, $token = $token);
                $filterBooking = [];
               
                if (!empty($booking)) {
                    foreach ($booking as $bookings) {
                        $now = Carbon::now()->format('Y-m-d');

                        if ($status == "Current" && $bookings['check_in'] > $now) {
                            $filterBooking[] = $bookings;
                            // return Response::json(['success' => $data], 200);
                        }
                        if (($status == "Past") && ($bookings['check_in'] < $now) && ($bookings['check_out'] < $now)) {
                            $filterBooking[] = $bookings;
                        } else if (($status == "Past") && ($bookings['check_in'] > $now) && ($bookings['check_out'] > $now)) {
                            $filterBooking[] = null;
                        }
                    }
                    if (isset($filterBooking) && !empty($filterBooking)) {
                        $filterBooking = array_filter($filterBooking);
                    }
                    return view('pages.griffin-dashboard', compact('filterBooking'));
                } else {
                    $filterBooking[] = $booking;
                    return view('pages.griffin-dashboard', compact('filterBooking'));
                }
            } else {
                Session::put('Status', 'All');
                $user = Session::get('griffin_user');
                $token = Session::get('token');
                $method = 'GET';
                $url = Config::get('constants.griffin.url.get_bookings') . $user['id'];
                $token = $token['token'];
                $filterBooking =  Helper::PostRequest($data = '', $method, $url, $token = $token);

                return view('pages.griffin-dashboard', compact('filterBooking'));
            }
        } elseif ($request->session()->has('user')) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('griffin');
        }
    }

    public function griffinbooking(Request $request, $id)
    {
        if ($request->session()->has('griffin_user') && $request->session()->has('token')) {

            $user = Session::get('griffin_user');
            $token = Session::get('token');
            $method = 'GET';
            $url = Config::get('constants.griffin.url.get_bookings') . $user['id'];
            $token = $token['token'];
            $booking =  Helper::PostRequest($data = '', $method, $url, $token = $token);
            foreach ($booking as $bookings) {
                if ($bookings['unique_id'] == $id) {


                    $booking = $bookings;
                    // return Response::json(['success' => $data], 200);

                    return view('home.griffin.reservation', compact('booking'));
                }
            }
        }
    }

    public function contactus(Request $request)
    {
        if ($request->session()->has('griffin_user') && $request->session()->has('token')) {
            return view('help.contactus');
        }
    }
    public function sendContactus(Request $request)
    {
        if ($request->session()->has('griffin_user') && $request->session()->has('token')) {

            $data = [
                "Message" => $request->message,
                "Name" => $request->name,
                'Email' => $request->email,
            ];
            Mail::send('mail.contactus', ['contactus' => $data], function ($message) use ($request) {
                $message->to("admin@griffinrockcatretreat.com");
                $message->from($request->email);
                $message->subject('Contact us');
            });

            return redirect()->back();
        }
    }

    public function cancelReservation(Request $request)
    {
        if ($request->session()->has('griffin_user') && $request->session()->has('token')) {
            $user = Session::get('griffin_user');
            $random = [
                'email' => $user['email'],
                'booking' => $request->bookingid,
            ];
            $token = Session::get('token');
            $method = 'GET';
            $url = Config::get('constants.griffin.url.cancel_booking') . $request->bookingid;
            $token = $token['token'];
            $booking =  Helper::PostRequest($data = '', $method, $url, $token = $token);
            if ($booking['status'] == 'success') {
                $user = Session::get('griffin_user');
				
				
                Mail::send('mail.cancelreservation', ['reservation' => $request->all(), "email" => $user['email'], 'name' => $user['first_name'] . ' ' . $user['last_name']], function ($message) use ($random) {
                    $message->to([$random['email'], 'isaac@divinusinc.com']);

                    $message->subject('Reservation cancelled for customer' . " : " . $random['email']);
                });
				

                return redirect()->route('home')->with('succes', $booking['message']);
            } else {
                return redirect()->route('home')->with('error', $booking['message']);
            }
        }
    }
}
