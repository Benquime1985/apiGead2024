<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ItemsAndServicesController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

    Route::apiResource('/rol',RoleController::class);
    Route::apiResource('/user',UserController::class);
    Route::apiResource('/position',PositionController::class);
    Route::apiResource('/space',SpaceController::class);
    Route::apiResource('/itemsandservice',ItemsAndServicesController::class);
    Route::apiResource('/equipment',EquipmentController::class);
    Route::apiResource('/reservation',ReservationController::class);

    Route::get('reservation/details/{id}', [ReservationController::class, 'details']);
