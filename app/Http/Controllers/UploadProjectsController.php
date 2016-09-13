<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use File;

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

        $user = auth()->user();

        $filename = str_random(10) . $request->file('file')->getClientOriginalName();
        $filename = studly_case($filename);

        $file = $request->file('file')->move("data/{$user->email}/videos", $filename);

        $commands = [
            "ffmpeg -i {$file->getPathname()} -vcodec libx264 -preset fast -threads 2 -acodec aac -b:a 128k -f mp4 data/{$user->email}/done/{$file->getFilename()}",

            "ffmpeg -i {$file->getPathname()} -vframes 1 -vf scale=-1:-1 data/{$user->email}/images/{$file->getFilename()}.png",

            "cd data/{$user->email}/images/ && gimp --verbose -i -d -f -b '(create-thumb \"{$file->getFilename()}.png\")' -b '(gimp-quit 0)' && \
             cp ../out/thumb.png ../done/{$file->getFilename()}.png && \
             cp {$file->getFilename()}.png ../done/raw_{$file->getFilename()}.png",
        ];

        foreach ($commands as $command) {
            $process = new Process($command);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
        }

        $project = new Project;
        $project->user_id = auth()->user()->id;
        $project->filename = $filename;
        $project->title = $filename;

        $project->save();

        return $project;
    }
}
