<?php
//use Image;
//use App\Admin\Settings;

function makeImages($destination, $name, $extension)
{
	$sizes = \App\Admin\Setting::getAllSettings()['images'];

	$img = Image::make($destination . $name . $extension);

	$img->backup();

	foreach($sizes as $key => $val){
		$img->fit($val['width'], $val['height'], function($const){
			$const->upsize();
		});

		$img->save($destination . $name . '_' . $key . $extension);

		$img->reset();
	}	
}

function getAllImageNames($name, $path = '')
{
	$chunks = explode('.', $name);
	$sizes = \App\Admin\Setting::getAllSettings()['images'];

	foreach($sizes as $key => $val){
		$names[] = $path . $chunks[0] . '_' . $key . '.' . $chunks[1];
	}

	$names[] = $path . $chunks[0] . '.' . $chunks[1];

	return $names;
}

function getImageSizeName($name, $size = 'medium')
{
	$chunks = explode('.', $name);
	$sizes = \App\Admin\Setting::getAllSettings()['images'];

	if(isset($sizes[$size]))
		return $chunks[0] . '_' . $size . '.' . $chunks[1];
	else
		return false;
}

function getNumbers($str)
{
	preg_match_all('!\d+!', $str, $matches);

	return implode('', $matches[0]);
}