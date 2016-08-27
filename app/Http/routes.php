<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['prefix' => 'admin'], function(){
	//Open routes
	Route::get('/', 'Admin\AdminController@index');
	Route::get('index', 'Admin\AdminController@index');
	Route::get('about', 'Admin\AdminController@about');

	//Settings
	Route::get('settings', 'Admin\AdminController@settings');

	//Users
	Route::get('users', [
		'as' => 'users.index',
		'uses' => 'Admin\AdminController@userIndex',
		]);

	//projects
	Route::get('projects', [
			'as' => 'projects.index',
			'uses' => 'Admin\ProjectController@index',
		]);
	Route::get('projects/{project}/edit', [
			'as' => 'projects.edit',
			'uses' => 'Admin\ProjectController@edit',
		]);

	//project properties
	Route::get('properties', [
			'as' => 'properties.index',
			'uses' => 'Admin\PropertyController@index',
		]);

	Route::get('properties/{id}', [
			'as' => 'properties.show',
			'uses' => 'Admin\PropertyController@editProperty',
		]);

	//Messages
	Route::get('messages', [
			'as' => 'messages.index',
			'uses' => 'Admin\MessageController@index',
		]);

	Route::group(['middleware' => 'demouser'], function () {
		//Settings
		Route::get('settings/remove/{setting}', 'Admin\AdminController@removeSettings');
		Route::post('settings', 'Admin\AdminController@upadateSettings');
		Route::post('settings/add', 'Admin\AdminController@addSettings');
		//Users
		Route::group(['prefix' => 'users'], function() {
			Route::delete('{user}', [
					'as' => 'users.destroy',
					'uses' => 'Admin\AdminController@userDestroy'
				]);
			Route::post('', [
				'as' => 'users.store',
				'uses' => 'Admin\AdminController@userStore',
				]);
			Route::get('{user}/edit', [
					'as' => 'users.edit',
					'uses' => 'Admin\AdminController@userEdit',
				]);
			Route::put('{user}', [
					'as' => 'users.update',
					'uses' => 'Admin\AdminController@userUpdate'
				]);
		});
		//projects
		Route::group(['prefix' => 'projects'], function() {
			Route::get('create', [
					'as' => 'projects.create',
					'uses' => 'Admin\ProjectController@create',
				]);
			Route::post('', [
					'as' => 'projects.store',
					'uses' => 'Admin\ProjectController@store',
				]);
			Route::put('{project}', [
					'as' => 'projects.update',
					'uses' => 'Admin\ProjectController@update',
				]);
			Route::delete('{project}', [
					'as' => 'projects.destroy',
					'uses' => 'Admin\ProjectController@destroy'
				]);
			Route::delete('gallery/{gallery}', [
					'as' => 'projects.gallery.destroy',
					'uses' => 'Admin\ProjectController@destroyGalleryItem'
				]);
			Route::delete('property/{property}', [
					'as' => 'projects.property.destroy',
					'uses' => 'Admin\ProjectController@destroyProjectProperty'
				]);
		});
		Route::group(['prefix' => 'properties'], function() {
			//project properties
			Route::delete('{property}', [
					'as' => 'properties.destroy',
					'uses' => 'Admin\PropertyController@removeProperty',
				]);
			Route::post('add', [
					'as' => 'properties.add',
					'uses' => 'Admin\PropertyController@addProperty',
				]);
			Route::put('{property}', [
					'as' => 'properties.update',
					'uses' => 'Admin\PropertyController@updateProperty',
				]);
		});
		//Messages
		Route::group(['prefix' => 'messages'], function() {
			Route::get('{message}', [
					'as' => 'messages.show',
					'uses' => 'Admin\MessageController@viewMessage',
				]);
			Route::delete('{message}', [
					'as' => 'messages.destroy',
					'uses' => 'Admin\MessageController@removeMessage',
				]);
			Route::put('{message}', [
					'as' => 'messages.updatestatus',
					'uses' => 'Admin\MessageController@updateStatus',
				]);
			Route::delete('blacklist/{blacklisted}', [
					'as' => 'messages.blacklist.remove',
					'uses' => 'Admin\MessageController@blacklistRemove',
				]);
			Route::post('blacklist/{blacklisted}', [
					'as' => 'messages.blacklist.add',
					'uses' => 'Admin\MessageController@blacklistAdd',
				]);
			Route::get('email/reply/{message}', [
					'as' => 'email.reply',
					'uses' => 'Admin\EmailController@index',
				]);
			Route::post('email/send', [
					'as' => 'email.send',
					'uses' => 'Admin\EmailController@sendEmail',
				]);
		});
	});
});


Route::auth();

/*
 * Frontend
 */
Route::get('/', [
		'as' => 'front.index',
		'uses' => 'HomeController@index',
	]);
Route::post('setlocale', [
		'as' => 'front.setLocale',
		'uses' => 'HomeController@setLocale',
	]);
Route::get('get/{project}', [
		'as' => 'front.project',
		'uses' => 'HomeController@getProject',
	]);
Route::post('sendmessage', [
		'as' => 'front.message',
		'uses' => 'HomeController@addMessage',
	]);

//Route::resource('temp', 'TempController');