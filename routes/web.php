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
    
    // category route start
    Route::get('category/category_list', 'CategoryController@category_list');
    Route::get('category/add_category', 'CategoryController@index');
    Route::post('category/store_category', 'CategoryController@store_category');
    Route::post('category/update_status', 'CategoryController@update_status');
    Route::post('category/delete_category', 'CategoryController@delete_category');
    Route::get('category/edit_category/{id}', 'CategoryController@edit');
    Route::post('category/update_category/{id}', 'CategoryController@update_category');

    // subcategory route start
    Route::get('subcategory/add_subcategory', 'SubcategoryController@index');
    Route::get('subcategory/subcategory_list', 'SubcategoryController@subcategory_list');
    Route::post('subcategory/store_subcategory', 'SubcategoryController@store_subcategory');
    Route::post('subcategory/update_status', 'SubcategoryController@update_status');
    Route::post('subcategory/delete_subcategory', 'SubcategoryController@delete_subcategory');
    Route::get('subcategory/edit_subcategory/{id}', 'SubcategoryController@edit');
    Route::post('subcategory/update_subcategory/{id}', 'SubcategoryController@update_subcategory');

    // product route start
    Route::get('product/add_product', 'ProductController@add_product_view');
    Route::get('product/product_list', 'ProductController@index');
});
// backend routes end
