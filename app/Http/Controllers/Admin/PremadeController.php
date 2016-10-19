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

    public function update(Premade $premades, Request $request)
    {
    	$premades_data = $request->all();
        $premades_data['options'] = json_encode($request->get('options'));
        $premades_data['actions'] = json_encode($request->get('actions'));

        $premades->fill($premades_data);
        $premades->save();

        return $premades;
    }

    public function destroy(Premade $premades)
    {
    	$premades->delete();
    }

    public function js()
    {
    	$path = "js/admin-premade.js";

	    $file = File::get($path);
	    $type = File::mimeType($path);

	    $file = str_replace("\'/image/\' + filename", "\'/premades/\' + filename + \'.png\'", $file);
        $file = str_replace("/embed/iframe/", "/embed/iframe/premade/", $file);
	    $file = str_replace(".delete('/project/'", ".delete('/admin/premades/'", $file);
	    $file = str_replace("this.\$http.put('/project/'", "this.\$http.put('/admin/premades/'", $file);
        $file = str_replace("divider", "hidden", $file);
        $file = str_replace("user-only", "hidden", $file);
        $file = str_replace("<!--admin-only", "", $file);
        $file = str_replace("admin-only-->", "", $file);

   		$response = Response::make($file, 200);
	    $response->header("Content-Type", $type);

	    return $response;
    }
}
