<?php

use App\Http\Controllers\MainpageController;
use App\Http\Controllers\ConductorsTreeController;
use App\Http\Controllers\GroupTreeController;
use App\Http\Controllers\RoomsController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
  Route::get('/conductors_tree', [ConductorsTreeController::class, 'index']);
  Route::get('/group_tree', [GroupTreeController::class, 'index']);
  Route::get('/rooms', [RoomsController::class, 'index']);
});
