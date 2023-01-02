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
       if(session::has('user')){
            return redirect()->route('dashboard');
        } elseif(Session::has('griffin_user')) {
            return redirect()->route('home'); 
        }else{
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
          

            $newuser = $client->request('POST', 'https://exceledunet.com/wordpress2/wp-json/jwt-auth/v1/token', [
            
                'form_params' => [
                    'username' => 'admin2',
                    'password' => 'admin2@3338',
                ]
            ]);
            $second_token = $newuser->getBody()->getContents();
            $second_token= json_decode($second_token,true);
          

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
                
                $role= "customer";
               
               
                $exisiting = $client->request('GET', 'https://exceledunet.com/wordpress2/wp-json/wp/v2/users?search='.$request->email .'&roles='.$role, ['headers' => 
                [
                    'Authorization' => "Bearer {$second_token['data']['token']}"
                ]
                ]);
    
                $existinguser= $exisiting->getBody()->getContents();
                $existinguser = json_decode($existinguser, true);
                // echo"<pre>";
                // print_r($existinguser);
                // die; 
               
                if($user['roles']['0']=="customer"){
                    $request->session()->regenerate();
                    $request->session()->put('user_credentials', $credentials);
                    if(!empty($existinguser)){
                        $request->session()->put("existing_user", $existinguser);
                        $request->session()->put("whisker_token", $second_token['data']['token']);
                    }
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

            return redirect()->route('login');
        }
        if ($request->session()->has('two')) {
         
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('griffin');
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

            $newuser = $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/jwt-auth/v1/token', [
            
                'form_params' => [
                    'username' => 'admin',
                    'password' => 'admin@3338',
                ]
            ]);
            $second_token = $newuser->getBody()->getContents();
            $second_token= json_decode($second_token,true);
           
            if ($result1['message'] == "Token is valid") {
                $role= "customer";
                $exisiting = $client->request('GET', 'https://exceledunet.com/wordpress/wp-json/wp/v2/users?search='.$request->email.'&roles='.$role, ['headers' => 
                [
                    'Authorization' => "Bearer {$second_token['data']['token']}"
                ]
                ]);
    
                $existinguser= $exisiting->getBody()->getContents();
                $existinguser = json_decode($existinguser, true);    
                // dd($existinguser);   
              
                $response3 =  $client->request('POST', 'https://exceledunet.com/wordpress2/wp-json/wp/v2/users/'.$result['data']['id'], [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$result['data']['token']}"
                    ],
                ]);
            
                $user = $response3->getBody()->getContents();

                $user= json_decode($user,true);
             
                // dd($user);
                if($user['roles']['0']=='customer'){

                    $request->session()->regenerate();
                    $request->session()->put('griffin_user', $user);
                    $request->session()->put('token', $result['data']);
                    $request->session()->put('user_credentials', $credentials);
                    // dd( $second_token['data']['token']);
                    if(!empty($existinguser)){
                        $request->session()->put("existing_user", $existinguser);
                        $request->session()->put("whisker_token", $second_token['data']['token']);
                    }
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
        try {
           
            if(Session::has('one') && Session::has('user') && Session::has('token')){
        
                $credentials = $request->validate([
                    'email' => ['required'],
                    'firstname' => ['required'],
                    'lastname'=>['required'],

                ]); 
               
                $clientObj = new \GuzzleHttp\Client();

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
                            'email'=>$request->email,
                            'description'=>$request->description,
                        ]
                    ]);
                
                    $user = $userobj ->getBody()->getContents();

                    $user= json_decode($user,true);
                    $request->session()->put('user', $user);

                     
                    $whishkerUser = Session::get('user');
                   
                    if(Session::has('existing_user') && Session::has('whisker_token')){
                        $griffinuser = Session::get('existing_user');
                        
                        $user_id = 0;
                        if (isset($griffinuser['0']['id'])) {
                            $user_id = $griffinuser['0']['id'];
                        }else{
                            $user_id = $griffinuser['id'];
                        }
                        

                        $tokenGriffin = Session::get('whisker_token');
                       
                    
                        $griffinobj =  $clientObj->request('POST', 'https://exceledunet.com/wordpress2/wp-json/wp/v2/users/'.$user_id, [
                            'headers' =>
                            [
                                'Authorization' => "Bearer {$tokenGriffin}"
                            ],'form_params' => [
                                
                                'email'=>$request->email,
                                
                            ]
                        ]);
                    
                        $griffin = $griffinobj ->getBody()->getContents();
                    
                    }

                   

                    return redirect()->route('profile')->with('succes', "User profile updated successfully..!");
                    
                } 
            }else{
                throw new \Exception("You Need to Login First", 401);
                
            }
        }catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();

            $responseBodyAsString = json_decode($responseBodyAsString,true);
        
            return back()->with('error', $responseBodyAsString['message']);
        }
        catch (\Throwable $th) {
            return redirect()->route('login')->with('error',  $th->getMessage());
           
        }
        
    }
    

    public function getGriffinProfile(Request $request){
      
        if(Session::has('two') && Session::has('griffin_user') && Session::has('token')){

            $data['user'] = Session::get('griffin_user');
            $data['token'] = Session::get('token');   
        
            return view('pages.griffin-user-profile',['user'=>$data]);
            
        }else{
            return redirect()->route('griffin')->with('error','You Need to Login First');
        }
    }

    public function updateGriffinProfile(Request $request){
        try {
        
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
                            'email'=>$request->email,
                            'description'=>$request->description,
                        ]
                    ]);
                
                    $user = $userobj ->getBody()->getContents();
                   
                
                    if(Session::has('existing_user') && Session::has('whisker_token')){
                   
                        $whiskeruser = Session::get('existing_user');
                       
                        $token = Session::get('whisker_token');
                        $user_id = 0;
                        if (isset($whiskeruser['0']['id'])) {
                            $user_id = $whiskeruser['0']['id'];
                        }else{
                            $user_id = $whiskeruser['id'];
                        }
                        
                     
                        $whiskerobj =  $clientObj->request('POST', 'https://exceledunet.com/wordpress/wp-json/wp/v2/users/'.$user_id, [
                            'headers' =>
                            [
                                'Authorization' => "Bearer {$token}"
                            ],'form_params' => [
                                'email'=>$request->email, 
                            ]
                        ]);
                    
                        $whisker = $whiskerobj ->getBody()->getContents();
                       
                    }
                    $user= json_decode($user,true);
                  
                    $request->session()->put('griffin_user', $user);

                    return redirect()->route('griffin-profile')->with('succes', "User profile updated successfully..!");
                    
                } 
            }else{
                throw new \Exception("You Need to Login First", 401);
            }
        }catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();

            $responseBodyAsString = json_decode($responseBodyAsString,true);
        
            return back()->with('error', $responseBodyAsString['message']);
        }
        catch (\Throwable $th) {
            return redirect()->route('griffin')->with('error',  $th->getMessage());
           
        }
    }

    public function switchToGriffin(Request $request){
        try {
            // dd(Session::all());
            if($request->session()->has('user')){
                $credentials = $request->session()->get('user_credentials');
                
                $userr1 = Session::get('user');
             
                $user22 = Session::get('existing_user');
              
                $user_id = 0;
                if (isset($user22['0']['id'])) {
                    $user_id = $user22['0']['id'];
                }else{
                    $user_id = $user22['id'];
                }
                $client = new \GuzzleHttp\Client();
         
                $response = $client->request('POST', 'https://exceledunet.com/wordpress2/wp-json/jwt-auth/v1/token', [
            
                    'form_params' => [
                        'username' => 'admin2',
                        'password' => 'admin2@3338',
                    ]
                ]);

                $result = $response->getBody()->getContents();
                $result = json_decode($result,true);
                // dd($result);
                $response2 = $client->request('POST', 'https://exceledunet.com/wordpress2/wp-json/jwt-auth/v1/token/validate', [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$result['data']['token']}"
                    ]
                ]);

                $result1 = $response2->getBody()->getContents();
                $result1 = json_decode($result1,true);
              
            
                if ($result1['message'] == "Token is valid") {
                
                    $response3 =  $client->request('POST', 'https://exceledunet.com/wordpress2/wp-json/wp/v2/users/'.$user_id, [
                        'headers' =>
                        [
                            'Authorization' => "Bearer {$result['data']['token']}"
                        ],
                    ]);
                
                    $user = $response3->getBody()->getContents();
                   
                    $user= json_decode($user,true);
                  
                    if($user['roles']['0']=='customer'){
                        $token1= Session::get('token');
                        $credentials = Session::get('user_credentials');
                        $request->session()->flush();
                      
                        $request->session()->put('user_credentials', $credentials);
                        $request->session()->put('whisker_token', $token1['token']);
                        $request->session()->put('existing_user', $userr1);
                        $request->session()->put('griffin_user', $user);
                        $request->session()->put('token', $result['data']);
                        $request->session()->put('two', "Griffin Rock CAT Retreat - Your Cat's Vacation oasis");
                        return redirect()->intended('griffin-dashboard');
                    }else{
                        throw new \Exception("user is not a customer", 401);
                    }   
                
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

    public function switchToWhisker(Request $request){
        try {
            if($request->session()->has('griffin_user')){
                $credentials = $request->session()->get('user_credentials');
                $userr1 = Session::get('griffin_user');
                // dd($userr1);
                $user22 = Session::get('existing_user');
              
                $user_id = 0;
                if (isset($user22['0']['id'])) {
                    $user_id = $user22['0']['id'];
                }else{
                    $user_id = $user22['id'];
                }
                $client = new \GuzzleHttp\Client();
            
                $response = $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/jwt-auth/v1/token', [
            
                    'form_params' => [
                        'username' => 'admin',
                        'password' => 'admin@3338',
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
                    $response3 =  $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/wp/v2/users/'.$user_id, [
                        'headers' =>
                        [
                            'Authorization' => "Bearer {$result['data']['token']}"
                        ],
                    ]);
                
                    $user = $response3->getBody()->getContents();
                    $user= json_decode($user,true);
                    // dd($userr1, $user, $result);
                    if($user['roles']['0']=='customer'){
                        $token1= Session::get('token');
                        $credentials = Session::get('user_credentials');
                        $request->session()->flush();
                      
                        $request->session()->put('user_credentials', $credentials);
                        $request->session()->put('whisker_token', $token1['token']);
                        $request->session()->put('existing_user', $userr1);
                        $request->session()->put('user', $user);
                        $request->session()->put('token', $result['data']);
                        $request->session()->put('one', "Whisker And Soda - Where Cats and Relax Collide");
                       
                        return redirect()->intended('dashboard');
                    }else{
                        throw new \Exception("user is not a customer", 401);
                    }
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
