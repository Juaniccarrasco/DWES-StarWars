<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ShipController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('admin')
    ->middleware('adminMid')
    ->group(function(){
        Route::get('/users', [Controller::class, 'getUsers']);
        Route::get('/user/{id}',[Controller::class, 'getUser'])->whereNumber('id');
        Route::post('/postUser',[Controller::class, 'postUser'])->middleware('userMid');
        Route::delete('/delete/{id}',[Controller::class, 'deleteUser'])->whereNumber('id');
        Route::put('/putUpdate/{id}',[Controller::class, 'putUser'])->middleware('userMid')->whereNumber('id');
        //extract
        Route::patch('/patchUpdate/{id}',[Controller::class, 'patchUser'])->middleware('userMid')->whereNumber('id');
    });

Route::prefix('ship')
    //->middleware('adminMid')
    ->group(function(){
        // Route::get('/get', [ShipController::class, 'getShips']);
        // Route::get('/get/{id}', [ShipController::class, 'getShips'])->whereNumber('id');
        // Route::post('post',ShipController::class, 'post')->middleware('shipMid');

    });
