<?php

namespace App\Http\Controllers;
use DB;
use Mail; 
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


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
            $token = $client->request('POST', 'https://exceledunet.com/wordpress2/wp-json/jwt-auth/v1/token', [
              
                'form_params' => [
                    'username' => 'admin2',
                    'password' => 'admin2@3338',
                ]
            ]);
            $validtoken = $token->getBody()->getContents();
            $validtoken= json_decode($validtoken,true);
           
            $codevalidate = $client->request('POST', 'https://exceledunet.com/wordpress2/wp-json/bdpwr/v1/validate-code', [
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
                $setpassword = $client->request('POST', 'https://exceledunet.com/wordpress2/wp-json/bdpwr/v1/set-password', [
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
            $token = $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/jwt-auth/v1/token', [
              
                'form_params' => [
                    'username' => 'admin',
                    'password' => 'admin@3338',
                ]
            ]);
            $validtoken = $token->getBody()->getContents();
            $validtoken= json_decode($validtoken,true);
           
            $codevalidate = $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/bdpwr/v1/validate-code', [
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
                $setpassword = $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/bdpwr/v1/set-password', [
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
