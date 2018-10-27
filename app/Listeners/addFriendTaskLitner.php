<?php

namespace App\Listeners;

use App\Events\addFriendTask;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class addFriendTaskLitner
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
     * @param  addFriendTask  $event
     * @return void
     */
    public function handle(addFriendTask $event)
    {
       return dd($event);
    }
}
