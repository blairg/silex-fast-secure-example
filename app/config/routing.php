<?php

//use Symfony\Component\HttpFoundation\Request;

/**
 * Define the application routes
 */


$app->post('/hello', 'controllers.login:helloAction');
$app->post('/login', 'controllers.login:loginAction');
//$app->post('/token', 'controllers.token:tokenAction');

require __DIR__ . '/controllers.php';