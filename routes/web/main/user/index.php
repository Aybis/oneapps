<?php

$router->group([
    'middleware' => 'auth',
    'prefix'     => '/user'
], function () use ($router) {

    // Route Users Form
    Route::get('/index-users','web\main\UserController@index');
    Route::get('/form-users','web\main\UserController@form');
    Route::post('/store-users','web\main\UserController@store');


});
