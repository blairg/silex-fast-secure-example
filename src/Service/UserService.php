<?php

namespace SilexExample\Service;

use SilexExample\Repository\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $username
     * @param $password
     * @return mixed
     */
    public function checkUser($username, $password)
    {
        if (empty($username) || empty($password)) {
            return null;
        }

        return $this->userRepository->checkUser($username, sha1($password));
    }
}
