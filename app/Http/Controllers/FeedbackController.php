<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $feedbacks = Feedback::paginate(10);
        // dd($orders);
        return view('admin.feedback.index',compact('feedbacks'));
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
            'firstname'=>'required|max:255',
            'lastname'=>'required|max:255', 
            'email'=>'required|email|confirmed|max:255', 
            'phone'=>'required|max:255', 
            'invoice'=>'required|max:255', 
            'comments'=>'required|max:255', 
        ]);
        try{  

                $data = $request->except(['_token','email_confirmation']);

                $feedback = Feedback::create($data);  

                return back()->with('flash_success','Thanks for your comments!!');

            }catch(Exception $e){
                return back()->withInput(Input::all())->with('error',$e->getMessage());
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        try {
            $feedback->delete();
            return back()->with('flash_sucess', 'Feedback deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Feedback Not Found');
        }
    }
}
