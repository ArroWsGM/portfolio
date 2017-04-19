<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class WriteStatistic extends Event
{
    use SerializesModels;

    public $projects;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($projects)
    {
        $this->projects = $projects;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
