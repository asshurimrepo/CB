<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Premade;
use File, Response;

class PremadeController extends Controller
{
    public function index(Request $request, Premade $premade)
    {
    	if($request->ajax()) {
    		return $premade->all();
    	}

    	return view('admin.premades.index');
    }

    public function js()
    {
    	$path = "js/admin-premade.js";

	    $file = File::get($path);
	    $type = File::mimeType($path);

	    $file = str_replace("\'/image/\' + filename", "\'/premades/\' + filename + \'.png\'", $file);
	    $file = str_replace("/video/", "/premades/", $file);


   		$response = Response::make($file, 200);
	    $response->header("Content-Type", $type);

	    return $response;
    }
}
