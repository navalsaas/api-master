<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'NoteIndexController');
Route::get('{note}', 'NoteShowController');
Route::post('', 'NoteStoreController');
Route::put('{note}', 'NoteUpdateController');
Route::delete('{note}', 'NoteDestroyController');
