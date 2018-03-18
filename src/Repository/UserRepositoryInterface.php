<?php

namespace SilexExample\Repository;

interface UserRepositoryInterface
{
    /**
     * @param $username
     * @param $password
     * @return mixed
     */
    public function checkUser($username, $password);
}