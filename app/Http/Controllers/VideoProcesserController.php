<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use File;

class VideoProcesserController extends Controller
{
	protected $user;

	public function __construct()
	{
		$this->user = auth()->user();
	}

    public function distillVideo(Request $request, Project $project)
    {	
    	$process = new Process("sh ../distillVideo {$this->user->email} {$project->filename}");
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    public function processFrames(Request $request, Project $project)
    {
        return File::files("../data/{$this->user->email}/images");

    	/*foreach ($files as $key => $file) {
            $file = explode('/', $file);

            $process = new Process(
                "sh ../processSingleFrame {$this->user->email} {$file[4]} 400 0",
                null, null, null, null
            );

            $process->run();
        }*/
    }

    public function processSingleFrame(Project $project, $img)
    {
        $process = new Process(
            "sh ../processSingleFrame {$this->user->email} {$img} 400 0",
            null, null, null, null
        );

        $process->run();
    }

    public function recomposeVideo(Request $request, Project $project)
    {
    	$process = new Process("sh ../reComposeVideo {$this->user->email} {$project->filename}");
        $process->run();

        $path_to_copy = "../data/{$this->user->email}/out/thumb.png";
        list($width, $height) = getimagesize($path_to_copy);

        $project->width = $width;
        $project->height = $height;
        $project->save();

        copy($path_to_copy, "../data/{$this->user->email}/done/{$project->filename}.png");

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    public function cleanUpVideo(Request $request, Project $project)
    {
        $project->active = 1;
        $project->save();

    	File::cleanDirectory("../data/{$this->user->email}/images");
        File::cleanDirectory("../data/{$this->user->email}/out");
        File::cleanDirectory("../data/{$this->user->email}/tmp");
        File::cleanDirectory("../data/{$this->user->email}/videos");
    }
}
