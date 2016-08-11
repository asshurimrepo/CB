<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use File;
use Response;

class VideosController extends Controller
{
    public function show($filename)
    {
    	$user = auth()->user();
    	$path = "../data/{$user->email}/done/{$filename}";

    	// dd($path,File::exists($path));

	    if(!File::exists($path)) abort(404);

	    $file = File::get($path);
	    $type = File::mimeType($path);

	    $response = Response::make($file, 200);
	    $response->header("Content-Type", $type);

	    return $response;
    }
}
