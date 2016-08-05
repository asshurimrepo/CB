<?php

namespace App\Events\Project;

use App\Events\Event;
use App\Project;

class VideoWasUploaded extends Event
{

    public $project;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
        $this->user = auth()->user();
    }
}
