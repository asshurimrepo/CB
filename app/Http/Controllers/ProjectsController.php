<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use File;

class ProjectsController extends Controller
{
    public function index(Project $project)
    {
    	return auth()->user()
    				 ->projects()
                     ->orderBy('created_at', 'desc')
    				 ->get();
    }

    public function show()
    {
        return view('projects.show');
    }

    public function destroy(Project $project)
    {
    	$project->delete();
    }

    public function update(Project $project, Request $request)
    {
        $project_data = $request->all();
        $project_data['options'] = json_encode($request->get('options'));
        $project_data['actions'] = json_encode($request->get('actions'));

        $project->fill($project_data);
        $project->save();

        return $project;
    }
}
