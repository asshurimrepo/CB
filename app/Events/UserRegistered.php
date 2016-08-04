<?php

namespace App\Events;

use App\Events\Event;
use App\User;

class UserRegistered extends Event
{

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
