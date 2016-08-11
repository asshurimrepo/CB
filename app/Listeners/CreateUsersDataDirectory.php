<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Storage;
use File;

class CreateUsersDataDirectory
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $email = $event->user->email;

        if(File::exists("../data/{$email}"))
        {
            return;
        }

        mkdir("../data/".$email);
        mkdir("../data/".$email."/videos");
        mkdir("../data/".$email."/images");
        mkdir("../data/".$email."/out");
        mkdir("../data/".$email."/done");
        mkdir("../data/".$email."/tmp");
    }
}
