<?php

use App\Http\Controllers\MainpageController;
use App\Http\Controllers\ConductorsController;
use App\Http\Controllers\GroupTreeController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
  Route::get('/landingPage', [MainpageController::class, 'index']);
  Route::get('/conductors', [ConductorsController::class, 'index']);
  Route::get('/group_tree', [GroupTreeController::class, 'index']);
});
