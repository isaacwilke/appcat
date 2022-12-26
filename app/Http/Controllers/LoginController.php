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

            // $newuser = $client->request('POST', 'https://exceledunet.com/wordpress2/wp-json/jwt-auth/v1/token', [
            
            //     'form_params' => [
            //         'username' => $credentials['email'],
            //         'password' => $credentials['password'],
            //     ]
            // ]);
            // $second_token = $newuser->getBody()->getContents();
            // $second_token= json_decode($second_token,true);

            $response2 = $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/jwt-auth/v1/token/validate', [
                'headers' =>
                [
                    'Authorization' => "Bearer {$result['data']['token']}"
                ]
            ]);

            $result1 = $response2->getBody()->getContents();
            $result1 = json_decode($result1,true);
          
            if ($result1['message'] == "Token is valid") {
               
                $response = $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/wp/v2/users/'.$result['data']['id'], ['headers' => 
                [
                    'Authorization' => "Bearer {$result['data']['token']}"
                ]
                ]);
    
                $result2= $response->getBody()->getContents();
                $user = json_decode($result2, true);
                
                // $exisiting = $client->request('POST', 'https://exceledunet.com/wordpress2/wp-json/wp/v2/users/'.$second_token['data']['id'], ['headers' => 
                // [
                //     'Authorization' => "Bearer {$second_token['data']['token']}"
                // ]
                // ]);
    
                // $existinguser= $exisiting->getBody()->getContents();
                // $existinguser = json_decode($existinguser, true);
                //   dd($existinguser);            
                if($user['roles']['0']=="customer"){
                    $request->session()->regenerate();
                    $request->session()->put('user_credentials', $credentials);
                    $request->session()->put('user', $user);
                    // $request->session()->put('existing_user', $existinguser);
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
        // dd($request->all());
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]); 
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', 'https://exceledunet.com/wordpress2/wp-json/jwt-auth/v1/token', [
          
                'form_params' => [
                    'username' => $request->email,
                    'password' => $request->password,
                ]
            ]);

            $result = $response->getBody()->getContents();

            $result = json_decode($result,true);
        
       
            $response2 = $client->request('POST', 'https://exceledunet.com/wordpress2/wp-json/jwt-auth/v1/token/validate', [
                'headers' =>
                [
                    'Authorization' => "Bearer {$result['data']['token']}"
                ]
            ]);

            $result1 = $response2->getBody()->getContents();
            $result1 = json_decode($result1,true);
           
            if ($result1['message'] == "Token is valid") {
               
                $response3 =  $client->request('POST', 'https://exceledunet.com/wordpress2/wp-json/wp/v2/users/'.$result['data']['id'], [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$result['data']['token']}"
                    ],
                ]);
            
                $user = $response3->getBody()->getContents();

                $user= json_decode($user,true);
             
                
                if($user['roles']['0']=='customer'){

                    $request->session()->regenerate();
                     $request->session()->put('griffin_user', $user);
                    $request->session()->put('token', $result['data']);
                    $request->session()->put('user_credentials', $credentials);
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
  
    public function getProfile(Request $request){
        
        if(Session::has('one')||Session::has('user') && Session::has('token')){

            $data['user'] = Session::get('user');
            $data['token'] = Session::get('token');
        
            return view('pages.user-profile',['user'=>$data]);
            
        }else{
            return redirect()->route('login')->with('error','You Need to Login First');
        }
    }


    public function updateProfile(Request $request){
       
        if(Session::has('one') && Session::has('user') && Session::has('token')){
       
            $credentials = $request->validate([
                'email' => ['required'],
                'firstname' => ['required'],
                'lastname'=>['required'],

            ]); 
            $clientObj = new \GuzzleHttp\Client();

            // 
            $tokenvalid = $clientObj->request('POST', 'https://exceledunet.com/wordpress/wp-json/jwt-auth/v1/token/validate', [
                'headers' =>
                [
                    'Authorization' => "Bearer {$request->auth_token}"
                ]
            ]);

            $tokenvalid = $tokenvalid->getBody()->getContents();
            
            $tokenvalid = json_decode($tokenvalid,true);
            if($tokenvalid['message']=="Token is valid"){
                $userobj =  $clientObj->request('POST', 'https://exceledunet.com/wordpress/wp-json/wp/v2/users/'.$request->id, [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$request->auth_token}"
                    ],'form_params' => [
                        'username' => $request->username,
                        'first_name' =>$request->firstname,
                        'last_name'=>$request->lastname,
                        'description'=>$request->description,
                    ]
                ]);
            
                $user = $userobj ->getBody()->getContents();

                $user= json_decode($user,true);
                $request->session()->put('user', $user);

                return redirect()->route('profile')->with('succes', "User profile updated successfully..!");
                
            } 
        }else{
            return redirect()->route('login')->with('error','You Need to Login First');
        }
        
    }
    

    public function getGriffinProfile(Request $request){
      
        if(Session::has('two') && Session::has('griffin_user') && Session::has('token')){

            $data['user'] = Session::get('griffin_user');
            $data['token'] = Session::get('token');   
            return view('pages.griffin-user-profile',['user'=>$data]);
            
        }else{
            return redirect()->route('login1')->with('error','You Need to Login First');
        }
    }

    public function updateGriffinProfile(Request $request){
       
        if(Session::has('two') && Session::has('griffin_user') && Session::has('token')){
       
            $credentials = $request->validate([
                'email' => ['required'],
                'firstname' => ['required'],
                'lastname'=>['required'],

            ]); 
            $clientObj = new \GuzzleHttp\Client();

            // 
            $tokenvalid = $clientObj->request('POST', 'https://exceledunet.com/wordpress2/wp-json/jwt-auth/v1/token/validate', [
                'headers' =>
                [
                    'Authorization' => "Bearer {$request->auth_token}"
                ]
            ]);

            $tokenvalid = $tokenvalid->getBody()->getContents();
            
            $tokenvalid = json_decode($tokenvalid,true);
            
            if($tokenvalid['message']=="Token is valid"){
                $userobj =  $clientObj->request('POST', 'https://exceledunet.com/wordpress2/wp-json/wp/v2/users/'.$request->id, [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$request->auth_token}"
                    ],'form_params' => [
                        'username' => $request->username,
                        'first_name' =>$request->firstname,
                        'last_name'=>$request->lastname,
                        'description'=>$request->description,
                    ]
                ]);
            
                $user = $userobj ->getBody()->getContents();

                $user= json_decode($user,true);
                $request->session()->put('griffin_user', $user);

                return redirect()->route('griffin-profile')->with('succes', "User profile updated successfully..!");
                
            } 
        }else{
            return redirect()->route('login1')->with('error','You Need to Login First');
        }
        
    }

    public function switchToGriffin(Request $request){
        if($request->session()->has('user')){
            $credentials = $request->session()->get('user_credentials');
            $client = new \GuzzleHttp\Client();
            try {
                $response = $client->request('POST', 'https://exceledunet.com/wordpress2/wp-json/jwt-auth/v1/token', [
            
                    'form_params' => [
                        'username' => $credentials['email'],
                        'password' => $credentials['password'],
                    ]
                ]);
                $result = $response->getBody()->getContents();
                $result = json_decode($result,true);
            
                $response2 = $client->request('POST', 'https://exceledunet.com/wordpress2/wp-json/jwt-auth/v1/token/validate', [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$result['data']['token']}"
                    ]
                ]);

                $result1 = $response2->getBody()->getContents();
                $result1 = json_decode($result1,true);
            
                if ($result1['message'] == "Token is valid") {
                
                    $response3 =  $client->request('POST', 'https://exceledunet.com/wordpress2/wp-json/wp/v2/users/'.$result['data']['id'], [
                        'headers' =>
                        [
                            'Authorization' => "Bearer {$result['data']['token']}"
                        ],
                    ]);
                
                    $user = $response3->getBody()->getContents();
                    $user= json_decode($user,true);
                
                    if($user['roles']['0']=='customer'){
                        $request->session()->forget(['one','user','token']);
                       
                        
                        $request->session()->put('griffin_user', $user);
                        $request->session()->put('token', $result['data']);
                        $request->session()->put('two', "Griffin Rock CAT Retreat - Your Cat's Vacation oasis");
                        return redirect()->intended('griffin-dashboard');
                    }else{
                        throw new \Exception("user is not a customer", 401);
                    }   
                
                }
            }catch (\GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $responseBodyAsString = json_decode($responseBodyAsString,true);
                return back()->with('error', $responseBodyAsString['message']);
            }
            catch (\Throwable $th) {
                return back()->with('error',  $th->getMessage());
            }
        }
    }

    public function switchToWhisker(Request $request){
         
        if($request->session()->has('griffin_user')){
            $credentials = $request->session()->get('user_credentials');
            // dd($credentials);
            $client = new \GuzzleHttp\Client();
            try {
                $response = $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/jwt-auth/v1/token', [
            
                    'form_params' => [
                        'username' => $credentials['email'],
                        'password' => $credentials['password'],
                    ]
                ]);

                $result = $response->getBody()->getContents();

                $result = json_decode($result,true);
            
        
                $response2 = $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/jwt-auth/v1/token/validate', [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$result['data']['token']}"
                    ]
                ]);

                $result1 = $response2->getBody()->getContents();
                $result1 = json_decode($result1,true);
            
                if ($result1['message'] == "Token is valid") {
                    $response3 =  $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/wp/v2/users/'.$result['data']['id'], [
                        'headers' =>
                        [
                            'Authorization' => "Bearer {$result['data']['token']}"
                        ],
                    ]);
                
                    $user = $response3->getBody()->getContents();
                    $user= json_decode($user,true);
                    if($user['roles']['0']=='customer'){
                      
                        $request->session()->forget(['two','griffin_user','token']);
                        $request->session()->put('user', $user);
                        $request->session()->put('token', $result['data']);
                        $request->session()->put('one', "Whisker And Soda - Where Cats and Relax Collide");
                       
                        return redirect()->intended('dashboard');
                    }else{
                        throw new \Exception("user is not a customer", 401);
                    }
                }
            }catch (\GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $responseBodyAsString = json_decode($responseBodyAsString,true);
                return back()->with('error', $responseBodyAsString['message']);
            }
            catch (\Throwable $th) {
                return back()->with('error',  $th->getMessage());
            }
        }
    }
}
