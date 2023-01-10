<?php

namespace App\Http\Controllers;
use DB;
use Mail; 
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Config;



class ResetPasswordController extends Controller
{
   

    public function griffinReset()
    {
        return view('auth.griffin-reset-password');
    }

    // public function whiskerReset()
    // {
    //     return view('auth.reset-password');
    // }

    public function griffinPassword(Request $request){
        $client = new \GuzzleHttp\Client();
        try{
            $token = $client->request('POST', Config::get('constants.griffin.url.token'), [
            
                'form_params' => [
                    'username' => Config::get('constants.griffin.admin.username'),
                    'password' => Config::get('constants.griffin.admin.password'),
                ]
            ]);
            $validtoken = $token->getBody()->getContents();
            $validtoken= json_decode($validtoken,true);
        
            $resetpassword = $client->request('POST', Config::get('constants.griffin.url.reset_password'), [
                'headers' =>
                [
                    'Authorization' => "Bearer {$validtoken['data']['token']}"
                ],'form_params' => [
                    'email' => $request->email
                ]
            ]);
           
            $resetpassword = $resetpassword->getBody()->getContents();
            $resetpassword = json_decode($resetpassword,true);
            // dd($resetpassword);
           return redirect()->route('griffin.set')->with('succes',$resetpassword['message']);
            
        }catch(\GuzzleHttp\Exception\ClientException $e){
            $resetpassword = $e->getResponse();
           
            $responseBodyAsString = $resetpassword->getBody()->getContents();
            
            $responseBodyAsString = json_decode($responseBodyAsString,true);
            //    dd($responseBodyAsString);
            return back()->with('error', $responseBodyAsString['message']);
        }catch (\Throwable $th) {
           
            $throw = $th->getResponse();
            $responseBodyAsString = $throw->getBody()->getContents();
            $responseBodyAsString = json_decode($responseBodyAsString,true);
           
            return back()->with('error',  $responseBodyAsString['message']);
		}
    }

    public function whiskerReset()
    {
        return view('auth.reset-password');
    }

    public function whiskerPassword(Request $request){
        $client = new \GuzzleHttp\Client();
        try{
            $token = $client->request('POST', Config::get('constants.whisker.url.token'), [
            
                'form_params' => [
                    'username' => Config::get('constants.whisker.admin.username'),
                    'password' => Config::get('constants.whisker.admin.password'),
                ]
            ]);
            $validtoken = $token->getBody()->getContents();
            $validtoken= json_decode($validtoken,true);
        
            $resetpassword = $client->request('POST', Config::get('constants.whisker.url.reset_password'), [
                'headers' =>
                [
                    'Authorization' => "Bearer {$validtoken['data']['token']}"
                ],'form_params' => [
                    'email' => $request->email
                ]
            ]);
           
            $resetpassword = $resetpassword->getBody()->getContents();
            $resetpassword = json_decode($resetpassword,true);
            // dd($resetpassword);
           return redirect()->route('whisker.set')->with('succes',$resetpassword['message']);
            
        }catch(\GuzzleHttp\Exception\ClientException $e){
            $resetpassword = $e->getResponse();
           
            $responseBodyAsString = $resetpassword->getBody()->getContents();
            
            $responseBodyAsString = json_decode($responseBodyAsString,true);
            //    dd($responseBodyAsString);
            return back()->with('error', $responseBodyAsString['message']);
        }catch (\Throwable $th) {
           
            $throw = $th->getResponse();
            $responseBodyAsString = $throw->getBody()->getContents();
            $responseBodyAsString = json_decode($responseBodyAsString,true);
           
            return back()->with('error',  $responseBodyAsString['message']);
		}
    }
}
