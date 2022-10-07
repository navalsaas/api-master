<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'GoalIndexController');
Route::get('{goal}', 'GoalShowController');
Route::post('', 'GoalStoreController');
Route::put('{goal}', 'GoalUpdateController');
Route::delete('{goal}', 'GoalDestroyController');
