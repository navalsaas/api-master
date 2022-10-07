<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'TaskIndexController');
Route::get('{task}', 'TaskShowController');
Route::post('', 'TaskStoreController');
Route::put('{task}', 'TaskUpdateController');
Route::put('{task}/toggle', 'TaskToggleController');
Route::delete('{task}', 'TaskDestroyController');
