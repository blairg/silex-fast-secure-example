<?php

namespace SilexExample\Service;

interface UserServiceInterface
{
    /**
     * @param $username
     * @param $password
     * @return mixed
     */
    public function checkUser($username, $password);
}