<?php

namespace App\Repository;

interface AuthenticationRepositoryInterface {

    public function registerUser(array $data);
    public function loginUser(array $data);
    public function logoutUser();

}
