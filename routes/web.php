<?php

//use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainpageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TimeTable;
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

Route::get('/search', function(\Illuminate\Http\Request $request) {
    $results = SearchController::query($request);
    $query = $request->get('q') ?? '';
    $pageNr = (int)($request->input('p') ?? 1);
    $pageSize = (int)($request->input('s') ?? 40);
    $resultsSlice = $results;
    if (count($results) > $pageSize) {
        $resultsSlice = array_slice($results, ($pageNr - 1) * $pageSize, $pageSize);
    }
    return Inertia::render('SearchResults', [
        'query' => $query,
        'searchResults' => $resultsSlice,
        'totalPages' => ceil(count($results) / $pageSize),
        'page' => $pageNr,
    ]);
});

Route::get('/conductors/{conductor}', function($conductor) {
    $results = TimeTable::conductor($conductor);
    return Inertia::render('Timetable', [
        'data' => $results
    ]);
});
Route::get('/rooms/{roomNr}', function($roomNr) {
    $results = TimeTable::room($roomNr);
    return Inertia::render('Timetable', [
        'data' => $results
    ]);
});
Route::get('/groups/{groupShortcut}', function($groupShortcut) {
    $results = TimeTable::group($groupShortcut);

    return Inertia::render('Timetable', [
        'data' => $results
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
