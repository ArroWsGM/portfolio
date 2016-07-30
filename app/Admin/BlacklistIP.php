<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class BlacklistIP extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blacklist_ip';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip',
    ];

    /**
     * The attributes that allows to using non-incrementing or a non-numeric primary key.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The primary key name.
     *
     * @var string
     */
    public $primaryKey = 'ip';
}
