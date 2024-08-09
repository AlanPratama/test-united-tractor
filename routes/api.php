<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\CategoryProductController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post("/register", [AuthenticationController::class, 'register']);
Route::post("/login", [AuthenticationController::class, 'login']);
Route::get("/unauthorized", [AuthenticationController::class, 'unauthorized'])->name("unauthorized");

Route::middleware("auth:api")->group(function () {
    Route::post("/logout", [AuthenticationController::class, 'logout']);
    Route::get("/me", [UserController::class, 'me']);

    Route::get("/category-products", [CategoryProductController::class, 'index']);
    Route::get("/category-products/{id}", [CategoryProductController::class, 'show']);
    Route::post("/category-products", [CategoryProductController::class, 'store']);
    Route::put("/category-products/{id}", [CategoryProductController::class, 'update']);
    Route::delete("/category-products/{id}", [CategoryProductController::class, 'destroy']);

    Route::get("/products", [ProductController::class, 'index']);
    Route::get("/products/{id}", [ProductController::class, 'show']);
    Route::post("/products", [ProductController::class, 'store']);
    Route::put("/products/{id}", [ProductController::class, 'update']);
    Route::delete("/products/{id}", [ProductController::class, 'destroy']);

});
