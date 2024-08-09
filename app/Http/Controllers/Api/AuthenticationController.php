<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthenticationController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function d() { return response()->json("asasaasa"); }

    public function register(Request $request)
    {
        // $this->validate($request, [
        //     "email" => "required|unique:users,email",
        //     "password" => "required|min:8",
        // ]);

        $validator = Validator::make($request->all(), [
            "email" => "required|email:rfc,dns|unique:users,email",
            "password" => "required|min:8",
        ]);

        if($validator->fails()) {
            return response()->json([
                "message" => "Registration failed",
                "errors" => $validator->errors()
            ], 422);
        }

        $user = $this->user->create([
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);

        $token = auth()->login($user);

        return response()->json([
            "message" => "User created successfully",
            "data" => [
                "user" => $user,
                "token" => $token
            ]
        ], 201);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" => "required|email:rfc,dns",
            "password" => "required|min:8",
        ]);

        if($validator->fails()) {
            return response()->json([
                "message" => "Login failed",
                "errors" => $validator->errors()
            ], 422);
        }

        $token = auth()->attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        if(!$token) {
            return response()->json([
                "message" => "Invalid credentials"
            ], 401);
        }

        return response()->json([
            "message" => "User created successfully",
            "data" => [
                "user" => auth()->user(),
                "token" => $token
            ]
        ]);
    }


    public function logout()
    {
        $token = JWTAuth::getToken();

        $invalidate = JWTAuth::invalidate($token);

        if($invalidate) {
            return response()->json([
                'message' => 'Successfully logged out',
                'data' => []
            ]);
        }

    }


    public function unauthorized() {
        return response()->json([
            "message" => "Unauthorized"
        ], 401);
    }

}
