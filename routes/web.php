<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//http://laravel.io/forum/02-17-2015-laravel-5-routes-restricting-based-on-user-type

Route::get('/','HomeController@index')->name('home');

Route::get('product-view/{id?}','HomeController@productView');

Route::get('products-in/{id?}','HomeController@productsAll');

Route::get('/search','api\SearchController@search');
Route::get('/get-search-data','api\SearchController@getData');

Route::post('checkout','guestCartController@checkout');
Route::get('pending-orders','guestCartManager@displayCart');


Route::post('quantityPlus','guestCartController@updatePlusQuantity');
Route::post('quantityMinus','guestCartController@updateMinusQuantity');
Route::post('productDelete','guestCartController@deleteProductRow');

//=======================================================================================
// Routes for Home Page
Route::get('login', 'CustomerAuth\LoginController@showLoginForm');

Route::get('register', 'CustomerAuth\RegisterController@showRegistrationForm');
// Home Page routes end here



//=======================================================================================

//Admin Login
Route::get('admin/login', 'AdminAuth\LoginController@showLoginForm');
Route::post('admin/login', 'AdminAuth\LoginController@login');
Route::post('admin/logout', 'AdminAuth\LoginController@logout');

//Admin Register
Route::get('admin/register', 'AdminAuth\RegisterController@showRegistrationForm');
Route::post('admin/register', 'AdminAuth\RegisterController@register');

//Admin Passwords
Route::post('admin/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
Route::post('admin/password/reset', 'AdminAuth\ResetPasswordController@reset');
Route::get('admin/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
Route::get('admin/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');


//Seller Login
Route::get('seller/login', 'SellerAuth\LoginController@showLoginForm');
Route::post('seller/login', 'SellerAuth\LoginController@login');
Route::post('seller/logout', 'SellerAuth\LoginController@logout');

//Seller Register
Route::get('seller/register', 'SellerAuth\RegisterController@showRegistrationForm');
Route::post('seller/register', 'SellerAuth\RegisterController@register');

//Seller Passwords
Route::post('seller/password/email', 'SellerAuth\ForgotPasswordController@sendResetLinkEmail');
Route::post('seller/password/reset', 'SellerAuth\ResetPasswordController@reset');
Route::get('seller/password/reset', 'SellerAuth\ForgotPasswordController@showLinkRequestForm');
Route::get('seller/password/reset/{token}', 'SellerAuth\ResetPasswordController@showResetForm');


//Customer Login
Route::get('customer/login', 'CustomerAuth\LoginController@showLoginForm');
Route::post('customer/login', 'CustomerAuth\LoginController@login');
Route::get('logout',function() {
    return view('user.logout');   
})->name('afterLogout');
Route::post('customer/logout', 'CustomerAuth\LoginController@logout');

//Customer Register
Route::get('customer/register', 'CustomerAuth\RegisterController@showRegistrationForm');
Route::post('customer/register', 'CustomerAuth\RegisterController@register');

//Customer Passwords
Route::post('customer/password/email', 'CustomerAuth\ForgotPasswordController@sendResetLinkEmail');
Route::post('customer/password/reset', 'CustomerAuth\ResetPasswordController@reset');
Route::get('customer/password/reset', 'CustomerAuth\ForgotPasswordController@showLinkRequestForm');
Route::get('customer/password/reset/{token}', 'CustomerAuth\ResetPasswordController@showResetForm');

