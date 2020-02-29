<?php

$router->group([
    // 'middleware' => 'web',
    'prefix'     => ''
], function () use ($router) {
    include __DIR__.'/main/index.php';
});
