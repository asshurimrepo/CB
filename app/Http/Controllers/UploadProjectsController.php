<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;

class UploadProjectsController extends Controller
{
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('upload.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * Check also App\Providers\WhenProjectIsUploaded::class
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Upload
        if( ! $request->file('file')->isValid() )
        {
            return $request->file('file')->getErrorMessage();
        }

        $filename = str_random(10) . $request->file('file')->getClientOriginalName();

        $project = new Project;
        $project->user_id = auth()->user()->id;
        $project->filename = $filename;
        $project->title = $filename;

        $project->save();

        return $project;
    }
}
