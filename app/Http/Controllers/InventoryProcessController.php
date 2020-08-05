<?php

namespace App\Http\Controllers;

use App\InventoryProcess;
use Illuminate\Http\Request;

class InventoryProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = InventoryProcess::whereDate('started_at',\Carbon\Carbon::today())->orderBy('foldername','asc')->paginate(20);
        return view('admin.inventory.processlist',compact('processes'));
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
     * @param  \App\InventoryProcess  $inventoryProcess
     * @return \Illuminate\Http\Response
     */
    public function show(InventoryProcess $inventoryProcess)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InventoryProcess  $inventoryProcess
     * @return \Illuminate\Http\Response
     */
    public function edit(InventoryProcess $inventoryProcess)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InventoryProcess  $inventoryProcess
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InventoryProcess $inventoryProcess)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InventoryProcess  $inventoryProcess
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventoryProcess $inventoryProcess)
    {
        //
    }
}
