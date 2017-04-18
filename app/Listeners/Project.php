<?php

namespace App\Listeners;

use App\Events\ProjectWasViewed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Admin\ViewCounter;

class Project
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
     * @param  ProjectWasViewed  $event
     * @return boolean
     */
    public function viewed(ProjectWasViewed $event)
    {
        $counter = new ViewCounter(['project_id' => $event->project_id, 'ip' => $event->user_ip]);
        return $counter->save();
    }
}
