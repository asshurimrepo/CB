<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Premade;
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
    		if($file->getExtension() != 'mp4') 
    		{
    			continue;
    		}

    		Premade::create([
    			'title' => $file->getFilename(),
    			'filename' => $file->getFilename(),
    			'active' => 1
    		]);
    	}

    }
}
