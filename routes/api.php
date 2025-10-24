<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PilotController;
use App\Http\Controllers\ShipController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('ship')
    //->middleware('auth:sanctum')
    ->group(function(){
        Route::get('/get', [ShipController::class, 'getShips']);
        Route::get('/get/{id}', [ShipController::class, 'getShip'])->whereNumber('id');
        Route::post('/post',[ShipController::class, 'postShip'])->middleware('shipMid');
        Route::delete('/delete/{id}',[ShipController::class, 'deleteShip'])->whereNumber('id');
        Route::put('/put/{id}',[ShipController::class, 'updateShip'])->whereNumber('id')->middleware('shipMid');
        Route::patch('/patch/{id}',[ShipController::class, 'patchShip'])->whereNumber('id');
    });

Route::prefix('pilot')
    ->group(function(){
        Route::post('/assign/{id_pilot}/{id_ship}', [PilotController::class, 'assignPilot'])
        ->whereNumber(['id_ship','id_pilot']);
        Route::post('/assignSome', [PilotController::class, 'assignPilots'])->middleware('arrayPilots');
    });

