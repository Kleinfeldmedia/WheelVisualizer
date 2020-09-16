<?php

namespace App\Http\Controllers;

use App\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{


    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enquiries = Enquiry::paginate(10);
        // dd($orders);
        return view('admin.enquiry.index',compact('enquiries'));
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
  
        $this->validate($request, [
            'request_to'=>'required|max:255',
            'name'=>'required|max:255',
            'email'=>'required|email|max:255',
            'message'=>'required'
        ]);

        try{  

                $data = $request->except(['_token']);
                $enquiry = Enquiry::create($data);
                return back()->with('flash_success','Thanks for Request... Will get back you soon!!');
        }catch(Exception $e){
            return back()->with('flash_error','Something Went Wrong!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Enquiry $enquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquiry $enquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enquiry $enquiry)
    {
       
        try {
            $enquiry->delete();
            return back()->with('flash_success', 'Enquiry deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Enquiry Not Found');
        }
    }
}
