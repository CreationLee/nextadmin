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


Route::group(['prefix' => 'admin', 'namespace'=>'Admin'], function () {

    Route::get('login', ['uses' => 'AdminAuthController@login', 'as' => 'login' ]);
    Route::post('login', ['uses' => 'AdminAuthController@postLogin', 'as' => 'postlogin']);

    Route::group(['middleware'=>'admin', 'as' => 'admin.'], function (){
        Route::get('/', ['uses' => 'AdminController@index',   'as' => 'dashboard']);
        Route::post('logout', ['uses' => 'AdminController@logout',  'as' => 'logout']);
        Route::post('logout', ['uses' => 'AdminController@logout',  'as' => 'logout']);
        Route::get('profile', ['uses' => 'AdminController@profile', 'as' => 'profile']);

    });

});
