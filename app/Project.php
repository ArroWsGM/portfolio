<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    public function galleries()
    {
    	return $this->hasMany(Gallery::class);
    }

    public function properties()
    {
    	return $this->hasMany(ProjectProperty::class);
    }
}
