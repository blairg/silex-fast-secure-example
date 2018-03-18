<?php

namespace SilexExample\Controller;

use SilexExample\Service\UserServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LoginController
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * LoginController constructor.
     * @param UserServiceInterface $mongoService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function loginAction(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        if (empty($username) || empty($password)) {
            return new JsonResponse('access denied',401);
        }

        $loginResponse = $this->userService->checkUser($username, $password);

        if (is_bool($loginResponse) && !$loginResponse) {
            return new JsonResponse('unauthorised',401);
        }

        return new JsonResponse($loginResponse,200);
    }
}