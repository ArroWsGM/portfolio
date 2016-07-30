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
//Open routes
Route::get('/admin', 'Admin\AdminController@index');
Route::get('/admin/index', 'Admin\AdminController@index');
Route::get('/admin/about', 'Admin\AdminController@about');

//Settings
Route::get('/admin/settings', 'Admin\AdminController@settings');

//Users
Route::get('/admin/users', 'Admin\AdminController@users');

//projects
Route::get('/admin/projects', 'Admin\ProjectController@index');
Route::get('/admin/projects/edit/{project}', 'Admin\ProjectController@edit');

//project properties
Route::get('/admin/properties', 'Admin\PropertyController@index');

Route::post('/admin/properties/edit/{id}', 'Admin\PropertyController@editProperty');

//Messages
Route::get('/admin/messages', 'Admin\MessageController@index');

Route::group(['middleware' => 'demouser'], function () {
	//Settings
	Route::get('admin/settings/remove/{setting}', 'Admin\AdminController@removeSettings');
	Route::post('/admin/settings', 'Admin\AdminController@upadateSettings');
	Route::post('/admin/settings/add', 'Admin\AdminController@addSettings');
	//Users
	Route::get('/admin/users/remove/{user}', 'Admin\AdminController@removeUsers');
	Route::post('/admin/users/add', 'Admin\AdminController@addUsers');
	Route::post('/admin/users/update', 'Admin\AdminController@updateUser');
	Route::post('/admin/users/edit/{id}', 'Admin\AdminController@editUser');
	//projects
	Route::get('/admin/projects/add', 'Admin\ProjectController@add');
	Route::get('/admin/projects/remove/{project}', 'Admin\ProjectController@removeProject');
	Route::post('/admin/projects/update', 'Admin\ProjectController@create');
	Route::post('/admin/projects/update/{project}', 'Admin\ProjectController@update');
	Route::post('/admin/projects/gallery/remove/{gallery}', 'Admin\ProjectController@removeGalleryItem');
	Route::post('/admin/projects/property/remove/{property}', 'Admin\ProjectController@removeProjectProperty');
	//project properties
	Route::get('/admin/properties/remove/{property}', 'Admin\PropertyController@removeProperty');
	Route::post('/admin/properties/add', 'Admin\PropertyController@addProperty');
	Route::post('/admin/properties/update', 'Admin\PropertyController@updateProperty');
	//Messages
	Route::get('/admin/messages/view/{message}', 'Admin\MessageController@viewMessage');
	Route::get('/admin/messages/remove/{message}', 'Admin\MessageController@removeMessage');
	Route::post('/admin/setstatus/{message}', 'Admin\MessageController@setStatus');
	Route::get('/admin/blacklist/remove/{blacklisted}', 'Admin\MessageController@blacklistRemove');
	Route::get('/admin/blacklist/add/{blacklisted}', 'Admin\MessageController@blacklistAdd');
	Route::get('/admin/replyto/{message}', 'Admin\EmailController@index');
	Route::post('/admin/email/send', 'Admin\EmailController@sendEmail');
});

Route::auth();

/*
 * Frontend
 */
Route::get('/', 'HomeController@index');
Route::post('/get/{project}', 'HomeController@getProject');
Route::post('/sendmessage', 'HomeController@addMessage');
//Route::get('/get/{project}', array(
  //'uses'  =>  'HomeController@getProject'
//));