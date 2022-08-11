<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\branchesTime;
use Illuminate\Support\Facades\Cache;





class ApiController extends Controller
{

    
  public function homePage(Request $request){
    //$request->session()->flush();
    $latest_products=[];
    $home_products=[];
    $client=new Client(['base_uri' => env('FOODICS_API_URL')]);
    //get categories
   $categories = Cache::remember('cache_cat', now()->addDay(), function ()  use ($client){

      //var_dump('cache_cat');


  return json_decode($client->request('GET', 'groups?filter[is_deleted]=false&include=products', ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]])->getBody())->data;
    
});


   
   //get offers
   $discount = Cache::remember('cache_discount', now()->addDay(), function ()  use ($client){
  return json_decode($client->request('GET', 'discounts?filter[name]=APP_Discount&include=products', ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]])->getBody())->data;
    
});

   


  // $discount=$client->request('GET', 'discounts?filter[name]=APP_Discount&include=products', ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]]);
    //get products
    $products = Cache::remember('cache_product', now()->addDay(), function ()  use ($client){
  return json_decode($client->request('GET', 'products?filter[is_deleted]=false&include=discounts&include=tags&sort=-updated_at', ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]])->getBody())->data;
    
});
  // $products=$client->request('GET', 'products?filter[is_deleted]=false&include=discounts&include=tags&sort=-updated_at', ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]]);
  
   //$products=json_decode($products->getBody())->data;
    //get latest products
   foreach ($products as $product) {
    foreach ($product->tags as $tag) {
      if($tag->name == 'Latest Products'){
         array_push($latest_products,$product);
      }
    }}

    foreach ($products as $product) {
    foreach ($product->tags as $tag) {
      if($tag->name == 'App Products'){
         array_push($home_products,$product);
      }
    }}
    
   
  
   return view('home',['categories'=>$categories, 'products'=>$home_products,'discount'=>$discount, 'latest_products'=>$latest_products]);

  }





      public function getProduct(Request $request,$id){
                $client=new Client(['base_uri' => env('FOODICS_API_URL')]);

        $product = Cache::remember('cache_single_product'.$id, now()->addDay(), function ()  use ($client ,$id){
  return json_decode($client->request('GET', 'products/'.$id, ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]])->getBody())->data;
    
});

		    //$response=$client->request('GET', 'products/'.$id, ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]]);
        return view('product',['product'=>$product]);
    }




    public function branches(Request $request){


        $client=new Client(['base_uri' => env('FOODICS_API_URL')]);

        $branches = Cache::remember('cache_branches', now()->addDay(), function ()  use ($client){
  return json_decode($client->request('GET', 'branches?filter[is_deleted]=false', ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]])->getBody())->data;
    
});



        //$branches=$client->request('GET', 'branches?filter[is_deleted]=false', ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]]);
        //$branches=json_decode($branches->getBody())->data;
        $app_time=branchesTime::get()->first();

        $app_opening_from=Carbon::parse($app_time->opening_from);
        $app_opening_to=Carbon::parse($app_time->opening_to);
        $now=Carbon::now();
        foreach($branches as $branch){

          $foodics_opening_from=Carbon::parse($branch->opening_from);
          $foodics_opening_to=Carbon::parse($branch->opening_to);
         
         

          if(($now->greaterThanOrEqualTo($foodics_opening_from) and $now->lessThan($app_opening_from)) or($now->greaterThanOrEqualTo($app_opening_to) and $now->lessThan($foodics_opening_to)) ){
             
            $branch->status='Open';
          }
          else{
             $branch->status='Closed';
          }

          
        }
       
        return view('branches',['branches'=>$branches,'app_time'=>$app_time ]); 
       
    }

    public function delivery_type(Request $request){
          $type=$request->input('type');
          $validated = $request->validate([
        'type' => 'required',

        
    ]);
          $user_id=Auth::user()->id;

          $client=new Client(['base_uri' => env('FOODICS_API_URL')]);

          $branches = Cache::remember('cache_branches', now()->addDay(), function ()  use ($client){
  return json_decode($client->request('GET', 'branches?filter[is_deleted]=false', ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]])->getBody())->data;
    
});

           $charges = Cache::remember('cache_charges', now()->addDay(), function ()  use ($client){
  return json_decode($client->request('GET', 'charges?filter[is_deleted]=false', ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]])->getBody())->data;
    
});

          //$branches=$client->request('GET', 'branches?filter[is_deleted]=false', ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]]);
          //$charges=$client->request('GET', 'charges?filter[is_deleted]=false', ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]]);
          //$charges=json_decode($charges->getBody())->data;
        
          foreach($charges as $charge) {
            if($charge->name_localized == 'App_Normal_Delivery_Charge'){
              $Normal_Delivery_Charge=$charge;
             
            }
            
            if($charge->name_localized == 'App_Speed_Delivery_Charge'){
              $Speed_Delivery_Charge=$charge;
              
            }

             if($charge->name_localized == 'App_Free_Delivery_Charge'){
              $Free_Delivery_Charge=$charge;
              
            }

             if($charge->name_localized == 'App_Remote_Delivery_Charge'){
              $Remote_Delivery_Charge=$charge;
              
            }
          }
         

          $app_time=branchesTime::get()->first();

          $addresses=$client->request('GET', 'addresses?filter[is_deleted]=false&filter[customer_id]='.$user_id, ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]]);
          $addresses=json_decode($addresses->getBody())->data;

          $addresses = array_reverse($addresses);
            $app_opening_from=Carbon::parse($app_time->opening_from);
          $app_opening_to=Carbon::parse($app_time->opening_to);
          $now=Carbon::now();

          //$branches=json_decode($branches->getBody())->data;
          $is_branches_open=[];
          foreach($branches as $branch){

          $foodics_opening_from=Carbon::parse($branch->opening_from);
          $foodics_opening_to=Carbon::parse($branch->opening_to);

         if(($now->greaterThanOrEqualTo($foodics_opening_from) and $now->lessThan($app_opening_from)) or($now->greaterThanOrEqualTo($app_opening_to) and $now->lessThan($foodics_opening_to)) ){
            $branch->status='Open';
            array_push($is_branches_open,'true');
             
          }
          else{
             $branch->status='Closed';
          }
          
        }


         return view('delivery_type',['type'=>$type, 'notes'=>$request->input('notes'),'branches'=>$branches,'addresses'=>$addresses, 'Normal_Delivery_Charge'=>$Normal_Delivery_Charge,'Speed_Delivery_Charge'=>$Speed_Delivery_Charge,'Free_Delivery_Charge'=>$Free_Delivery_Charge,'Remote_Delivery_Charge'=>$Remote_Delivery_Charge, 'app_time'=>$app_time, 'is_branches_open'=>$is_branches_open]);
       
    }




    public function place_order(Request $request){
     
if ($request->session()->has('products')) {
    

     if($request->type == 2){
      $validated = $request->validate([
        'pickup_branch_id' => 'required',
              
    ]);
     }

      if($request->type == 3){
      $validated = $request->validate([
        
        'address_id' => 'required',
        'delivery_charge_name' => 'required',      
    ]);
     }
         

    
      $lat=$request->lat;
      $lng=$request->lng;
      
      $lat=number_format($lat, 5, '.', '');
      $lng=number_format($lng, 5, '.', '');
      

      $customer_note='https://maps.google.com/?q='.$lat.','.$lng;

      $client = new \GuzzleHttp\Client([
            'headers'  => ['Authorization' => env('FOODICS_API_TOKEN_KEY')],
        ]);


 
      $items=$request->session()->get('products');
       $is_percentage=$request->session()->get('is_percentage');
       if($is_percentage == true){
        $discount="discount_percent";
       }
       else {
        $discount="discount_amount";
       }

       
      for($i=0; $i<count($items); $i++){
      $a[]=
                    [
                            'product_id'=>$items[$i]['id'],
                            'quantity' => (int) $items[$i]['qty'],
                            'unit_price' => (int) $items[$i]['price'],
                             $discount => (int) $items[$i]['discount_amount'],
                            'discount_id' => $items[$i]['discount_id'],
                            'discount_type'=> 1,
                            'options'=>[],

          ]; 


      $options=$items[$i]['modifier'];

      for($j=0; $j<count($options); $j++) {
           $a[$i]['options'][]=[
                          'modifier_option_id'=>$options[$j][0],
                          'quantity'=>1,
                          'partition'=>1,
                          'unit_price'=>(int) $options[$j][2],
                         
                      ];
        }}

        $charges=[];
        if($request->delivery_charge_name == 'App_Normal_Delivery_Charge'){
            $charges=[
                      [ 
                        'charge_id'=>$request->delivery_normal_charge_id,
                        'amount'=>(int) $request->delivery_normal_charge_amount,
                      ]];

                    }
        if($request->delivery_charge_name == 'App_Speed_Delivery_Charge'){
                      $charges=[
                                  [ 
                                    'charge_id'=>$request->delivery_speed_charge_id,
                                    'amount'=>(int) $request->delivery_speed_charge_amount,
                                  ]
                                ];

                    }
        if($request->delivery_charge_name == 'App_Free_Delivery_Charge'){
                      $charges=[
                                  [ 
                                    'charge_id'=>$request->delivery_free_charge_id,
                                    'amount'=>(int) $request->delivery_free_charge_amount,
                                  ]
                                ];

                    }


        if($request->delivery_charge_name == 'App_Remote_Delivery_Charge'){
                      $charges=[
                                  [ 
                                    'charge_id'=>$request->delivery_remote_charge_id,
                                    'amount'=>(int) $request->delivery_remote_charge_amount,
                                  ]
                                ];

                    }
          
        
  if($request->type == 2){
 $response = $client->request('POST', 'https://api.foodics.com/v5/orders', ['json' =>[
                 'type' => $request->type,
                  'branch_id' => $request->pickup_branch_id,
                  'customer_id' =>Auth::user()->id,
                  'kitchen_notes'=>$request->notes,
                  'charges' => [],
                  'products' => $a
            ]]);
 }
 if($request->type == 3){



   $response = $client->request('POST', 'https://api.foodics.com/v5/orders', ['json' =>[
                 'type' => $request->type,
                  'branch_id' => $request->delivery_branch_id,
                  'customer_address_id' => $request->address_id,
                  'customer_id' =>Auth::user()->id,
                  'customer_notes'=>$customer_note,
                  'kitchen_notes'=>$request->notes,
                 
                  'charges' => $charges,
                  'products' => $a
            ]]);
 }

 $result=json_decode($response->getBody());
 
   if( ($response->getStatusCode()== 200) and ($result)){
    
        $request->session()->forget(['products', 'total_qty','order_price','total_discount','is_percentage']);
          return redirect()->route('ordersuccess'); 
            

        } 
        else{
          return redirect()->back()->with('message', 'عفوا حدث خطأ الرجاء المحاولة مرة أخري');
        }

        }
        else{
          return redirect()->route('checkout');
        }
 }
     
     public function addAdress(Request $request){
      $validated = $request->validate([
        'address_name' => 'required',
        'address_description' => 'required',
        'lat' => 'required',
        'lng' => 'required',   
    ]);

      $client = new \GuzzleHttp\Client([
            'headers'  => ['Authorization' => env('FOODICS_API_TOKEN_KEY')],
        ]);


      $addresses = $client->request('POST', 'https://api.foodics.com/v5/addresses', [ 'json' =>[ 
                "name" => $request->input('address_name'),
                "description"=> $request->input('address_description'),
                "latitude"=>  $request->input('lat'),
                "longitude"=> $request->input('lng'),
                "customer_id"=> Auth::user()->id,
                "delivery_zone_id"=> ""
                        ]
            ]);
      if($request->previous_url== 'delivery_type'){
        return redirect()->route('delivery_type',['type'=>$request->type]); 
      }
      if($request->previous_url== 'address'){
        return redirect()->route('getaddress'); 
      }       
    }

     public function getAdress(Request $request){
        $user_id=Auth::user()->id;
        $client=new Client(['base_uri' => env('FOODICS_API_URL')]);
        $addresses=$client->request('GET', 'addresses?filter[is_deleted]=false&filter[customer_id]='.$user_id, ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]]);
         $addresses=json_decode($addresses->getBody())->data;

          $addresses = array_reverse($addresses);
    return view('address',['addresses'=>$addresses]); 
       
    }
  



     public function getOrders(Request $request){
       $user_id=Auth::user()->id;
      $client=new Client(['base_uri' => env('FOODICS_API_URL')]);
    $orders=$client->request('GET', 'orders?filter[customer_id]='.$user_id, ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]]);
    $orders=json_decode($orders->getBody())->data;
    $orders = array_reverse($orders);

    return view('previous_orders',['orders'=>$orders]); 
       
    }

    
     public function deleteAdress(Request $request, $id){
      $client=new Client(['base_uri' => env('FOODICS_API_URL')]);
   $client->request('DELETE', 'addresses/'.$id, ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]]);
   return redirect()->back();
       
    }



    public function updateProfile(Request $request){
        $id=Auth::user()->id;
       
        $client = new \GuzzleHttp\Client([
            'headers'  => ['Authorization' => env('FOODICS_API_TOKEN_KEY')],
        ]);

         $response = $client->request('PUT', 'https://api-sandbox.foodics.com/v5/customers/'.$id, [ 'json' =>[
                "name"=> $request->name,
                "dial_code"=> 966,
                "phone" => Auth::user()->phone, 
                "email"=> $request->email,
                "is_loyalty_enabled" =>false,
                "is_blacklisted"=> false,
                "is_house_account_enabled" => true
            ]
            ]);
return redirect()->back();
    }}



                 
               


