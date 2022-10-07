<?php

use Illuminate\Support\Facades\Route;

// Authentication Routes...
// Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login');

Route::get('me', 'MeShowController')->middleware('auth');

Route::put('me', 'MeUpdateController')->middleware('auth');

Route::post('logout', 'LoginController@logout')->middleware('auth');

Route::put('password', 'MeUpdatePasswordController')->middleware('auth', 'check_password');

Route::post('register', 'RegisterController@register');

/*
Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');

Route::post('password/reset', 'ResetPasswordController@reset');
Route::get('email/verify/{id}/{hash}', 'VerificationController@verify');
Route::post('email/resend', 'VerificationController@resend');
//*/
