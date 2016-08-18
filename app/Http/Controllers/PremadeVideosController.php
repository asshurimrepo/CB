<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PremadeVideosController extends Controller
{
    public function index()
    {
    	return view('premades.index');
    }
}
