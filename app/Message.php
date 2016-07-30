<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'subject', 'phone', 'message', 'ip', 'status_id',
    ];

    public function status()
    {
    	return $this->hasOne(ProjectProperty::class);
    }
}
