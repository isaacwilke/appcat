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
           }elseif(!empty($token) && empty($data)){
            
            $response = $client->request($method,$url, [
                'headers' =>[
                    'Authorization' => "Bearer {$token}"],
               
            ]);
           }else{
            $response = $client->request($method,$url, [
                'headers' =>[
                    'Authorization' => "Bearer {$token}"],
                'form_params' => $data,
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
            $throw = $th->getResponse();
            
            $responseBodyAsString = $throw->getBody()->getContents();
           return $responseBodyAsString = json_decode($responseBodyAsString,true);
           
		}
          
    }

   
}