<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

use App\Helpers\Helper;



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
        
        $data= [
            'username'=>$request->email,
            'password'=>$request->password,
        ];

        $method = "POST";

        $url = Config::get('constants.whisker.url.token');
        // for getting token from whisker site
        $result = Helper::PostRequest($data,$method,$url,$token="");
       
        if($result['success']==false){
           return back()->with('error', $result['message']);
        }
        
        // $data=[
        //     'username' => Config::get('constants.griffin.admin.username'),
        //     'password' => Config::get('constants.griffin.admin.password'),
        // ];

        // $url = Config::get('constants.griffin.url.token'); 
        
        // //for getting token from griffin site
        // $second_token = Helper::PostRequest($data,$method,$url,$token="");
        // if($second_token['success']==false){
        //     return back()->with('error', $second_token['message']); 
        // }
        $url = Config::get('constants.whisker.url.token_validate');
        
        $token=$result['data']['token'];
        
        //Checking token is valid or not
        $result1= Helper::PostRequest($data="",$method,$url,$token);
       
        if ($result1['message'] == "Token is valid") {
            
            $url= Config::get('constants.whisker.url.get_user').$result['data']['id'];
            $method = "POST";
            $token=$result['data']['token'];
            
            // get user of whisker site
            $user = Helper::PostRequest($data="",$method,$url,$token); 
             
            $role= "armember";
            
            // $method = "GET";
            // // $token = $second_token['data']['token'];

            // //get user of griffin site
            // $url =Config::get('constants.griffin.url.search_user').$request->email .'&roles='.$role;
             
            // $existinguser=Helper::PostRequest($data="",$method,$url,$token); 
             
            if(in_array("armember", $user['roles'])){
                $request->session()->regenerate();
                $request->session()->put('user_credentials', $credentials);
                // if(!empty($existinguser)){
                    
                //     $request->session()->put("existing_user", $existinguser);
                //     $request->session()->put("whisker_token", $second_token['data']['token']);
                // }
                $request->session()->put('user', $user);
                
                $request->session()->put('token', $result['data']);
                
                if($request->site=="Whisker And Soda - Where Cats and Relax Collide"){
                    $request->session()->put('one', $request->site);
                }
            
                return redirect()->route('dashboard');
            }else{	
                return redirect()->route('login')->with('error',  "user is not a ar member");
                
            }
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
        return view('auth.Login1');
    }
    public function store(Request $request)
    {
        
       
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]); 

        $method = 'POST';

        $data = [
            'username' => $request->email,
            'password' => $request->password, 
        ];

        $url =  Config::get('constants.griffin.url.token');
        // Getting token of griffin site
        $result = Helper::PostRequest($data, $method, $url, $token="");

        if($result['success']==false){
            return back()->with('error', $result['message']);
        }
        
        $token=$result['data']['token'];
        $url =Config::get('constants.griffin.url.token_validate');
        // checking token valid or not
        $result1 = Helper::PostRequest($data='', $method, $url, $token);

        $data =[
            'username' => Config::get('constants.whisker.admin.username'),
            'password' => Config::get('constants.whisker.admin.password'),
        ];
        $url =  Config::get('constants.whisker.url.token');

        // getting token for whisker site
        $second_token = Helper::PostRequest($data, $method, $url, $token=''); 
        if($second_token['success']==false){
            return back()->with('error', $second_token['message']); 
        }
          
        if ($result1['message'] == "Token is valid") {  
            $method = 'GET';
            $role= "customer";
            $url = Config::get('constants.whisker.url.search_user').$request->email.'&roles='.$role;
            $token =$second_token['data']['token'];
            // getting user of whisker site
            $existinguser= Helper::PostRequest($data='', $method, $url, $token);  
                 
            $method = 'POST';
            $url =   Config::get('constants.griffin.url.get_user').$result['data']['id'];
            $token = $result['data']['token'];

            // getting user of griffin site
            $user= Helper::PostRequest($data='', $method, $url, $token);
            
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
                return redirect()->route('griffin')->with('error',  "user is not a customer");
                
            } 
            
        }
       
    }
  
    public function getProfile(Request $request){
        
        if(Session::has('one') && Session::has('user') && Session::has('token')){

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

            $url =  Config::get('constants.whisker.url.token_validate');
            $token= $request->auth_token;
            $method ="POST";
            // Checking token valid or not
            $tokenvalid = Helper::PostRequest($data='', $method, $url, $token);
            if($tokenvalid['success']==false){
                return back()->with('error', $tokenvalid['message']); 
                
            }
            if($tokenvalid['message']=="Token is valid"){
                $url = Config::get('constants.whisker.url.get_user').$request->id;
                $method = "POST";
                $token = $request->auth_token;
                $data = [
                    'username' => !empty($request->username)?$request->username:'',
                    'first_name' =>!empty($request->firstname)?$request->firstname :'',
                    'last_name'=>!empty($request->lastname)?$request->lastname:"",
                    'email'=>!empty($request->email)?$request->email:'',
                    'description'=>!empty($request->description)?$request->description:'',
                ];

                // Update user details of whisker site
                $user = Helper::PostRequest($data, $method, $url, $token);
              
                
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
                    $url =Config::get('constants.griffin.url.get_user').$user_id;
                    $method ="POST";
                    $data =[
                        'email'=>$request->email,
                    ];
                    $token = $tokenGriffin;
                    
                    // update existing user email
                    $griffin = Helper::PostRequest($data, $method, $url, $token); 
                
                }
                return redirect()->route('profile')->with('succes', "User profile updated successfully..!");  
            } 
        }else{
            return redirect()->route('login')->with('error',"You Need to Login First");
            
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
      
        
        if(Session::has('two') && Session::has('griffin_user') && Session::has('token')){
            
            $credentials = $request->validate([
                'email' => ['required'],
                'firstname' => ['required'],
                'lastname'=>['required'],

            ]); 
            
          

            //
            $token= $request->auth_token;
            $method ='POST';
            $url = Config::get('constants.griffin.url.token_validate');
            
            $tokenvalid= Helper::PostRequest($data='', $method, $url, $token);
            if($tokenvalid['success']==false){
                return back()->with('error', $tokenvalid['message']); 

            }

            if($tokenvalid['message']=="Token is valid"){

                $method="POST";
                $url = Config::get('constants.griffin.url.get_user').$request->id;
                $token = $request->auth_token;
                $data = [
                    'username' => !empty($request->username)?$request->username:'',
                    'first_name' =>!empty($request->firstname)?$request->firstname :'',
                    'last_name'=>!empty($request->lastname)?$request->lastname:"",
                    'email'=>!empty($request->email)?$request->email:'',
                    'description'=>!empty($request->description)?$request->description:'',
                ];
                // update user record
                $user= Helper::PostRequest($data, $method, $url, $token);
                
                
                if(Session::has('existing_user') && Session::has('whisker_token')){
                
                    $whiskeruser = Session::get('existing_user');
                    
                    $token = Session::get('whisker_token');
                    $user_id = 0;
                    if (isset($whiskeruser['0']['id'])) {
                        $user_id = $whiskeruser['0']['id'];
                    }else{
                        $user_id = $whiskeruser['id'];
                    }
                    
                    $data = [
                        'email'=>$request->email, 
                    ];

                    $method ="POST";
                    
                    $url = Config::get('constants.whisker.url.get_user').$user_id;
                    
                    //update existing user email
                    $whisker = Helper::PostRequest($data, $method, $url, $token); 
                    
                }
                
                $request->session()->put('griffin_user', $user);
                
                return redirect()->route('griffin-profile')->with('succes', "User profile updated successfully..!");
                
            } 
        }else{
            return redirect()->route('griffin')->with('error',"You Need to Login First");
        }
        
    }

    public function switchToGriffin(Request $request){
        
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
            
            $url =  Config::get('constants.griffin.url.token');
            $method ='POST';
            $data=[
                'username' => Config::get('constants.griffin.admin.username'),
                'password' => Config::get('constants.griffin.admin.password'),
            ];
            //get token of griffin site
            $result = Helper::PostRequest($data, $method, $url, $token='');
            if($result['success']==false){
                return back()->with('error', $result['message']);
            }

            $url= Config::get('constants.griffin.url.token_validate');
            
            $token =$result['data']['token'] ;
            //checking token validate or not
            $result1=Helper::PostRequest($data='', $method, $url, $token);

            if($result1['success']==false){
                return back()->with('error', $result1['message']);
            }
        
            if ($result1['message'] == "Token is valid") {
            
                $method = 'POST';
                $token= $result['data']['token'];
                $url= Config::get('constants.griffin.url.get_user').$user_id;
                //fetch griffin user
                $user= Helper::PostRequest($data='', $method, $url, $token);
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
                }  
            
            }
        }
       
    }

    public function switchToWhisker(Request $request){
       
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
                $url=Config::get('constants.whisker.url.token');
                $method='POST';
                $data=[
                'username' => Config::get('constants.whisker.admin.username'),
                'password' => Config::get('constants.whisker.admin.password'),
                ];
                
            $result = Helper::PostRequest($data, $method, $url, $token='');
            if($result['success']==false){
                return back()->with('error', $result['message']);
            }

            $url =Config::get('constants.whisker.url.token_validate');
            $method='POST';
            $token=$result['data']['token'];
            
            $result1 = Helper::PostRequest($data='', $method, $url, $token);
            if($result1['success']==false){
                return back()->with('error', $result1['message']);
            }
            if ($result1['message'] == "Token is valid") {
                
                $url =  Config::get('constants.whisker.url.get_user').$user_id;
                $method='POST';
                $token=$result['data']['token'];
                
                $user = Helper::PostRequest($data='', $method, $url, $token);
                
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
                }
            }
        }   
    }

    public function griffinchangepassword(Request $request){
        if(Session::has('griffin_user') && Session::has('token')){
          
            return view('pages.griffin-user-password');
        } 
    }

    public function whiskerchangepassword(Request $request){
        if(Session::has('user') && Session::has('token')){
          
            return view('pages.user-password');
        }   
    }

    public function griffinpasswordchange(Request $request){
        if(Session::has('griffin_user') && Session::has('token')){

            $griffinuser = Session::get('griffin_user');
                    
            $password = Session::get('user_credentials');
            $user_email= $griffinuser['email'];

            $method="POST";
            $url= Config::get('constants.griffin.url.token');
            $data = [
             'username' => $user_email,
             'password' => $password['password'],
            ];
             // get token 
            $result = Helper::PostRequest($data, $method, $url, $token='');
          
            if($result['success']==false){
                return back()->with('error', $result['message']);
            } 
            
            $method="POST";
            $data=[
                'password'=>!empty($request->password)?$request->password:'',
            ];
            $token = $result['data']['token'];
            $url=Config::get('constants.griffin.url.get_user') .$result['data']['id'];
             
            $user = Helper::PostRequest($data, $method, $url, $token);
            
            
            if(!empty($user)){
                return redirect()->route('logout');
            }
           
        }
    }

    public function whiskerpasswordchange(Request $request){
        if(Session::has('user') && Session::has('token')){
          
            $password = Session::get('user_credentials');
            $griffinuser = Session::get('user');
            $user_email= $griffinuser['email'];
            
           $method="POST";
           $url= Config::get('constants.whisker.url.token');
           $data = [
            'username' => $user_email,
            'password' => $password['password'],
           ];
            // get token 
           $result = Helper::PostRequest($data, $method, $url, $token='');
           if($result['success']==false){
                return back()->with('error', $result['message']);
            }   
        
            $method="POST";
            $data=[
                'password'=>!empty($request->password)?$request->password:'',
            ];
            $token = $result['data']['token'];
            $url=Config::get('constants.whisker.url.get_user').$result['data']['id'];
             
            $user = Helper::PostRequest($data, $method, $url, $token);
            if(!empty($user)){
                return redirect()->route('logout')->with('succes','Password Changed successfully..!');
            }
         
        }
    }
}