<?php

$router->group([
    'middleware' => 'auth',
    'prefix'     => '/menu'
], function () use ($router) {

    // Route Menu
    Route::get('/data/', function(){
        return view('modules.web._public.menu.index');
    })->name('menu.data');
    Route::get('/create/', function(){
        return view('modules.web._public.menu.create');
    });
    Route::post('/store/','web\_public\MenuController@storeMenu')->name('menu.store');

});
