<?php

namespace App\Service;

use App\Repository\AuthenticationRepositoryInterface;

class AuthenticationService {
    protected $authenticationRepository;

    public function __construct(AuthenticationRepositoryInterface $authenticationRepository)
    {
        $this->authenticationRepository = $authenticationRepository;
    }

    public function registerUser(array $data) {
        return $this->authenticationRepository->registerUser($data);
    }

    public function loginUser(array $data) {
        return $this->authenticationRepository->loginUser($data);
    }

    public function logoutUser()
    {
        return $this->authenticationRepository->logoutUser();
    }

}
