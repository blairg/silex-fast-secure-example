<?php

use MongoDB\Client;
use SilexExample\Repository\UserRepository;

$app['mongo.collection'] = function () {
    $client = new Client('mongodb://mongo_database/');
    return $client->silexexample->users;
};

$app['repository.user'] = function ($app) {
    return new UserRepository($app['mongo.collection']);
};