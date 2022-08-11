<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;



class CheckoutController extends Controller
{
	
	public function addtoCart(Request $request){
		
		$request->all();
		$product_id=$request->id;
		
		$total_price=$request->price * $request->qty;			
		$modifier_total_price=0;
		$modifier=[];

		if($request->has('modifier')){
		   
			foreach($request->modifier as $key => $val ) {
				if (array_key_exists('name', $request->modifier[$key])){
    			$modifier[] = [ $key, $request->modifier[$key]['name'],  $request->modifier[$key]['price'] ];
    			$modifier_total_price=$modifier_total_price+ $request->modifier[$key]['price'] ;
				}


		}}
		$modifier_total_price=$modifier_total_price*$request->qty;
		
		$total_price=$total_price+$modifier_total_price;

			if($request->has('discount_amount')){

			$request->session()->put('is_percentage', $request->discount_is_percentage);

			if($request->discount_is_percentage == false){

			$total_price=$total_price - $request->discount_amount;
			$product_discount=$request->discount_amount;
		}
			
		else if($request->discount_is_percentage == true){
			
			$discount_percentage=$request->discount_amount/100;
			$product_discount=$total_price*$discount_percentage;
			$total_price=$total_price-$product_discount;
			
		}
		
	}
	else{
			$product_discount=0;
		}



		
		$products = $request->session()->get('products');

		if(!$products) {

			$tax=(15*$total_price)/115;
			$tax=number_format($tax, 2, '.', '');
			


			$request->session()->put('products', []);

			$request->session()->push('products',['id'=>$request->id ,'name'=>$request->name, 'qty'=>$request->qty, 'price'=>$request->price, 'image'=>$request->image, 'total_price'=>$total_price,  'discount_amount'=>$request->discount_amount,  'discount_id'=>$request->discount_id, 'product_discount'=>$product_discount,'is_percentage'=>$request->discount_is_percentage, 'modifier'=>$modifier]);

			$request->session()->put('total_qty', $request->qty );
			$request->session()->put('order_price', $total_price);
			$request->session()->put('total_discount', $product_discount);
			$request->session()->put('tax', $tax);	
	

			return redirect()->route('home');
	}




			$quantity=$request->session()->get('total_qty');
        	$quantity=$quantity+$request->qty;

        	$order_price=$request->session()->get('order_price');
        	$order_price=$order_price+$total_price;

        	$total_discount=$request->session()->get('total_discount');



$exist=false;
	foreach($products as $key => $value)
        {
            if($value['id'] == $product_id) 
            {                
                if($value['modifier']== $modifier){
                	$products[$key]['qty']=$value['qty']+$request->qty;
                	$products[$key]['total_price']=$value['total_price']+$total_price;
                	if($products[$key]['is_percentage'] == true){
                		$products[$key]['product_discount']=$value['product_discount']+$product_discount;
                		$total_discount=$total_discount+$product_discount;
                	}


                	$exist=true;
                	
                } 

            }
        }


        if($exist){

        	$tax=(15*$total_price)/115;
        	 $tax=number_format($tax, 2, '.', '');
			$request->session()->put('tax', $tax);		


        	$request->session()->put('products', $products);
        	$request->session()->put('total_qty', $quantity );
			$request->session()->put('order_price', $order_price);
			$request->session()->put('total_discount', $total_discount);	
			return redirect()->route('home');	

        }
        else{
        	
        	$request->session()->push('products',['id'=>$request->id ,'name'=>$request->name, 'qty'=>$request->qty, 'price'=>$request->price, 'image'=>$request->image, 'total_price'=>$total_price, 'discount_amount'=>$request->discount_amount,  'discount_id'=>$request->discount_id,'product_discount'=>$product_discount,'is_percentage'=>$request->discount_is_percentage, 'modifier'=>$modifier]);

			$tax=(15*$total_price)/115;
			 $tax=number_format($tax, 2, '.', '');
			
			$request->session()->put('tax', $tax);	

        	$total_discount=$total_discount+$product_discount;
        	$request->session()->put('total_discount', $total_discount);	
        	$request->session()->put('total_qty', $quantity );
			$request->session()->put('order_price', $order_price);	
			return redirect()->route('home');

        }

	}


	
	public function getCartProduct(Request $request){
		$request->all();
		$client=new Client(['base_uri' => env('FOODICS_API_URL')]);
		$response=$client->request('GET', 'products/'.$request->id, ['headers' => ['Authorization' => env('FOODICS_API_TOKEN_KEY')]]);
		if($request->is_percentage== true){
			$total_price=$request->product_total_price+$request->product_discount;
					}
					else{
						$total_price=$request->product_total_price;
					}
    	return view('edit_product',['product'=>json_decode($response->getBody())->data,'modifier_from_cart'=>$request->modifier_id, 'qty'=>$request->qty, 'total_price'=>$total_price ,'product_discount'=>$request->product_discount]);

	}



