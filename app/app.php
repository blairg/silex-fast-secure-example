<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Silex\Provider\HttpFragmentServiceProvider;
use \Symfony\Component\Debug\ErrorHandler;
use \Symfony\Component\Debug\ExceptionHandler;

ini_set('display_errors', 0);
error_reporting(-1);
ErrorHandler::register();
ExceptionHandler::register();

$app = new Silex\Application();
$app['debug'] = (getenv('debug'));

$app->register(new HttpFragmentServiceProvider());

// Load the repositories
require __DIR__ . '/config/repositories.php';

// Load the services
require __DIR__ . '/config/services.php';

// Load the routes mapping
require __DIR__ . '/config/routing.php';

return $app;
