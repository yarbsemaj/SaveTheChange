<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'OauthController@authorise');

Route::get('/user', function () {
    return apiRequestForCurrentUser("/api/v1/customers", "GET");
});

Route::get('api/callback', 'OauthController@authorise');



