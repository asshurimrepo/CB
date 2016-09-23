<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use File;
use Response;
use App\User;

class VideosController extends Controller
{
    public function show($filename)
    {
    	// return 1;
    	$filename = str_replace("video", "", $filename);
    	$user = auth()->user();
    	$path = "data/{$user->email}/done/{$filename}";

    	// dd($path,File::exists($path));

	    if(!File::exists($path)) abort(404);

	   
	    return $this->renderVideo($path);
    }

    public function renderVideo($path)
    {
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function embed(User $user, $filename)
    {
       return $this->renderVideo("data/{$user->email}/done/{$filename}");
    }
}
