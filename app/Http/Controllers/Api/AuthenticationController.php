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

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email:rfc|unique:users,email",
            "password" => "required|min:8",
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => "failed",
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
            "status" => "success",
            "message" => "User created successfully",
            "data" => [
                "user" => $user,
                "token" => $token
            ]
        ], 200);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" => "required|email:rfc",
            "password" => "required|min:8",
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => "failed",
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
                "status" => "failed",
                "message" => "Invalid credentials"
            ], 401);
        }

        return response()->json([
            "status" => "success",
            "message" => "User created successfully",
            "data" => [
                "user" => auth()->user(),
                "token" => $token
            ]
        ], 200);
    }


    public function logout()
    {
        $token = JWTAuth::getToken();

        $invalidate = JWTAuth::invalidate($token);

        if($invalidate) {
            return response()->json([
                "status" => "success",
                'message' => 'Successfully logged out',
                'data' => []
            ], 200);
        }
    }


    public function unauthorized() {
        return response()->json([
            "status" => "failed",
            "message" => "Unauthorized"
        ], 401);
    }

}
