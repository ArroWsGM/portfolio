<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class MessageStatus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message_statuses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_name', 'status_class',
    ];

    public function status()
    {
    	return $this->hasMany(Message::class);
    }
}
