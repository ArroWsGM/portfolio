<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Statistic;
use App\Http\Controllers\Controller;

class StatisticController extends Controller
{
    public function index(){
        $page_title = 'Statistic';
        $stat = Statistic::with('project')
            ->groupBy('project_id')
            ->orderBy('views_unique', 'desc')
            ->get();
        return view('admin.statistic', compact('stat', 'page_title'));
    }
}
