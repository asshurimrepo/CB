<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use File;
use Response;
use App\Project;

class EmbedController extends Controller
{
    public function show(Request $request)
    {
    	$id = $request->get('ID');

    	$project = Project::findOrFail($id);

    	$path = "js/caster.js";

	    if(!File::exists($path)) abort(404);

	    $file = File::get($path);
	    $type = File::mimeType($path);

	    $file = $this->updateCode($file, $project);

	    $response = Response::make($file, 200);
	    $response->header("Content-Type", $type);

	    return $response;
    }

    public function create($id)
    {
    	$path = "js/embed.js";

	    $file = File::get($path);
	    $type = File::mimeType($path);

	    $file = str_replace('@id', $id, $file);
	    $file = str_replace('@url', url('/'), $file);
	    $file = str_replace("\n", "", $file);

   		$response = Response::make($file, 200);
	    $response->header("Content-Type", $type);

	    return $response;
    }

    public function updateCode($file, $project)
    {
    	$file = str_replace('active_project: {}', "active_project:" . $project->toJson(), $file);
	    $file = str_replace('@id', $project->id, $file);
	    $file = str_replace('//@embed', "", $file);
	    $file = str_replace('is_embed: false', "is_embed: true", $file);
	    $file = str_replace('$(', 'jQueryCaster(', $file);
	    $file = str_replace('videojs', 'videoCasterJS', $file);
	    $file = str_replace('Dom.jQueryCaster(', 'Dom.$(', $file);
	    $file = str_replace('this.jQueryCaster(', 'this.$(', $file);
	    $file = str_replace("/image/", url("/embed/image/{$project->user_id}") . "/", $file);
	    $file = str_replace("/video/", url("/embed/video/{$project->user_id}") . "/", $file);

	    return $file;
    }

    public function loadjs($filename)
    {
    	$path = "js/{$filename}";

	    if(!File::exists($path)) abort(404);

	    $file = File::get($path);
	    $type = File::mimeType($path);

	    $response = Response::make($file, 200);
	    $response->header("Content-Type", $type);

	    return $response;
    }

    public function iframe(Project $project)
    {
    	// return $project;
    	return view('embed.iframe', compact('project'));
    }
}
