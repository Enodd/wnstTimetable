<?php

//use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainpageController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
  $mainPageContent = MainpageController::index();
  return Inertia::render('LandingPage', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
    'mainPageContent' => $mainPageContent,
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
  ]);
});

require __DIR__ . '/api.php';

//Route::get('/dashboard', function () {
//  return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

//require __DIR__ . '/auth.php';
