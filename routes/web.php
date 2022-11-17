<?php

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

// front route start
Route::get('/', function () {
    return view('index');
});

Route::get('shop', function () {
    return view('shop');
});

Route::get('about', function () {
    return view('about');
});
Route::get('shop-details', function () {
    return view('shop-details');
});
Route::get('shopping-cart', function () {
    return view('shopping-cart');
});
Route::get('checkout', function () {
    return view('checkout');
});
Route::get('blog-details', function () {
    return view('blog-details');
});

Route::get('blog', function () {
    return view('blog');
});
Route::get('contact', function () {
    return view('contact');
});
// front route end

// backend routes start
Route::group(['middleware' => 'withoutuser'], function () {
    Route::get('login', 'UserController@login');
    Route::post('login_user', 'UserController@loginUser');
    Route::get('signup', 'UserController@signup');
    Route::post('store_user', 'UserController@store_user');
});
Route::group(['middleware' => 'user'], function () {
    Route::get('dashboard', 'DashboardController@index');
    Route::get('logout', 'UserController@logout');
});
// backend routes end
