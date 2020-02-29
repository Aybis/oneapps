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
Auth::routes();

Route::get('/', function () {
    return view('layouts.master');
});
Route::get('/index-users','web\main\UserController@index');
Route::get('/form-users','web\main\UserController@form');
Route::post('/store-users','web\main\UserController@store');

include __DIR__.'/web/index.php';
