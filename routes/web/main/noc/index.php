<?php

$router->group([
    'middleware' => 'auth',
    'prefix'     => '/noc'
], function () use ($router) {

  // Route NOC
  Route::get('/data-met','web\main\NocController@dataMet');
  Route::get('/data-miss','web\main\NocController@dataMiss');
  Route::post('/dashboard-table', 'web\main\NocController@dataAll');
  Route::post('/data-chart', 'web\main\NocController@dataMissMet');
  Route::get('/dashboard','web\main\NocController@dashboard');
  Route::get('/form','web\main\NocController@formTicket');
  Route::get('/edit','web\main\NocController@editTicket');
  Route::post('/store/','web\main\NocController@store');

});
