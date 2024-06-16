<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BusController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [UserController::class, 'register']);
Route::middleware('auth:sanctum')->get('user', [UserController::class, 'getUserDetails']);
Route::post('login', [UserController::class, 'login']);

Route::post('bus-info', [BusController::class, 'getBusInfo']);
Route::post('deduct-fare', [BusController::class, 'deductFare']);
Route::get('tickets', [BusController::class, 'getTickets']);