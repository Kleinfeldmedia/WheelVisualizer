<?php

namespace App\Http\Controllers;

use App\Offroad;
use Illuminate\Http\Request;
use Excel;

class OffroadController extends Controller
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
     * @param  \App\Offroad  $offroad
     * @return \Illuminate\Http\Response
     */
    public function show(Offroad $offroad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offroad  $offroad
     * @return \Illuminate\Http\Response
     */
    public function edit(Offroad $offroad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offroad  $offroad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offroad $offroad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offroad  $offroad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offroad $offroad)
    {
        //
    }


    public function offroad_update(){

        $excelFile = public_path('/storage/OFFROAD.xlsx');
       
        // $excelData = \Excel::load($excelFile)->get()->toArray();

        $test=Excel::selectSheets('OffroadExport')->load($excelFile, function($reader) {
            // $reader->ignoreEmpty();
            $results = $reader->get()->toArray();
     
            foreach($results as $key => $row){ 
                // dd($row);
                $offroad =new Offroad;
                $offroad->offroadid = $row['offroadid'];
                $offroad->plussizetype = $row['plussizetype'];
                $offroad->sort = $row['sort'];
                $offroad->wheeldiameter = $row['wheeldiameter'];
                $offroad->wheelwidth = $row['wheelwidth'];
                $offroad->tire1 = $row['tire1'];
                $offroad->tire1search = $row['tire1search'];
                $offroad->offsetmin = $row['offsetmin'];
                $offroad->offsetmax = $row['offsetmax'];
                $offroad->offroadrowid = $row['offroadrowid'];
                $offroad->save();
            }
        })->get(); 
    }
}
