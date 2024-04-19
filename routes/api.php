<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\TravelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TourController;
use App\Http\Controllers\Api\V1\Admin\TravelController as AdminTravelController;
use App\Http\Controllers\Api\V1\Admin\TourController as AdminTourController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/travels',[TravelController::class,'index']);
Route::get('travels/{travel:slug}/tours',[TourController::class,'index']);

Route::prefix('admin')->middleware(['auth:sanctum','role'])->group(function(){
    Route::post('/travels',[AdminTravelController::class,'store']);
    Route::put('/travels/{travel}',[AdminTravelController::class,'update']);

    Route::post('travels/{travel}/tours', [App\Http\Controllers\Api\V1\Admin\TourController::class, 'store']);
    Route::put('tours/{tour}', [App\Http\Controllers\Api\V1\Admin\TourController::class, 'update']);
});

Route::post('/login',LoginController::class);
