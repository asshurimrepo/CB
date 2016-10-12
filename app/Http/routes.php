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

/*Routes for Resource on Casters*/
Route::group(['middleware' => 'web'], function(){

	header('Access-Control-Allow-Origin: *');
	// header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Accept-Language, Content-Language, Authorization, X-Request-With, X-Access-Token, X-Application-Name, X-Request-Sent-Time');

	// Handles Showing Image
	Route::get('/image/{filename}', 'ImagesController@show');
	Route::get('/embed/image/{user}/{filename}', 'ImagesController@embed');
	// Handles Showing Videos
	Route::get('/video/{filename}', 'VideosController@show');
	Route::get('/embed/video/{user}/{filename}', 'VideosController@embed');

	Route::get('/embed/caster.js', 'EmbedController@show');
	Route::get('/embed.js/{id}', 'EmbedController@create');

	// Handles Autorespoders
	Route::post('/autoresponder/mailchimp', 'AutoResponderController@mailchimp');
	Route::post('/autoresponder/getresponse', 'AutoResponderController@getresponse');
	Route::get('/autoresponder/aweber/authorize', 'AutoResponderController@aweberAuthorize');
	Route::post('/autoresponder/aweber/access_token', 'AutoResponderController@aweberAccessToken');
	Route::post('/autoresponder/aweber', 'AutoResponderController@aweber');
	Route::post('/autoresponder/mailchimp/subscribe', 'AutoResponderController@mailchimpSubscribe');
	Route::post('/autoresponder/getresponse/subscribe', 'AutoResponderController@getresponseSubscribe');
	Route::post('/autoresponder/aweber/subscribe', 'AutoResponderController@aweberSubscribe');
	
	// Handles Video Processer
	Route::post('/video-processer/{project}', 'VideoProcesserController@distillVideo');
	Route::post('/video-processer/{project}/process-frames', 'VideoProcesserController@processFrames');
	Route::post('/video-processer/{project}/process-single-frame/{img}', 'VideoProcesserController@processSingleFrame');
	Route::post('/video-processer/{project}/recompose-video', 'VideoProcesserController@recomposeVideo');
	Route::post('/video-processer/{project}/finishing', 'VideoProcesserController@cleanUpVideo');
});

/*Routes for Member User*/
Route::group(['middleware' => ['auth', 'web']], function(){
	Route::get('/home', 'HomeController@index');
	Route::get('/help', 'PagesController@help');

	Route::get('/premade/data', 'PremadeVideosController@data');
	Route::resource('/premade', 'PremadeVideosController');
	Route::post('/premade/add-to-project', 'PremadeVideosController@addToProject');

	Route::get('/premade/{id}', 'PremadeVideosController@show');

	Route::resource('project','ProjectsController');

	// Handles Uploads
	Route::get('/upload', 'UploadProjectsController@create');
	Route::post('/upload', 'UploadProjectsController@store');

	/*Route::get('/{filename}', 'VideosController@show')
		->where('filename', '(video*).*');*/
});

/*Routes on Super User*/
Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Admin'], function(){
	Route::get('login', 'AuthController@page');
	Route::post('verify', 'AuthController@verify');
});

Route::group(['middleware' => ['superuser', 'web'], 'prefix' => 'admin', 'namespace' => 'Admin'], function(){

	Route::resource('/', 'PremadeController');
	Route::resource('/premades', 'PremadeController');
	Route::get('/main.js', 'PremadeController@js');

	// Handles Uploads
	Route::get('/upload', 'UploadPremadeController@create');
	Route::post('/upload', 'UploadPremadeController@store');
});
