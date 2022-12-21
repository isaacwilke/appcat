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
                
            $result = json_decode($result);
            $response2 = $client->request('GET', 'https://exceledunet.com/wordpress/wp-json/jwt-auth/v1/token/validate', [
                'headers' =>
                [
                    'Authorization' => "Bearer {$result->data->token}"
                ]
            ]);

            $result1 = $response2->getBody()->getContents();
            $result1 = json_decode($result1);
            
    dd($result1 );
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
                
                $response3 = $client->request('GET', 'https://exceledunet.com/wordpress/wp-json/wp/v2/users?search=Test admin', [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$result->jwt_token}"
                    ],
                ]);
            
                $user = $response3->getBody()->getContents();

                $decoded_json = json_decode($user);
                // dd($decoded_json);
                
                    $request->session()->regenerate();
                    if($request->site=="Whisker And Soda - Where Cats and Relax Collide"){
                        $request->session()->put('one', $request->site);
                    }
                    
                return redirect()->route('dashboard');
            
            
            }

        }
        catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();

            $responseBodyAsString = json_decode($responseBodyAsString,true);
            return back()->with('error', $responseBodyAsString['error_description']);
        }
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
            'email' => ['required'],
            'password' => ['required'],
        ]); 
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', 'https://exceledunet.com/wordpress/wp-json/api/v1/token', [
                'form_params' => [
                    'username' => $request->email,
                    'password' => $request->password,
                ]
            ]);

            $result = $response->getBody()->getContents();

            $result = json_decode($result);
        
       
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
            
                $response3 = $client->request('GET', 'https://exceledunet.com/wordpress/wp-json/wp/v2/users?search=Test admin', [
                    'headers' =>
                    [
                        'Authorization' => "Bearer {$result->jwt_token}"
                    ],
                ]);
            
                $user = $response3->getBody()->getContents();

                $decoded_json = json_decode($user);
                // dd($decoded_json);
            
                $request->session()->regenerate();
                if ($request->site == "Griffin Rock CAT Retreat - Your Cat's Vacation oasis") {
                    $request->session()->put('two', $request->site);
                } 
                
                return redirect()->intended('griffin-dashboard');
            
            
            }
        }
        catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();

            $responseBodyAsString = json_decode($responseBodyAsString,true);
            return back()->with('error', $responseBodyAsString['error_description']);
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
