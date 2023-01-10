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


class ChangePasswordController extends Controller
{

    public function griffinDisplayPassword()
    {
    
        return view('auth.griffin-change-password');
    }

    public function griffinSetPassword(Request $request)
    {
        
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
           
            $codevalidate = $client->request('POST',Config::get('constants.griffin.url.reset_validate'), [
                'headers' =>
                [
                    'Authorization' => "Bearer {$validtoken['data']['token']}"
                ],
                'form_params' => [
                    'email' => $request->email,
                    'code' => $request->code
                ]
            ]);
            $validcode = $codevalidate->getBody()->getContents();
            $validcode= json_decode($validcode,true);
            if($validcode['message']=='The code supplied is valid.'){
                $setpassword = $client->request('POST', Config::get('constants.griffin.url.set_password'), [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$validtoken['data']['token']}"
                    ],'form_params' => [
                        'email' => $request->email,
                        'password'=>$request->password,
                        'code'=>$request->code
                    ]
                ]);
                       
                $setpassword = $setpassword->getBody()->getContents();
                $setpassword = json_decode($setpassword,true);
                return redirect()->route('griffin')->with('succes', $setpassword['message']);
            }
            
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
           
            return redirect()->route('griffin.reset')->with('error',  $responseBodyAsString['message']);
		}
        // return redirect()->route('login')->with('succes', 'Your password has been changed!');
       
    }

    public function whiskerDisplayPassword()
    {
    
        return view('auth.change-password');
    }
    public function whiskerSetPassword(Request $request)
    {
        
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
           
            $codevalidate = $client->request('POST',Config::get('constants.whisker.url.reset_validate'), [
                'headers' =>
                [
                    'Authorization' => "Bearer {$validtoken['data']['token']}"
                ],
                'form_params' => [
                    'email' => $request->email,
                    'code' => $request->code,
                ]
            ]);
            $validcode = $codevalidate->getBody()->getContents();
            $validcode= json_decode($validcode,true);
            if($validcode['message']=='The code supplied is valid.'){
                $setpassword = $client->request('POST', Config::get('constants.whisker.url.set_password'), [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$validtoken['data']['token']}"
                    ],'form_params' => [
                        'email' => $request->email,
                        'password'=>$request->password,
                        'code'=>$request->code
                    ]
                ]);
                       
                $setpassword = $setpassword->getBody()->getContents();
                $setpassword = json_decode($setpassword,true);
                return redirect()->route('login')->with('succes', $setpassword['message']);
            }
            
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
           
            return redirect()->route('whisker.reset')->with('error',  $responseBodyAsString['message']);
		}
        
       
    }
}
