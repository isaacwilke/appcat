<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function login(Request $request)
    {
      
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
      
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/api/v1/token', [
           
            'form_params' => [
                'username' => $request->email,
                'password' => $request->password,
            ]
        ]);

      

        $result = $response->getBody()->getContents();
        $result = json_decode($result);
      
     
        
            $client = new \GuzzleHttp\Client();
            $response2 = $client->request('GET', 'https://exceledunet.com/wordpress/wp-json/api/v1/token-validate', [
                'headers' =>
                [
                    'Authorization' => "Bearer {$result->jwt_token}"
                ]
            ]);
    
            $result1 = $response2->getBody()->getContents();
            $result1 = json_decode($result1);
            if ($result1->message == "VALID_TOKEN") {
                // Post api
                // $client = new \GuzzleHttp\Client();
                // $response = $client->request('GET', 'https://exceledunet.com/wordpress/wp-json/wp/v2/posts', ['headers' => 
                //     [
                //         'Authorization' => "Bearer {$result->jwt_token}"
                //     ],'form_params' => [
                //         'username' => 'admin',
                //         'password' => 'admin@3338',
                //     ]
                // ]);
    
                // $result2= $response->getBody()->getContents();
                $client = new \GuzzleHttp\Client();
                $response3 = $client->request('GET', 'https://exceledunet.com/wordpress/wp-json/wp/v2/users?search='.$request->email, [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$result->jwt_token}"
                    ],
                ]);
              
                $user = $response3->getBody()->getContents();
                $user = json_decode($user);
                if($user[0]->slug=='customera'){
                    $request->session()->regenerate();
                    if($request->site=="Whisker And Soda - Where Cats and Relax Collide"){
                        $request->session()->put('one', $request->site);
                    }
                        // dd($user[0]);
               
                        return response()->json([
                            'status' => 'success',
                            'user' => $user[0],
                            'authorisation' => [
                                'token' => $result->jwt_token,
                                'type' => 'bearer',
                            ]
                        ]);
                    // return redirect()->route('dashboard');
               }
            }
        }
       

       

    

    }


