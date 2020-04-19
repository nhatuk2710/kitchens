<?php

use Illuminate\Support\Facades\Route;
//Route for admin
Route :: prefix("admin")->middleware("check_admin")->group(function (){
    include_once ("admin.php");
});
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

Route::get('/','WebController@home');
Route::get('listingcate/{id}','WebController@listingcate');

Route::get('listingbrand/{id}','WebController@listingBrand');
Route::get('/product/{id}','WebController@product');
Route::get("/shopping/{id}","WebController@shopping")->middleware("auth");
Route::post("/shopping/{id}","WebController@pshopping")->middleware("auth");
Route::get('cart','WebController@cart')->middleware("auth");
Route::get("/reduceOne/{id}","WebController@reduceOne")->middleware("auth");
Route::get("/increaseOne/{id}","WebController@increaseOne")->middleware("auth");
Route::get("/increase/{id}","WebController@increase")->middleware("auth");
Route::post("updateCart",'WebController@updateCart')->middleware("auth");
Route::get("/deleteItemCart/{id}","WebController@deleteItemCart");
Route::get("/clear-cart","WebController@clearCart")->middleware("auth");
Route::get("/check-out","WebController@checkout")->middleware("auth");
Route::post("/check-out","WebController@placeOrder")->middleware("auth");
Route::get("checkout-success","WebController@checkoutSuccess") ;

Route::get('log','WebController@log');
Route::get("test",function (){
   $cart =session("cart");
   dd($cart);
});

Auth::routes();
Route::get('/logout', function (){
    \Illuminate\Support\Facades\Auth::logout();
    session()->flush();
    return redirect()->to("/");
});
