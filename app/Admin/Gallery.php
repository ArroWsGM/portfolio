<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'galleries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_type', 'item_url', 'item_alt', 'item_embed',
    ];

    public function project()
    {
    	return $this->belongsTo(Project::class);
    }
}
