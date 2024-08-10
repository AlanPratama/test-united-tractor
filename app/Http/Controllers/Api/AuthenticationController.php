<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Service\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthenticationController extends Controller
{

    protected $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email:rfc|unique:users,email",
            "password" => "required|min:6",
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "Registration failed",
                "errors" => $validator->errors()
            ], 422);
        }


        $response = $this->authenticationService->registerUser($request->all());

        return response()->json([
            "status" => "success",
            "message" => "Register user successfully",
            "data" => [
                "user" => $response["user"],
                "access_token" => [
                    "token" => $response["token"],
                    "type" => "Bearer",
                    "expires_in" => auth()->factory()->getTTL() * 60
                ]
            ]
        ], 200);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" => "required|email:rfc",
            "password" => "required|min:6",
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "Login failed",
                "errors" => $validator->errors()
            ], 422);
        }

        $token = $this->authenticationService->loginUser($request->all());

        if(!$token) {
            return response()->json([
                "status" => "failed",
                "message" => "Invalid credentials"
            ], 401);
        }

        return response()->json([
            "status" => "success",
            "message" => "Login successfully",
            "data" => [
                "user" => auth()->user(),
                "access_token" => [
                    "token" => $token,
                    "type" => "Bearer",
                    "expires_in" => auth()->factory()->getTTL() * 60
                ]
            ]
        ], 200);
    }


    public function logout()
    {
        $invalidate = $this->authenticationService->logoutUser();

        if($invalidate) {
            return response()->json([
                "status" => "success",
                'message' => 'Successfully logged out',
                'data' => []
            ], 200);
        }

        return response()->json([
            "status" => "failed",
            "message" => "Unauthorized"
        ], 401);
    }


    public function unauthorized() {
        return response()->json([
            "status" => "failed",
            "message" => "Unauthorized"
        ], 401);
    }

}
