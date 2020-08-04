<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WheelProduct extends Model
{
    

    protected $fillable=[
		'prodtitle','prodbrand','prodmodel','prodfinish','prodmetadesc','prodimage','prodimageshow','prodimagedually','prodsortcode','prodheaderid','prodfooterid','prodinfoid','proddesc','wheeltype','duallyrear','wheeldiameter','wheelwidth','boltpattern1','boltpattern2','boltpattern3','detailtitle','partno','price','price2','cost','rate','saleprice','saletype','salestart','saleexp','weight','length','width','height','shpsep','shpfree','shpcode','shpflatrate','partno_old','metadesc','qtyavail','proddetailid','productid','dropshippable','vendorpartno','dropshipper','vendorpartno2','dropshipper2','staggonly','rf_lc','offset1','offset2','hubbore',    
	];

	public function DifferentOffsets() {
	    return $this->hasMany('App\WheelProduct','wheeldiameter','wheeldiameter');
	}

	public function wheel() {
	    return $this->hasOne('App\Wheel','part_no','partno_old');
	}

	public function Reviews() {
	    return $this->hasMany('App\Review','partno','partno')->where('category','wheel')->where('approval','1');
	}
	

	public function Inventories() {
	    return $this->hasMany('App\Inventory','partno','partno');
	}

	public function DropshipperInventories() {
	    return $this->hasMany('App\DropshipperInventory','partno','partno');
	}
	
}
