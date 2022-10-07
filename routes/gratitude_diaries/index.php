<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'GratitudeDiaryIndexController');
Route::get('{gratitude_diaries}', 'GratitudeDiaryShowController');
Route::post('', 'GratitudeDiaryStoreController');
Route::put('{gratitude_diaries}', 'GratitudeDiaryUpdateController');
Route::delete('{gratitude_diaries}', 'GratitudeDiaryDestroyController');
