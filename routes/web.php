<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Auth\LoginController;
//use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 Route::get('setlocale/{locale}',function($lang){
       \Session::put('locale',$lang);
       return redirect()->back();   
});


Route::get('/', 'ApiController@homePage')->name('home')->middleware('language');

Route::get('getProduct/{id}', 'ApiController@getProduct')->name('product')->middleware('language');
Route::get('/branches' , 'ApiController@branches')->name('branches')->middleware('language');

//user
Route::post('/update','ApiController@updateProfile')->name('update')->middleware('auth');
Route::get('/login',[App\Http\Controllers\Auth\LoginController::class, 'login'] )->name('login');
Route::get('/signup',[App\Http\Controllers\Auth\RegisterController::class, 'register'] )->name('signup');
Route::post('/logout',[App\Http\Controllers\Auth\LoginController::class, 'logout'] )->name('logout')->middleware('auth');

//otp
Route::post('generateOtp', 'OtpController@generateOtp')->name('generateOtp');
Route::post('validateOtp', 'OtpController@validateOtp')->name('validateOtp');

//checkout
Route::post('checkout', 'CheckoutController@addtoCart')->name('addtoCart');
Route::post('editcart', 'CheckoutController@editCart')->name('editcart');
Route::post('getcartproduct', 'CheckoutController@getCartProduct')->name('getcartproduct');
Route::post('deletecartproduct', 'CheckoutController@deleteCartProduct')->name('deletecartproduct');


//orders
Route::post('place_order', 'ApiController@place_order')->name('place_order')->middleware('auth');
Route::get('orders', 'ApiController@getOrders')->name('get_orders')->middleware('auth')->middleware('language');
Route::get('delivery_type', 'ApiController@delivery_type')->name('delivery_type')->middleware('auth')->middleware('language');

//addresses
Route::post('address', 'ApiController@addAdress')->name('addaddress')->middleware('auth');
Route::get('address' , 'ApiController@getAdress')->name('getaddress')->middleware('language')->middleware('language');
Route::get('delete_address/{id}', 'ApiController@deleteAdress')->name('deleteaddress')->middleware('auth');

//branches break time
Route::get('/branchestime' ,function () {
    return view('edit_branches_time');
})->name('branchestime');
Route::post('branchestime', 'BranchesTimeController@updateTime')->name('branchestime');


//Statci pages routing
Route::group(['middleware' => 'language'], function () {
  Route::get('/order_success' ,function () {
    return view('order_success');
})->name('ordersuccess');

Route::get('/landing' ,function () {
    return view('landing');
})->name('landing');

Route::get('/location' ,function () {
    return view('location');
})->name('landing');
Route::get('loginform' ,function () {
    return view('login');
})->name('loginform');

Route::get('/signupform' ,function () {
    return view('signup');
})->name('signupform');


Route::get('/about_us' ,function () {
    return view('about_us');
})->name('about_us');

Route::get('/faq' ,function () {
    return view('faq');
})->name('faq');

Route::get('/contact-us' ,function () {
    return view('contact-us');
})->name('contact');

Route::get('/profile' ,function () {
    return view('profile');
})->name('profile')->middleware('auth');

Route::get('/checkout' ,function () {
    return view('checkout');
})->name('checkout');

Route::get('/add_new_address' ,function () {
    return view('add_new_address');
})->name('add_new_address')->middleware('auth');

Route::get('/verification' ,function () {
    return view('verification');
})->name('verification');

});


