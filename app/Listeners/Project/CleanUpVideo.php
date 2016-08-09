<?php

namespace App\Listeners\Project;

use App\Events\Project\VideoWasUploaded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use File;

class CleanUpVideo
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
        File::cleanDirectory("../data/{$event->user->email}/images");
        File::cleanDirectory("../data/{$event->user->email}/out");
        File::cleanDirectory("../data/{$event->user->email}/tmp");
        File::cleanDirectory("../data/{$event->user->email}/videos");
    }
}
