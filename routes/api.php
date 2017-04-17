<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => '1.0'], function(){
    Route::group(['prefix' => 'user'], function(){
        Route::get('role', 'Admin\Settings\UserRoleSettingsController@index')->name('api.user.role');//->middleware('auth:api');
        Route::post('role', 'Admin\Settings\UserRoleSettingsController@store')->name('api.user.role.add');
    });
});
