<?php

namespace App\Listeners;

use App\Events\WriteStatistic;
use App\Admin\Statistic;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Admin\ViewCounter;

class StatisticListener
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
    public function write(WriteStatistic $event)
    {
        Statistic::truncate();
        foreach($event->projects as $project) {
            $counter = new Statistic([
                'project_id' => $project->id,
                'views_total' => $project->views->count(),
                'views_unique' => $project->views->groupBy('ip')->count(),
            ]);
            $counter->save();
        }
    }
}
