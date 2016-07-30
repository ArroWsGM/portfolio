<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
    ];

    public function status()
    {
    	return $this->belongsTo(MessageStatus::class);
    }

    public function blacklisted()
    {
    	return $this->belongsTo(BlacklistIP::class, 'ip', 'ip');
    }
}
