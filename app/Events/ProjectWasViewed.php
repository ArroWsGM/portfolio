<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProjectWasViewed extends Event
{
    use SerializesModels;

    public $project_id;
    public $user_ip;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id, $ip)
    {
        $this->project_id = $id;
        $this->user_ip = $ip;
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
