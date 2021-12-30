<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/server', function () {
    dd($_SERVER);
    // return view('welcome');
})->name('server');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/product', 'ProductController');
Route::resource('/category', 'CategoriesController');
Route::resource('/banner', 'BannersController');
Route::resource('/wishlist', 'WishlistController');
