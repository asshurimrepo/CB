<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Premade;
use App\Project;
use File, Response;

class PremadeVideosController extends Controller
{
    public function index()
    {
    	return view('premades.index');
    }

    // public function data()
    // {
    // 	return Premade::all();
    // }

    public function show($id)
    {
        $premades = Premade::where('category_id',$id)->get()->toJson();
        // return $premades;
        return view('premades.video', compact('premades'));
    }

    public function create()
    {
    	Premade::truncate();
    	$files = File::allFiles('premades');

    	foreach ($files as $file) {
    		if($file->getExtension() == 'png')
    		{
    			continue;
    		}

    		Premade::create([
    			'title' => str_replace($file->getExtension(), "", $file->getFilename()),
    			'filename' => $file->getFilename(),
    			'active' => 1
    		]);
    	}

        return redirect('/premade');
    }

    public function addToProject(Request $request)
    {
        $exploded_filename = explode('.', $request->get('filename'));
        $title = $exploded_filename[0];
        
        $filename = str_random(5) . $request->get('filename');
        $email = auth()->user()->email;

        // return $email;

        list($width, $height) = getimagesize("premades/{$request->get('filename')}.png");

        $project = new Project;
        $project->fill($request->all());
        $project->user_id = auth()->user()->id;
        $project->filename = $filename;
        $project->width = $width;
        $project->height = $height;
        $project->options = json_encode($request->get('options'));
        $project->actions = json_encode($request->get('actions'));
        $project->title = $title;
        $project->active = 1;

        $project->save();

        File::copy("premades/{$request->get('filename')}", "data/{$email}/done/{$filename}");
        File::copy("premades/{$request->get('filename')}.png", "data/{$email}/done/{$filename}.png");

        return $project;
    }

    public function js()
    {
        $path = "js/premade.js";

        $file = File::get($path);
        $type = File::mimeType($path);

        $file = str_replace("\'/image/\' + filename", "\'/premades/\' + filename + \'.png\'", $file);
        $file = str_replace("/video/", "/premades/", $file);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
