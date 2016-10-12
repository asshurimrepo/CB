<?php 
namespace App\Projects;

use File;

trait Attributes {

	public function getOptionsAttribute($options)
	{
		$default = File::get('../resources/default/options.json');

		if(is_array($options))
		{
			$options = json_encode($options);
		}

		return json_decode($options ?: $default);
	}

	public function getActionsAttribute($actions)
	{
		$default = File::get('../resources/default/actions.json');

		if(is_array($actions))
		{
			$actions = json_encode($actions);
		}
		
		return json_decode($actions ?: $default);
	}

}