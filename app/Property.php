<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
	public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'properties';
    
    public function properties()
    {
    	return $this->hasMany(ProjectProperty::class);
    }
}
