<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'user_id', 'filename', 'options', 'actions'];

    public function getOptionsAttribute($options)
	{
		if(is_array($options))
		{
			$options = json_encode($options);
		}

		return json_decode($options ?: "{}");
	}

	public function getActionsAttribute($actions)
	{
		if(is_array($actions))
		{
			$actions = json_encode($actions);
		}
		
		return json_decode($actions ?: "{}");
	}
}