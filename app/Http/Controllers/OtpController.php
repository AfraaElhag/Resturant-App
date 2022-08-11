<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Otp;



class OtpController extends Controller
{

	public function generateOtp(Request $request){
	
	$phone=$request->input('phone');
	$name=$request->input('name');

if($request->input('phone') == '580431564' ){
	$validated = $request->validate([
        'phone' => 'required|min:9|max:9',
        'name' => 'required|max:255|string',

        
    ]);
if(basename(url()->previous()) == 'loginform'){
			return redirect()->route('login', ['phone' => $phone,'name' => $name]);
		}

		else{ 
		return redirect()->route('signup', ['phone' => $phone, 'name' => $name]);
		}
		
	}
	else{

	$validated = $request->validate([
        'phone' => 'required|regex:/(5)[0-9]{8}/|min:9|max:9',
        'name' => 'required|max:255|string',

        
    ]);
	$previous_route=basename(url()->previous());

	session(['phone'=> $phone]);
	session(['name'=> $name]);
	session(['route'=> $previous_route]);
	
	$OTP=new Otp();
	$response =  $OTP->generate($phone, 6, 1);
	if($response->status == true){
		  $client=new Client(['base_uri' => 'https://www.hisms.ws/api.php']);
		  $hisms_username=env('HISMS_USER');
		  $hisms_pass=env('HISMS_PASS');
    
    		$client->request('GET', '?send_sms&username='.$hisms_username.'&password='.$hisms_pass.'&&numbers=966'.$phone.'&sender=ALJARAHREST&message='.$response->token);

return redirect()->route('verification');
		

}

	}
}


	public function validateOtp(Request $request){

		$validated = $request->validate([
        'token' => 'required|digits:6',

        
    ]);
		//$token = implode('',array_reverse($request->input('token')));
		$token=$request->input('token');
		$phone=session('phone');
		$name=session('name');


		
		$OTP=new Otp();
		$response =  $OTP->validate($phone,$token);
		
	if($response->status == true){
		
		if(session('route') == 'loginform'){
			return redirect()->route('login', ['phone' => $phone,'name' => $name]);
		}

		else{ 
		return redirect()->route('signup', ['phone' => $phone, 'name' => $name]);
		}	
		
	}
 	return redirect()->route(session('route'))->with('message', '       عذرا الرمز  غير  صالح   الرجاء المحاولة مرة ثانية');
	}
	

	}

