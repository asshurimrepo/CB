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

Route::group(['middleware' => 'web'], function(){
	// Handles Showing Image
	Route::get('/image/{filename}', 'ImagesController@show');
	// Handles Showing Videos
	Route::get('/video/{filename}', 'VideosController@show');
});

Route::group(['middleware' => 'auth'], function(){
	Route::get('/home', 'HomeController@index');
	Route::get('/help', 'PagesController@help');

	Route::get('/premade/data', 'PremadeVideosController@data');
	Route::resource('/premade', 'PremadeVideosController');
	Route::post('/premade/add-to-project', 'PremadeVideosController@addToProject');

	Route::resource('project','ProjectsController');

	// Handles Uploads
	Route::get('/upload', 'UploadProjectsController@create');
	Route::post('/upload', 'UploadProjectsController@store');

	/*Route::get('/{filename}', 'VideosController@show')
		->where('filename', '(video*).*');*/

	// Handles Autorespoders
	Route::post('/autoresponder/mailchimp', 'AutoResponderController@mailchimp');
	Route::post('/autoresponder/getresponse', 'AutoResponderController@getresponse');
	Route::get('/autoresponder/aweber/authorize', 'AutoResponderController@aweberAuthorize');
	Route::post('/autoresponder/aweber/access_token', 'AutoResponderController@aweberAccessToken');
	Route::post('/autoresponder/aweber', 'AutoResponderController@aweber');

	// Handles Video Processer
	Route::post('/video-processer/{project}', 'VideoProcesserController@distillVideo');
	Route::post('/video-processer/{project}/process-frames', 'VideoProcesserController@processFrames');
	Route::post('/video-processer/{project}/process-single-frame/{img}', 'VideoProcesserController@processSingleFrame');
	Route::post('/video-processer/{project}/recompose-video', 'VideoProcesserController@recomposeVideo');
	Route::post('/video-processer/{project}/finishing', 'VideoProcesserController@cleanUpVideo');
});
