<?php

$router->group([
    'middleware' => 'auth',
    // 'prefix'     => ''
], function () use ($router) {

    include __DIR__.'/noc/index.php';
    include __DIR__.'/user/index.php';
    include __DIR__.'/listrik/index.php';
    include __DIR__.'/menu/index.php';
    include __DIR__.'/permission/index.php';
    include __DIR__.'/menu/index.php';


    Route::get('/', function () {
        // return view('modules.web.home.index');
        return redirect('/noc/dashboard');
    });



});
