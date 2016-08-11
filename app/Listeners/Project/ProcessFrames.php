<?php

namespace App\Listeners\Project;

use App\Events\Project\VideoWasUploaded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ProcessFrames
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
        $process = new Process(
            "sh ../processFrames {$event->user->email} 400 0",
            null, null, null, null
        );

        $process->run();
    }
}
