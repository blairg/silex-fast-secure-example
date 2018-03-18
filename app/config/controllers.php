<?php

use SilexExample\Controller\LoginController;

/**
 * Register custom controllers
 */

$app->register(new \Silex\Provider\ServiceControllerServiceProvider());

$app['controllers.login'] = function ($app) {
    return new LoginController($app['services.user']);
};