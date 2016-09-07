<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Premade;
use App\Project;
use File;

class PremadeVideosController extends Controller
{
    public function index()
    {
    	return view('premades.index');
    }

    public function data()
    {
    	return Premade::all();
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

        list($width, $height) = getimagesize("premades/{$request->get('filename')}.png");

        $project = new Project;
        $project->user_id = auth()->user()->id;
        $project->filename = $filename;
        $project->width = $width;
        $project->height = $height;
        $project->title = $title;
        $project->active = 1;

        $project->save();

        File::copy("premades/{$request->get('filename')}", "../data/{$email}/done/{$filename}");
        File::copy("premades/{$request->get('filename')}.png", "../data/{$email}/done/{$filename}.png");
    }
}
