<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

	protected $fillable = [
		'userid','ordernumber','firstname','lastname','companyname','email','dayphone','cellphone','address','address2','state','city','zip',
		'same_shipping','shipping_firstname','shipping_lastname','shipping_companyname','shipping_email','shipping_dayphone',
		'shipping_cellphone','shipping_address','shipping_address2','shipping_state','shipping_city','shipping_zip',
		'make','year','model','trim','vehicle_modified','big_brake_kit','raised_lowered','modified_notes','notes',
		'subtotal','fees','tax','shipping','total','payment_status','status'
	];


	public function OrderItems() {
	    return $this->hasMany('App\OrderItem','orderid');
	}


	public function OrderStatuses() {
	    return $this->hasMany('App\OrderStatus','orderid')->select('status','created_at')->distinct('status');
	}

	public function User() {
	    return $this->belongsTo('App\User','userid');
	}

}
