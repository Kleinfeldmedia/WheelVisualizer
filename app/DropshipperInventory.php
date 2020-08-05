<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DropshipperInventory extends Model
{
    protected $fillable=[
		'fetcher',
		'location_name',
		'dropshipper_id',
		'partno',
		'vendor_partno',
		'qty',
		'price',
		'fetch_date',
		'zip',
    ];



	public function InventoryProducts() {
	    return $this->hasMany('App\Inventory','location_name','location_name');
	}
	
	public function scopeWithAndWhereHas($query, $relation, $constraint){
	    return $query->whereHas($relation, $constraint)
	                 ->with([$relation => $constraint]);
	}
}
