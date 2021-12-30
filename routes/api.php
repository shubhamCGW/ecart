<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

Route::post('userRegister','ApiController@Register');
Route::post('userLogin','ApiController@Login');
Route::post('forgetPassword', 'ApiController@forgetPassword');
Route::post('verifyOtp','ApiController@verifyOtp');


Route::group(['middleware'=>['auth:sanctum']],function(){

    Route::any('/getUser','ApiController@me');
    Route::post('updateProfile','ApiController@updateProfile');

    Route::post('logout','ApiController@logout');
    Route::post('change-password', 'ApiController@change_password');

    Route::post('addToWishListProduct','ApiController@addToWishListProduct');
    Route::post('getProductDetails', 'ApiController@getProductDetails');
    Route::post('getUserWishList','ApiController@getUserWishList');
    Route::post('addToCart','ApiController@addToCart');
    Route::post('getCartList','ApiController@getCartList');
    Route::post('removeFromWishList','ApiController@removeItemFromUserWishList');


});

Route::post('forgotPasswordSentEmail','ApiController@sendResetLinkResponse')->name('passwords.sent');
Route::post('resetPassword', 'ApiController@sendResetResponse')->name('passwords.reset');
Route::get('getCategories', 'ApiController@getCategoriesList');
Route::get('getProducts', 'ApiController@getProductsList');
Route::post('getProductsByCategory', 'ApiController@getProductsByCategories');
Route::get('getBanners', 'ApiController@getBannersList');

Route::post('getSubCategories','ApiController@getSubCategories');
Route::get('getExclusiveOffer','ApiController@getExclusiveOffer');
Route::get('getBestSelling','ApiController@getBestSelling');
Route::get('getGroceries','ApiController@getGroceries');

