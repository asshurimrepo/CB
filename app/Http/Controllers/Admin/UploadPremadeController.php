<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use File;

class UploadPremadeController extends \App\Http\Controllers\Controller
{
   use \App\Http\Controllers\Projects\UploadTrait;
}