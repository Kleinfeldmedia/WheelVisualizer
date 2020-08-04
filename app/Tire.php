<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tire extends Model
{
		protected $fillable = [

				'partno',
				'prodtitle',
				'prodbrand',
				'prodmodel',
				'prodmetadesc',
				'prodimage',
				'prodimageshow',
				'prodsortcode',
				'prodheaderid',
				'prodfooterid',
				'prodinfoid',
				'proddesc',
				'tirewidth',
				'tireprofile',
				'tirediameter',
				'tiresize',
				'speedrating',
				'loadindex',
				'ply',
				'utqg',
				'warranty',
				'detailtitle',
				'keywords',
				'price',
				'price2',
				'cost',
				'rate',
				'saleprice',
				'saletype',
				'salestart',
				'saleexp',
				'weight',
				'length',
				'width',
				'height',
				'shpsep',
				'shpfree',
				'shpcode',
				'shpflatrate',
				'partno_old',
				'metadesc',
				'qtyavail',
				'proddetailid',
				'productid',
				'dropshippable',
				'vendorpartno',
				'dropshipper',
				'vendorpartno2',
				'dropshipper2',
				'tiretype',
				'lt',
				'xl',
				'badge1',
				'badge2',
				'badge3',
				'originalprice',
				'yousave',
				'set_amount',
				'detaildesctype',
				'detaildescfeatures',
				'detaildesc',
				'benefits1',
				'benefits2',
				'benefits3',
				'benefits4',
				'benefitsimage1',
				'benefitsimage2',
				'benefitsimage3',
				'benefitsimage4',
				'prodlandingdesc',
				'prodimage1',
				'prodimage2',
				'prodimage3',
				'dry_performance',
				'wet_performance',
				'mileage_performance',
				'ride_comfort',
				'quiet_ride',
				'winter_performance',
				'fuel_efficiency',
				'braking',
				'responsiveness',
				'sport',
				'off_road',
				'youtube1',
				'youtube2',
				'youtube3',
				'youtube4',
	];

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function ChassisModels(){
    	return $this->hasMany('App\ChassisModel','tire_size','spec3');
    }

	public function Brand(){
		return $this->hasOne('App\TireBrand','manufacturer','prodbrand');
	}
	// public function CarColors(){
	// 	return $this->hasMany('App\CarColor','vif','vif');
	// }


	public function Reviews() {
	    return $this->hasMany('App\Review','partno','partno')->where('category','tire')->where('approval','1');
	}

    public function Inventories(){
    	return $this->hasMany('App\Inventory','partno','partno');
    }
    public function DropshipperInventories(){
    	return $this->hasMany('App\DropshipperInventory','partno','partno');
    }
}
