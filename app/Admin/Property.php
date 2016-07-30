<?php

namespace App\Admin;

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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'property_name',
        'property_class',
        'property_group',
    ];

    public function properties()
    {
    	return $this->hasMany(ProjectProperty::class);
    }
}
