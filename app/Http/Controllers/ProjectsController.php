<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;

class ProjectsController extends Controller
{
    public function index(Project $project)
    {
    	return auth()->user()
    				 ->projects()
    				 ->get();
    }

    public function destroy(Project $project)
    {
    	$project->delete();
    }	
}
