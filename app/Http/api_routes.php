<?php

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where all API routes are defined.
  |
 */


// authenticate
Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
Route::post('authenticate', 'AuthenticateController@authenticate');
Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
// Registration Routes...
Route::post('register', 'UserAPIController@store');
Route::get('logout', 'UserAPIController@logout');
Route::resource('categories', 'CategoryAPIController');

Route::resource('foods', 'FoodAPIController');

Route::resource('roles', 'RoleAPIController');

Route::resource('pages', 'PageAPIController');

Route::resource('roles', 'RoleAPIController');

Route::resource('users', 'UserAPIController');

Route::resource('roles', 'RoleAPIController');
