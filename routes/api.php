<?php

use Illuminate\Http\Request;
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
Route::group([

    'middleware' => 'api',
    'prefix' => 'V1'

], function () {

   
    Route::post('verify', 'AuthController@verify');
    Route::post('user', 'AuthController@getUserData');

});

Route::group([

    'prefix' => 'V1'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
   

});