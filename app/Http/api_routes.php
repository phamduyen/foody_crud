<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where all API routes are defined.
|
*/





Route::resource('categories', 'CategoryAPIController');

Route::resource('foods', 'FoodAPIController');

Route::resource('roles', 'RoleAPIController');

Route::resource('pages', 'PageAPIController');

Route::resource('roles', 'RoleAPIController');

Route::resource('users', 'UserAPIController');

Route::resource('roles', 'RoleAPIController');