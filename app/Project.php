<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Project extends Model
{
	use Projects\Attributes;

    protected $fillable = ['title', 'user_id', 'filename', 'options', 'actions'];

    protected $appends = ['isNew', 'isUpdated'];


    public function getIsNewAttribute()
    {
    	$hours = $this->created_at->diff(Carbon::now())->h;
    	return $hours < 1 ? true : false;
    }

    public function getIsUpdatedAttribute()
    {
    	$hours = $this->updated_at->diff(Carbon::now())->h;
    	return $hours < 1 ? true : false;
    }

}