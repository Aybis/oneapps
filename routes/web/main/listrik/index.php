<?php

$router->group([
    'middleware' => 'auth',
    'prefix'     => '/listrik'
], function () use ($router) {

    // Route Listrik
    Route::get('/form/','web\main\ListrikController@form');
    Route::get('/edit/{param}','web\main\ListrikController@edit');
    Route::get('/list-data/','web\main\ListrikController@listrik');
    Route::post('/store/','web\main\ListrikController@store');
    Route::get('/delete/','web\main\ListrikController@destroy');
    Route::get('/export/', 'web\main\ListrikController@export');
    Route::get('/header/','web\main\ListrikController@destroy');

    // Route Ajax
    Route::get('/data/','web\main\ListrikController@ajaxData');
    Route::get('/detail/{param}','web\main\ListrikController@detailDataPelanggan');

});
