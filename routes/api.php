<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;

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

Route::get('/hello', function () {
    return ('holis');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'auth'
], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
    Route::get('destroy', [AuthController::class, 'destroy']);
    Route::get('show', [AuthController::class, 'show']);
    Route::get('index', [AuthController::class, 'index']);
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::group([
    'prefix' => 'movies'
], function () {
    Route::group([
        'prefix' =>'admin',
        'middleware' => ['auth:api', 'role:admin'],
    ],function(){
        Route::post('/', [MovieController::class, 'create']);
        Route::get('/{id}', [MovieController::class, 'show']);
        Route::get('/', [MovieController::class, 'index']);
        Route::put('/{id}', [MovieController::class, 'update']);
        Route::delete('/{id}', [MovieController::class, 'destroy']);
    });

    Route::group([
        'prefix' => 'user',
        'middleware' => ['auth:api', 'role:user'],
    ],function(){
        Route::get('/{id}', [MovieController::class, 'show']);
        Route::get('/', [MovieController::class, 'index']);
    });
});