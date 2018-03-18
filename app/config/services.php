<?php

use SilexExample\Service\UserService;

$app['services.user'] = function ($app) {
    return new UserService($app['repository.user']);
};