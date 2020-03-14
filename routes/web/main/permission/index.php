<?php

$router->group([
    'middleware' => 'auth',
    'prefix'     => '/role'
], function () use ($router) {

     // Role Permission
     Route::get('/index',function(){
        return view('modules.web.main.permission.index');
    });

});
