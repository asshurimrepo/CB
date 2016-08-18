<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Premade extends Model
{
    protected $fillable = ['active', 'title', 'filename'];
}
