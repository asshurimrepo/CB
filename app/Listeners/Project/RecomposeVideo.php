<?php

namespace App\Listeners\Project;

use App\Events\Project\VideoWasUploaded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class RecomposeVideo
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
        $process = new Process("sh ../reComposeVideo {$event->user->email} {$event->project->filename}");
        $process->run();

        copy("../data/{$event->user->email}/out/thumb.png", "../data/{$event->user->email}/done/{$event->project->filename}.png");

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }
}
