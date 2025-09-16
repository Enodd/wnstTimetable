<?php

use Illuminate\Support\Facades\Route;

Route::middleware(App\Http\Middleware\SetLocale::class)->group(function () {
    Route::group(['prefix' => '{locale}', 'where' => ['locale' => implode('|', config('app.supported_languages'))]], function () {
        Route::get('/', fn() => view('welcome'));
    });
    Route::get('/', fn() => null);
});
