<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Roky\CustomerUpdate\Controllers\CustomerUpdateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::prefix('api/customer')->group(function(){
    Route::controller(CustomerUpdateController::class)->group(function(){
        Route::get('/', 'index');
        Route::post('/update/{id}', 'update');
        Route::post('/store', 'store');
    });
});
