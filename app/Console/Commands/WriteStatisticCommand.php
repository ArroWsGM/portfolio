<?php

namespace App\Console\Commands;

use App\Admin\Project;
use App\Events\WriteStatistic;
use Illuminate\Console\Command;

class WriteStatisticCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stat:write';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Write last week views counter';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $project = Project::with(['views' => function($q){
            return $q->lastWeek();
        }])->get();

        event(new WriteStatistic($project));
    }
}
