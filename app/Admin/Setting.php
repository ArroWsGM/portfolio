<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'setting_name', 'setting_value', 'setting_type',
    ];

    public static function getAllSettings(){
    	$allsettings = array();

    	foreach (self::all() as $setting){
            //$returnValue = preg_match('/^imgsz_.+/i', $setting['setting_name'], $matches);

            if(starts_with($setting['setting_name'], 'imgsz_')){
                $chunks = explode("_", $setting['setting_name']);
                $allsettings['images'][$chunks[1]][$chunks[2]] = (int)$setting['setting_value'];
            } else {
        		$allsettings[$setting['setting_name']] = $setting['setting_value'];
        		settype($allsettings[$setting['setting_name']], $setting['setting_type']);
            }
    	}

    	return $allsettings;
    	//return self::all();
    }
}
