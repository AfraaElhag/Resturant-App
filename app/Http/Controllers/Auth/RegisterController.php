<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $model;
   


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
   //protected $redirectTo = RouteServiceProvider::HOME;
   protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
         $this->model = APIUser::class;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
   protected function validator(array $data)
    {
        
        return Validator::make($data, [
            'phone' => 'required|regex:/(5)[0-9]{8}/|digits:9',
            'name' => 'required|max:255|string',
           
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */


     public function register(Request $request)
    {
        $this->validator($request->all())->validate();

       

        event(new Registered($user = $this->create($request->all())));
            if($user){
        $this->guard()->login($user);
    }
    else{
         return redirect()->route('login', ['phone' => $request->phone]);
    }

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }



    protected function create(array $data)
    {
         
 

        $phone=$data['phone'];
        if($data['name']){
            $name=$data['name'];
        }
        else{
            $name="new user";
        }
        

        $client = new \GuzzleHttp\Client([
            'headers'  => ['Authorization' => env('FOODICS_API_TOKEN_KEY')],
        ]);

        //check if user already exist

        try {
          
        $response = $client->request('GET', 'https://api.foodics.com/v5/customers?filter[phone]='.$phone);
        } 
        catch (GuzzleException $e) {
            print_r($e->getResponse());
        }

        $array = json_decode($response->getBody());

        if($response->getStatusCode()== 200){
            //create new user
           if($array->data == null){
             try {
            $response = $client->request('POST', 'https://api.foodics.com/v5/customers', [ 'json' =>[ 
                "name"=>$name,
                 "dial_code"=> 966,
                "phone" => $phone , 
                "is_loyalty_enabled" =>false,
                "is_blacklisted"=> false,
                "is_house_account_enabled" => true
            ]
            ]);
        } 
        catch (GuzzleException $e) 
        {
            print_r($e->getResponse());
        }

       
        if($response->getStatusCode()== 200){

        $user = json_decode($response->getBody()->getContents(), true);
    

        if($user == null){
            return ($user);

        }
        else{
            

            return new $this->model($user["data"]);
            

            
        }
        } 
         else {
           

            return ["عذرا حدث خطأ"];
        }



    }

    {
           

          
        }
    }

    /* else {
           

            return ["Something went wrong. Please try again"];
        }*/
         



     
        //ddd($array);
    }

    



}
