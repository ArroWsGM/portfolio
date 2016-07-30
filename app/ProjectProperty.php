<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectProperty extends Model
{
    public function project()
    {
    	return $this->belongsTo(Project::class);
    }

    public function property()
    {
    	return $this->belongsTo(Property::class);
    }
}
