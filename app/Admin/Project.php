<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_name', 'project_slug', 'project_link', 'project_description', 'updated_at',
    ];

    public function galleries()
    {
    	return $this->hasMany(Gallery::class);
    }

    public function properties()
    {
        return $this->hasMany(ProjectProperty::class);
    }

    public function views()
    {
    	return $this->hasMany(ViewCounter::class);
    }
}
