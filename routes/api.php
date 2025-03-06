<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//public Routes
Route::get('location',[LocationController::class,'index']);
Route::post('location',[LocationController::class,'createLocation']);
Route::get('location/{id}',[LocationController::class,'getLocation']);
Route::put('location/{id}',[LocationController::class,'updateLocation']);
Route::delete('location/{id}',[LocationController::class,'deleteLocation']);

//Restaurant routes
Route::get('restaurant',[RestaurantController::class,'index']);
Route::post('restaurant',[RestaurantController::class,'createRestaurant']

);