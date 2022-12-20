<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\Post;
use App\Models\User;
use App\Models\UserWhiskey;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
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
            return redirect()->route('home');
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
        $response = $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/api/v1/token', [
            'form_params' => [
                'username' => 'admin',
                'password' => 'admin@3338',
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
            $response3 = $client->request('GET', 'https://exceledunet.com/wordpress/wp-json/wp/v2/users?search=Test Customer', [
                'headers' =>
                [
                    'Authorization' => "Bearer {$result->jwt_token}"
                ],
            ]);
            //dd($response3->getBody()->getContents());
            $user = $response3->getBody()->getContents();
            $user = json_decode($user);
            // dd($user[0]);
            if($user[0]->slug=='customera'){
                $request->session()->regenerate();
                if($request->site=="Whisker And Soda - Where Cats and Relax Collide"){
                    $request->session()->put('one', $request->site);
                }
                Auth::loginUsingId($user[0]->id);
                // dd("hii");
                return redirect()->route('dashboard');
           }
        }


        // $user = User::where("email", $request->email)->first();
        // if(!empty($user)){
        //     if(Hash::check($request->password, $user->password)){

        //         if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

        //             $request->session()->regenerate();
        //             if($request->site=="Whisker And Soda - Where Cats and Relax Collide"){
        //                 $request->session()->put('one', $request->site);
        //             }
        //         } 
        //         Auth::loginUsingId($user->id);
        //         return redirect()->intended('dashboard');
        //     }else{
        //         return back()->with('error' ,'Incorrect password.');
        //     }
        // }else{
        //     return back()->with('error' ,'invalid user.'); 
        // }     

    }

    public function logout(Request $request)
    {
        if ($request->session()->has('one')) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login');
        }
        if ($request->session()->has('two')) {
            Auth::logout();
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

    public function display()
    {
        return view('auth.login1');
    }
    public function store(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where("user_email", $request->email)->first();

        if (!empty($user)) {
            // checking 
            if (Hash::check($request->password, $user->password)) {

                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

                    $request->session()->regenerate();

                    if ($request->site == "Griffin Rock CAT Retreat - Your Cat's Vacation oasis") {
                        $request->session()->put('two', $request->site);
                    }
                }

                Auth::loginUsingId($user->id);
                return redirect()->intended('griffin-dashboard');
            } else {
                return back()->with('error', 'Incorrect password.');
            }
        } else {
            return back()->with('error', 'invalid user.');
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
}
