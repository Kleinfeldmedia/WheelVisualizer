<?php

namespace App\Http\Controllers;

use App\MetaKeyword;
use Illuminate\Http\Request;

class MetaKeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $metakeywords=MetaKeyword::paginate(10);
        return view('admin.metakeywords.index',compact('metakeywords'));
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
        // dd($request->all());
        
        $this->validate($request, [
            'pages'=>'required|array',
            'keys'=>'required|array',
            'contents'=>'required|array',
        ]);
        try{  

            $data = $request->except(['_token']);

            foreach ($request->pages as $key => $page) { 

                MetaKeyword::create([
                    "page" => $request->pages[$key],
                    "key" => $request->keys[$key],
                    "value" => $request->contents[$key]
                ]);
            }
 
 
                return back()->with('success','Meta Keywords saved successfully'); 
        }catch(Exception $e){
                return back()->with('error','Something Went Wrong!!'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MetaKeyword  $metaKeyword
     * @return \Illuminate\Http\Response
     */
    public function show(MetaKeyword $metaKeyword)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MetaKeyword  $metaKeyword
     * @return \Illuminate\Http\Response
     */
    public function edit(MetaKeyword $metaKeyword)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MetaKeyword  $metaKeyword
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MetaKeyword $metaKeyword)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MetaKeyword  $metaKeyword
     * @return \Illuminate\Http\Response
     */
    public function destroy(MetaKeyword $metaKeyword)
    {
        //
    }
}