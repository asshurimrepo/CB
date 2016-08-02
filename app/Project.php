<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title'];

    public function getOptionsAttribute($options)
	{
		return json_decode($options ?: "{}");
	}
}