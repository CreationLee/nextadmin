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

<<<<<<< HEAD
Route::group(['namespace'=>'Admin', 'prefix'=>'/admin', 'middleware'=>'admin'], function() {
    Route::get('login','AdminAuthController@login');

    Route::get('test','TestController@test');

});
=======

<<<<<<< HEAD

Route::group(['prefix' => 'admin', 'namespace'=>'Admin'], function () {

    Route::get('login', ['uses' => 'AdminAuthController@login', 'as' => 'login']);

    Route::group(['middleware'=>'admin'], function (){
        Route::get('/', ['uses' => 'IndexController@index',   'as' => 'dashboard']);
    });




});
=======
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
>>>>>>> 29b76a6f22d2c5f4250bcbdbe281b0f1197945d2
>>>>>>> 45ef0167b8612174e00cd4c57dae797c0e0729ac
