<?php

// use Illuminate\Routing\Route;

$router->group([
    'middleware' => 'auth',
    'prefix'     => '/noc'
], function () use ($router) {
    // CRUD
    Route::get('/dashboard','web\main\NocController@dashboard')->name('noc-dashboard');
    Route::get('/form','web\main\NocController@formTicket');
    Route::get('/edit/{param}','web\main\NocController@editTicket');
    Route::post('/store/','web\main\NocController@store');
    Route::post('/update/{param}','web\main\NocController@update');
    Route::post('/import','web\main\NocController@importDataExcel');
    Route::post('/export','web\main\NocController@exportDataExcel');

});

$router->group([
    'prefix' => '/noc/api/',
], function () use ($router) {

    // Route ServerSide
    // Route::get('/data-met','web\main\NocController@dataMet');
    // Route::get('/data-miss','web\main\NocController@dataMiss');
    // Route::get('/dashboard-table', 'web\main\NocController@dataAll');
    // Route::post('/data-chart', 'web\main\NocController@dataMissMet');
    // Route::get('/data-reg', 'web\main\NocController@dataGropingByReg');
    // Route::post('/data-reg', 'web\main\NocController@dataGropingByReg');

    Route::get('all',           'web\main\NocController@getDataAll');
    Route::get('miss',          'web\main\NocController@getDataMiss');
    Route::get('met',           'web\main\NocController@getDataMet');
    Route::get('incident',      'web\main\NocController@getDataIncident');
    Route::get('request',       'web\main\NocController@getDataRequest');
    Route::get('group-met',     'web\main\NocController@getDataGroupByMet');
    Route::get('group-miss',    'web\main\NocController@getDataGroupByMiss');

    Route::get('dump','web\main\NocController@getDataDump');
});
