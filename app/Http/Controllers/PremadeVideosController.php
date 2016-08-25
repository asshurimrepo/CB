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
    			'title' => $file->getFilename(),
    			'filename' => $file->getFilename(),
    			'active' => 1
    		]);
    	}

        return redirect('/premade');
    }

    public function addToProject(Request $request)
    {
        $title = 'New Premade-'. str_random(5);
        $filename = str_random(5) . $request->get('filename');
        $email = auth()->user()->email;

        $project = new Project;
        $project->user_id = auth()->user()->id;
        $project->filename = $filename;
        $project->title = $title;

        $project->save();

        File::copy("premades/{$request->get('filename')}", "../data/{$email}/done/{$filename}");
        File::copy("premades/{$request->get('filename')}.png", "../data/{$email}/done/{$filename}.png");
    }
}
