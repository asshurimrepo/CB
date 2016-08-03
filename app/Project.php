<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'user_id', 'filename', 'options', 'actions'];

    public function getOptionsAttribute($options)
	{
		return json_decode($options ?: "{}");
	}

	public function getActionsAttribute($actions)
	{
		return json_decode($actions ?: "{}");
	}
}