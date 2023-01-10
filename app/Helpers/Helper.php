<?php
namespace App\Helpers;

class Helper{
    public static function PostRequest($data,$method,$url,$token)
    {
        $client = new \GuzzleHttp\Client();
       
        try {
           
            if(empty($token) && !empty($data)){
                $response = $client->request($method, $url, [
                    'form_params' => $data,
                ]);
           }else{
            
            $response = $client->request($method,$url, [
                'headers' =>[
                    'Authorization' => "Bearer {$token}"],
               
            ]);
           }
            
        
            $result = $response->getBody()->getContents();
                
            return $result = json_decode($result,true);
        }catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
    
            return $responseBodyAsString = json_decode($responseBodyAsString,true);
         
        }
         catch (\Throwable $th) {
            return back()->with('error',  $th->getMessage());
		}
          
    }

    // public static function PostTokenRequest($data,$method,$url,$token)
    // {
    //     $client = new \GuzzleHttp\Client();

    //     try {
        
    //         $response = $client->request($method, $url, [
    //             'form_params' => $data,
    //         ]);
        
    //         $result = $response->getBody()->getContents();
                
    //         return $result = json_decode($result,true);
    //     }catch (\GuzzleHttp\Exception\ClientException $e) {
    //         $response = $e->getResponse();
    //         $responseBodyAsString = $response->getBody()->getContents();
    
    //         $responseBodyAsString = json_decode($responseBodyAsString,true);
    //         //    dd($responseBodyAsString);
    //         return back()->with('error', $responseBodyAsString['message']);
    //     }
    //      catch (\Throwable $th) {
    //         return back()->with('error',  $th->getMessage());
	// 	}
          
    // }
}