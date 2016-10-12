<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Premade extends Model
{
	use Projects\Attributes;

    protected $fillable = ['active', 'title', 'filename', 'options', 'actions', 'category_id'];
}
