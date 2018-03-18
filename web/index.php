<?php

ini_set('display_errors', 0);

$app = require __DIR__ . '/../app/app.php';

if ($app instanceof Silex\Application) {
    $app->run();
} else {
    echo 'An error occurred';
}
