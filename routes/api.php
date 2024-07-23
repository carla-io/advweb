<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization, X-Auth-Token');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, HEAD, OPTIONS');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\ProductController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//Register

Route::post("register", [ApiController::class,"register"]);

//Login

Route::post("login", [ApiController::class,"login"]);

Route::get('products', [ProductController::class, 'index']);
Route::post('create-product', [ProductController::class, 'create']);
Route::post('update-product', [ProductController::class, 'update']);
Route::post('delete-product', [ProductController::class, 'delete']);

