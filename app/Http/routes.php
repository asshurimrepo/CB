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

Route::get('/', function () {
    return redirect('/home');
});

Route::auth();

Route::group(['middleware' => 'auth'], function(){
	Route::get('/home', 'HomeController@index');
	Route::resource('project','ProjectsController');

	// Handles Uploads
	Route::get('/upload', 'UploadProjectsController@create');
	Route::post('/upload', 'UploadProjectsController@store');

	// Handles Showing Image
	Route::get('/image/{filename}', 'ImagesController@show');
	// Handles Showing Videos
	Route::get('/video/{filename}', 'VideosController@show');

	// Handles Autorespoders
	Route::post('/autoresponder/mailchimp', 'AutoResponderController@mailchimp');
	Route::post('/autoresponder/getresponse', 'AutoResponderController@getresponse');
});
