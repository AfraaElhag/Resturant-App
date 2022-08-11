<?php

//namespace App\Auth;
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class ApiUserProvider implements UserProvider
{


protected $model;
protected $modelUser;

public function __construct()
{
    $this->model = APIUser::class;
     
}



public function fetchUser($credentials) {
    if ($credentials['phone'] ) {
        
        $phone = $credentials['phone'];
        

        $client = new \GuzzleHttp\Client([
            'headers'  => ['Authorization' => env('FOODICS_API_TOKEN_KEY')],
        ]);




        $url = 'https://api-sandbox.foodics.com/v5/customers?filter[phone]='.$phone;

        try {
          
        $response = $client->request('GET', $url);
        } catch (GuzzleException $e) {
            print_r($e->getResponse());
        }

        $array = json_decode($response->getBody()->getContents(), true);

        if($response->getStatusCode()== 200){
            if($array["data"] != null){

            $userInfo = $array["data"][0];

            return new $this->model($userInfo);
            }
          
            

        } else {
           

            return $array ?: "Something went wrong. Please try again";
        }
    }
}


public function retrieveById($identifier) {
        $client = new \GuzzleHttp\Client([
            'headers'  => ['Authorization' => env('FOODICS_API_TOKEN_KEY')],
        ]);
      
        $response = $client->request('GET', 'https://api-sandbox.foodics.com/v5/customers/'.$identifier);
        $array = json_decode($response->getBody());
         return ($array->data);
          //dd($array->data);
          
        

   
}

/**
 * Retrieve a user by their unique identifier and "remember me" token.
 *
 * @param  mixed  $identifier
 * @param  string  $token
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 */
public function retrieveByToken($identifier, $token) {}

/**
 * Update the "remember me" token for the given user in storage.
 *
 * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
 * @param  string  $token
 * @return void
 */
public function updateRememberToken(Authenticatable $user, $token){}

/**
 * Retrieve a user by the given credentials.
 *
 * @param  array  $credentials
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 */
public function retrieveByCredentials(array $credentials){
   
    $user = $this->fetchUser($credentials);

 
    return $user;
}

/**
 * Validate a user against the given credentials.
 *
 * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
 * @param  array  $credentials
 * @return bool
 */
public function validateCredentials(Authenticatable $user, array $credentials ){
      

    
    return true;
}

}
