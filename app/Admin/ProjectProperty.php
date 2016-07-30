<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class ProjectProperty extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_properties';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'property_id',
    ];

    public function project()
    {
    	return $this->belongsTo(Project::class);
    }

    public function property()
    {
    	return $this->belongsTo(Property::class);
    }
}
