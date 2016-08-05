<?php

namespace App\Listeners\Project;

use App\Events\Project\VideoWasUploaded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ProcessFrames implements ShouldQueue
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
        $process = new Process("sh ../processFrames {$event->user->email} 300 0");
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }
}
