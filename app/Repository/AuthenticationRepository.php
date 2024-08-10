<?php

namespace App\Repository;

use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthenticationRepository implements AuthenticationRepositoryInterface
{

    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function registerUser(array $data)
    {
        $user = $this->user->create([
            "email" => $data["email"],
            "password" => bcrypt($data["password"])
        ]);

        $token = auth()->login($user);

        return [
            "user" => $user,
            "token" => $token
        ];
    }

    public function loginUser(array $data)
    {
        return auth()->attempt([
            "email" => $data["email"],
            "password" => $data["password"]
        ]);
    }

    public function logoutUser()
    {
        $token = JWTAuth::getToken();

        return JWTAuth::invalidate($token) || null;
    }

}
