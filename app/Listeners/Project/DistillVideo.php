<?php

namespace App\Listeners\Project;

use App\Events\Project\VideoWasUploaded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DistillVideo implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  VideoWasUploaded  $event
     * @return void
     */
    public function handle(VideoWasUploaded $event)
    {
        \Log::info('Video Was Uploaded');
        \Log::info("Running ".public_path("../distillVideo {$event->user->email} {$event->project->filename}"));

        $process = new Process("sh ../distillVideo {$event->user->email} {$event->project->filename}");
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        
        sleep(1);
    }
}
