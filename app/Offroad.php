<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offroad extends Model
{
  //
	protected $fillable=[
		'offroadid',
		'plussizetype',
		'sort',
		'wheeldiameter',
		'wheelwidth',
		'tire1',
		'tire1search',
		'offsetmin',
		'offsetmax',
		'offroadrowid',
	];

}
