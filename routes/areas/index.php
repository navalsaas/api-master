<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'AreaIndexController');
Route::get('{area}', 'AreaShowController');
Route::post('', 'AreaStoreController');
Route::put('{area}', 'AreaUpdateController');
Route::delete('{area}', 'AreaDestroyController');
