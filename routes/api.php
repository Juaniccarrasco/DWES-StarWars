<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ManteinanceController;
use App\Http\Controllers\PilotController;
use App\Http\Controllers\ShipController;
use App\Models\Manteinance;
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

        Route::get('list_no_pilot',[ShipController::class,'listWithoutPilot']);
    });

Route::prefix('pilot')
    ->group(function(){
        Route::post('/assign/{id_pilot}/{id_ship}', [PilotController::class, 'assignPilot'])
        ->whereNumber(['id_ship','id_pilot']);
        Route::post('/assignSome', [PilotController::class, 'assignPilots'])->middleware('arrayPilots');
        Route::patch('/unassign/{id_pilot}/{id_ship}', [PilotController::class,'unassignPilot'])->whereNumber(['id_pilot','id_ship']);
        Route::get('/pilots_assigned_history',[PilotController::class, 'historyPilotsAssigned']);
        Route::get('/pilots_assigned',[PilotController::class, 'listPilotsAssigned']);
    });

Route::prefix('manteinance')
    ->group(function(){
        Route::post('/{id_ship}',[ManteinanceController::class, 'postManteinance'])->whereNumber('id_pilot');
        Route::get('/{id_maintenance}', [ManteinanceController::class, 'getManteinance'])->whereNumber('id_maintenance');
        Route::get('/{initial_date}/{final_date}', [ManteinanceController::class, 'getManteinanceByDates']);
    });

