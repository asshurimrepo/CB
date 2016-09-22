<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use File;
use Response;

class EmbedController extends Controller
{
    public function show()
    {
    	$path = "js/main.js";

	    if(!File::exists($path)) abort(404);

	    $file = File::get($path);
	    $type = File::mimeType($path);

	    $response = Response::make($file, 200);
	    $response->header("Content-Type", $type);

	    return $response;
    }
}
