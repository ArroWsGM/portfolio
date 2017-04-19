<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'statistics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'views_total',
        'views_unique',
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
