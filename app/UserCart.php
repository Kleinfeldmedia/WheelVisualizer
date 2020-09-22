<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCart extends Model
{
	protected $fillable = [
		'userid','productid','producttype','qty','price'
	];

 
}
