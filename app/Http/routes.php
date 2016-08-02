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
	Route::get('users', 'Admin\AdminController@users');

	//projects
	Route::get('projects', 'Admin\ProjectController@index');
	Route::get('projects/edit/{project}', 'Admin\ProjectController@edit');

	//project properties
	Route::get('properties', 'Admin\PropertyController@index');

	Route::post('properties/edit/{id}', 'Admin\PropertyController@editProperty');

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
		Route::get('users/remove/{user}', 'Admin\AdminController@removeUsers');
		Route::post('users/add', 'Admin\AdminController@addUsers');
		Route::post('users/update', 'Admin\AdminController@updateUser');
		Route::post('users/edit/{id}', 'Admin\AdminController@editUser');
		//projects
		Route::get('projects/add', 'Admin\ProjectController@add');
		Route::get('projects/remove/{project}', 'Admin\ProjectController@removeProject');
		Route::post('projects/update', 'Admin\ProjectController@create');
		Route::post('projects/update/{project}', 'Admin\ProjectController@update');
		Route::post('projects/gallery/remove/{gallery}', 'Admin\ProjectController@removeGalleryItem');
		Route::post('projects/property/remove/{property}', 'Admin\ProjectController@removeProjectProperty');
		//project properties
		Route::get('properties/remove/{property}', 'Admin\PropertyController@removeProperty');
		Route::post('properties/add', 'Admin\PropertyController@addProperty');
		Route::post('properties/update', 'Admin\PropertyController@updateProperty');
		//Messages
		Route::get('messages/{message}', [
				'as' => 'messages.show',
				'uses' => 'Admin\MessageController@viewMessage',
			]);
		Route::delete('messages/{message}', [
				'as' => 'messages.destroy',
				'uses' => 'Admin\MessageController@removeMessage',
			]);
		Route::post('setstatus/{message}', 'Admin\MessageController@setStatus');
		Route::get('blacklist/remove/{blacklisted}', 'Admin\MessageController@blacklistRemove');
		Route::get('blacklist/add/{blacklisted}', 'Admin\MessageController@blacklistAdd');
		Route::get('replyto/{message}', 'Admin\EmailController@index');
		Route::post('email/send', 'Admin\EmailController@sendEmail');
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
Route::get('/get/{project}', [
		'as' => 'front.project',
		'uses' => 'HomeController@getProject',
	]);
Route::post('/sendmessage', [
		'as' => 'front.message',
		'uses' => 'HomeController@addMessage',
	]);

//Route::resource('temp', 'TempController');