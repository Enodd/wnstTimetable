<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use \App\Http\Controllers\TimetableController;

Route::get('/', [LandingPageController::class, 'index']);
Route::get('/search', [SearchController::class, 'index']);
Route::prefix('timetable')->group(function () {
    Route::get('/groups/{groupId}', [TimetableController::class, 'groups']);
});
