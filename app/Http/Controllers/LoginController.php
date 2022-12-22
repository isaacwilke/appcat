<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\Post;
use App\Models\User;
use App\Models\UserWhiskey;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        if (Auth::user()) {
            return redirect()->route('dashboard');
        } else {
            return view('auth.login');
        }
    }

    public function login(Request $request)
    {
        
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $client = new \GuzzleHttp\Client();

        try {
        
            $response = $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/jwt-auth/v1/token', [
                'form_params' => [
                    'username' => $request->email,
                    'password' => $request->password,
                ]
            ]);
        
            $result = $response->getBody()->getContents();
                
            $result = json_decode($result,true);
            // dd($result['data']['token']);
            $response2 = $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/jwt-auth/v1/token/validate', [
                'headers' =>
                [
                    'Authorization' => "Bearer {$result['data']['token']}"
                ]
            ]);

            $result1 = $response2->getBody()->getContents();
            $result1 = json_decode($result1,true);
          
            if ($result1['message'] == "Token is valid") {
               
               /*
                $response = $client->request('GET', 'https://exceledunet.com/wordpress/wp-json/wp/v2/posts', ['headers' => 
                [
                    'Authorization' => "Bearer {$result->data->token}"
                ]
                ]);
    
                $result2= $response->getBody()->getContents();
                dd(json_decode($result2));
                
               */

                //$decoded_json = json_decode($user);
                // dd($decoded_json);
                $response = $client->request('GET', 'https://exceledunet.com/wordpress/wp-json/wp/v2/users/'.$result['data']['id'], ['headers' => 
                [
                    'Authorization' => "Bearer {$result['data']['token']}"
                ]
                ]);
    
                $result2= $response->getBody()->getContents();
                $user = json_decode($result2, true);
                //dd($result);                
                if($user['is_super_admin']==false){
                    $request->session()->regenerate();
                    $request->session()->put('user', $user);
                    $request->session()->put('token', $result['data']);
                  
                    if($request->site=="Whisker And Soda - Where Cats and Relax Collide"){
                        $request->session()->put('one', $request->site);
                    }
                
                    return redirect()->route('dashboard');
                }else{	
                    throw new \Exception("user is not a customer", 401);
                   
                }
                   
            
            }

        }catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
    
            $responseBodyAsString = json_decode($responseBodyAsString,true);
            //    dd($responseBodyAsString);
            return back()->with('error', $responseBodyAsString['message']);
        }
         catch (\Throwable $th) {
            return back()->with('error',  $th->getMessage());
		}
    }


    public function logout(Request $request)
    {
        if ($request->session()->has('one')) {
            
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login');
        }
        if ($request->session()->has('two')) {
         
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login1');
        }
    }

    public function api()
    {
        return view('api');
    }

    public function updateapi(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            if ($request->site == "Whisker And Soda - Where Cats and Relax Collide") {
                $request->session()->put('one', $request->site);
            }
            return redirect()->intended('dashboard');
        }
    }

    public function Display()
    {
        return view('auth.login1');
    }
    public function store(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]); 
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/jwt-auth/v1/token', [
                'form_params' => [
                    'username' => $request->email,
                    'password' => $request->password,
                ]
            ]);

            $result = $response->getBody()->getContents();

            $result = json_decode($result);
           
       
            $response2 = $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/jwt-auth/v1/token/validate', [
                'headers' =>
                [
                    'Authorization' => "Bearer {$result->data->token}"
                ]
            ]);

            $result1 = $response2->getBody()->getContents();
            $result1 = json_decode($result1);
            // dd($result1);
            if ($result1->message == "Token is valid") {
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
            
                $response3 =  $client->request('GET', 'https://exceledunet.com/wordpress/wp-json/wp/v2/users/'.$result->data->id, [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$result->data->token}"
                    ],
                ]);
            
                $user = $response3->getBody()->getContents();

                $user= json_decode($user);
                
                
                if($user->is_super_admin==false){
                   
                    $request->session()->regenerate();
                        $request->session()->put('griffin_user', $user);
                    $request->session()->put('token', $result->data->token);
                    
                    if ($request->site == "Griffin Rock CAT Retreat - Your Cat's Vacation oasis") {
                        $request->session()->put('two', $request->site);
                    } 
                
                    return redirect()->intended('griffin-dashboard');
                }else{
                    throw new \Exception("user is not a customer", 401);
                }
                
            
            }
        }catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
    
            $responseBodyAsString = json_decode($responseBodyAsString,true);
            //    dd($responseBodyAsString);
            return back()->with('error', $responseBodyAsString['message']);
        }
        catch (\Throwable $th) {
            return back()->with('error',  $th->getMessage());
        }
    }
    public function demo()
    {
        $posts = User::all();


        return view('posts.index', ["posts" => $posts]);
    }
    public function demo1()
    {
        $posts = UserWhiskey::all();


        return view('posts.index1', ["posts" => $posts]);

        // $client = new \GuzzleHttp\Client();
        // $request = $client->get('https://exceledunet.com/wordpress/wp-json/api/v1/token');
        // $response = $request->getBody();

        // dd($response);
    }
    public function getProfile(Request $request){
     
        if(Session::has('user') && Session::has('token')){

            $data['user'] = Session::get('user');
            $data['token'] = Session::get('token');
           
            $clientObj = new \GuzzleHttp\Client();
            try{
                $tokenvalid = $clientObj->request('POST', 'https://exceledunet.com/wordpress/wp-json/jwt-auth/v1/token/validate', [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$data['token']['token']}"
                    ]
                ]);
    
                $tokenvalid = $tokenvalid->getBody()->getContents();
                $tokenvalid = json_decode($tokenvalid,true);
                if($tokenvalid['message']=="Token is valid"){
                    $userobj =  $clientObj->request('GET', 'https://exceledunet.com/wordpress/wp-json/wp/v2/users/'.$data['user']['id'], [
                        'headers' =>
                        [
                            'Authorization' => "Bearer {$data['token']['token']}"
                        ],
                    ]);
                
                    $user = $userobj ->getBody()->getContents();
    
                    $user= json_decode($user,true);
                  
                    return view('pages.user-profile',['user'=>$data]);
                }
            }catch(\Throwable $th){
                // dd($th->getMessage());
            }
            
         
        }else{
            return redirect()->route('login');
        }
    }
}
