<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'StreakIndexController');
Route::get('{streak}', 'StreakShowController');
Route::post('', 'StreakStoreController');
Route::put('{streak}', 'StreakUpdateController');
Route::delete('{streak}', 'StreakDestroyController');
