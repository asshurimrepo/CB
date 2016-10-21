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

        $filename = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME);
        $filename = str_random(10) . $filename . '.mp4';
        $filename = studly_case($filename);

        // return $filename;

        $file = $request->file('file')->move("data/{$user->email}/videos", $filename);

        $commands = [
            "ffmpeg -i {$file->getPathname()} -vcodec libx264 -preset veryfast -vf scale=996:560 -threads 2 -acodec aac -b:a 128k -f mp4 data/{$user->email}/done/{$file->getFilename()}",

            "ffmpeg -i data/{$user->email}/done/{$file->getFilename()} -b:v 0.85M -q:v 10 -vcodec libvpx -vf scale=996:560 -acodec libvorbis data/{$user->email}/done/{$file->getFilename()}.webm",

            "ffmpeg -i {$file->getPathname()} -ss 00:00:01 -vframes 1 -vf scale=-1:-1 data/{$user->email}/images/{$filename}.png",

            "cd data/{$user->email}/images/ && gimp --verbose -i -d -f -b '(create-thumb \"{$filename}.png\")' -b '(gimp-quit 0)' && \
             cp ../out/thumb.png ../done/{$filename}.png",
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
        $project->title = $request->file('file')->getClientOriginalName();

        $project->save();

        return $project;
    }
}
