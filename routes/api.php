<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


//Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/bookings', [BookingController::class, 'index']);
    Route::post('/bookings/create', [BookingController::class, 'create']);
    Route::post('/user/teams', [UserController::class, 'teams']);
    Route::post('/teams/accept', [TeamController::class, 'accept']);
    Route::post('/teams/reject', [TeamController::class, 'reject']);
    Route::resource('teams', TeamController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
});

        
Route::middleware('auth:sanctum')->post('/user', function (Request $request) {
    return $request->user();
});
