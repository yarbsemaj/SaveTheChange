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
})->name("welcome");

Route::get('/login', 'OauthController@authorise');

Route::post('/logout', function () {
    session()->remove("user_id");
    return redirect(route("welcome"));
});

Route::post('/home', function () {
    return view("home");
});

Route::get('api/callback', 'OauthController@authorise');