	public function editCart(Request $request){
		$request->all();
		$product_id=$request->id;

		$total_price=$request->price * $request->qty;		
		$modifier_total_price=0;
		$modifier=[];
		$old_modifier=[];

		
		if($request->has('modifier')){
		   
			foreach($request->modifier as $key => $val ) {
				if (array_key_exists('name', $request->modifier[$key])){
    			$modifier[] = [ $key, $request->modifier[$key]['name'],  $request->modifier[$key]['price'] ];
    			$modifier_total_price=$modifier_total_price+ $request->modifier[$key]['price'] ;
				}
		}}

		if($request->has('old_modifier')){
		   
			foreach($request->old_modifier as $key => $val ) {
    			$old_modifier[] = [ $key, $request->old_modifier[$key]['name'],  $request->old_modifier[$key]['price'] ];
		}}


		$modifier_total_price=$modifier_total_price*$request->qty;
				
		$total_price=$total_price+$modifier_total_price;
		if($request->has('discount_amount')){

			$request->session()->put('is_percentage', $request->discount_is_percentage);

			if($request->discount_is_percentage == false){

			$total_price=$total_price - $request->discount_amount;
			$product_discount=$request->discount_amount;
		}
			
		else if($request->discount_is_percentage == true){
			
			$discount_percentage=$request->discount_amount/100;
			$product_discount=$total_price*$discount_percentage;
			$total_price=$total_price-$product_discount;
		}}
		else{
			$product_discount=0;
		}
	
		$products = $request->session()->get('products');
		$quantity=$request->session()->get('total_qty');
		$order_price=$request->session()->get('order_price');
		$total_discount=$request->session()->get('total_discount');

$exist=false;
	foreach($products as $key => $value)
        {
            if($value['id'] == $product_id) 
            {                

                if($value['modifier']==$old_modifier){
                	$quantity=$quantity-$products[$key]['qty'];
                	$order_price=$order_price-$products[$key]['total_price'];
                	$total_discount=$total_discount-$products[$key]['product_discount'];

                	$products[$key]['qty']=$request->qty;
                	$products[$key]['total_price']=$total_price;
                	$products[$key]['modifier']=$modifier;
					$products[$key]['product_discount']=$product_discount;
                          	
                } }}

        $quantity=$quantity+$request->qty;
        $order_price=$order_price+$total_price;
        $total_discount=$total_discount+$product_discount;


        $tax=(15*$total_price)/115;
        $tax=number_format($tax, 2, '.', '');
		

		$request->session()->put('tax', $tax);	
        $request->session()->put('products', $products);
        $request->session()->put('total_qty', $quantity );
		$request->session()->put('order_price', $order_price);
		$request->session()->put('total_discount', $total_discount);
		return redirect()->route('checkout');
	}



	public function deleteCartProduct(Request $request){
		$modifier=[];

		
		if($request->has('modifier')){
		   
			foreach($request->modifier as $key => $val ) {
				if (array_key_exists('name', $request->modifier[$key])){
    			$modifier[] = [ $key, $request->modifier[$key]['name'],  $request->modifier[$key]['price'] ];
				}}}
			$products = $request->session()->get('products');

			$quantity=$request->session()->get('total_qty');
        	$quantity=$quantity-$request->qty;

        	$order_price=$request->session()->get('order_price');
        	$order_price=$order_price-$request->product_total_price;

        	$total_discount=$request->session()->get('total_discount');
        	$total_discount=$total_discount-$request->product_discount;


        	foreach($products as $key => $value)
        {
            if($value['id'] == $request->id) 
            {                

                if($value['modifier']==$modifier){
                	
                	unset($products[$key]);	
			                	
                } 

            }
        }

        $products = array_values($products);
        
        $tax=(15*$order_price)/115;
         $tax=number_format($tax, 2, '.', '');
		$request->session()->put('tax', $tax);	
		$request->session()->put('products', $products);
        $request->session()->put('total_qty', $quantity );
		$request->session()->put('order_price', $order_price);
		$request->session()->put('total_discount', $total_discount);

		return redirect()->route('checkout');
	


	}


	}
