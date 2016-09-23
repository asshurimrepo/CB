<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use File;
use Response;
use App\User;

class ImagesController extends Controller
{
    public function show($filename)
    {

    	$user = auth()->user();
    	$path = "data/{$user->email}/done/{$filename}.png";

	    if(!File::exists($path)) {
	    	return $this->defaultImage();
	    };

	    return $this->renderImage($path);
    }	

    public function defaultImage()
    {
    	return $this->renderImage('img/default.png');
    }

    public function embed(User $user, $filename)
    {
       return $this->renderImage("data/{$user->email}/done/{$filename}");
    }

    public function renderImage($path)
    {
    	$file = File::get($path);
	    $type = File::mimeType($path);

	    $response = Response::make($file, 200);
	    $response->header("Content-Type", $type);

	    return $response;
    }
}
