<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class ViewCounter extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id', 'ip',
    ];

    public function project()
    {
    	return $this->belongsTo(Project::class);
    }
}
