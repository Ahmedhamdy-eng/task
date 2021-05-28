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

        

Route::prefix('dashboard')->prefix('dashboard')->name('dashboard.')->group(function () {

#Auth
//GEt Login
Route::get('login','AdminAuthController@showLogin')->name('show.login');
//Post Login 
Route::post('login','AdminAuthController@setLoginData')->name('login');

});//end of dashboard routes
   

//route group
Route::name('dashboard.')->prefix('dashboard')->middleware('auth:admin')->group(function(){ 

//Home Page
Route::get('/', 'WelcomeController@index')->name('welcome');


//logout
Route::post('logout','AdminAuthController@logout')->name('logout');

#users Module

//Admins Resource
Route::Resource('users', 'UsersController')->except('show');



});// end of dashboard Routes (prefix)  

    
