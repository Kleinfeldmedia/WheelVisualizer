<?php

namespace App\Http\Controllers;

use App\DropshipperInventory;
use Illuminate\Http\Request;

class DropshipperInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DropshipperInventory  $dropshipperInventory
     * @return \Illuminate\Http\Response
     */
    public function show(DropshipperInventory $dropshipperInventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DropshipperInventory  $dropshipperInventory
     * @return \Illuminate\Http\Response
     */
    public function edit(DropshipperInventory $dropshipperInventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DropshipperInventory  $dropshipperInventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DropshipperInventory $dropshipperInventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DropshipperInventory  $dropshipperInventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(DropshipperInventory $dropshipperInventory)
    {
        //
    }



    public function DropshipperInventory_Import(){
         $in_file = public_path('/storage/Dropshipper_Inventory.csv'); 

        if( !$fr = @fopen($in_file, "r") ) die("Failed to open file");
        // $fw = fopen($out_file, "w");
        while( ($data = fgetcsv($fr, 1000, ",")) !== FALSE ) {
                $dropinv = new DropshipperInventory; 
                $dropinv->fetcher = in_array($data[0], ['NULL',''])?null:$data[0] ;
                $dropinv->location_name = in_array($data[1], ['NULL',''])?null:$data[1] ;
                $dropinv->dropshipper_id = in_array($data[2], ['NULL',''])?null:$data[2] ;
                $dropinv->partno = in_array($data[3], ['NULL',''])?null:$data[3] ;
                $dropinv->vendor_partno = in_array($data[4], ['NULL',''])?null:$data[4] ;
                $dropinv->qty = in_array($data[5], ['NULL',''])?null:$data[5] ;
                $dropinv->price = in_array($data[6], ['NULL',''])?null:$data[6] ;
                $dropinv->fetch_date = in_array($data[7], ['NULL',''])?null:$data[7] ;
                $dropinv->zip = in_array($data[8], ['NULL',''])?null:$data[8] ;
                $dropinv->save(); 
            }
        fclose($fr);
        // fclose($fw);
        return 'hiii';
    }
}
