<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
    protected $fillable = ['slug', 'name', 'featured_img', 'sub_text'];

    
    public function premades()
    {
    	return $this->hasMany(\App\Premade::class);
    }
}
