<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogsController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\LoginController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


    Route::get('/blog', [BlogsController::class, 'index']);
    Route::get('/brand', [BrandController::class, 'index']);
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/product', [ProductController::class, 'index']);

    //login member
    Route::post('/login',[LoginController::class, 'login']);
    Route::middleware('auth:sanctum')->group( function () {
        Route::get('user', [LoginController::class, 'user']);
    });

