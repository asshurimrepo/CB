<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	use Projects\Attributes;

    protected $fillable = ['title', 'user_id', 'filename', 'options', 'actions'];

}