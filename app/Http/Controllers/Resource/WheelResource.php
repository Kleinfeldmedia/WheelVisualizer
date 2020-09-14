<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Wheel;
use Exception;
use Illuminate\Support\Facades\Storage;

class WheelResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wheels = Wheel::paginate(10); 
        $brands = Wheel::select('brand')->distinct('brand')->get();
        return view('admin.wheel.index',compact('wheels','brands'));
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
            'brand' => 'required|max:255', 
            'wheeltype' => 'required|max:255',
            'part_no' => 'required|unique:wheels,part_no',
            'style' => 'required|max:255',
            'finish' => 'required|max:255',
            'wheeldiameter' => 'required|max:255',
            'wheelwidth' => 'required|max:255',
            'image' => 'required|mimes:jpg,jpeg,png|max:5242880', 
            'front_back_image' => 'required|mimes:jpg,jpeg,png|max:5242880', 
        ]);
        try{  

            $imagename = $request->image->getClientOriginalName();  
            $split_name = explode('.', $imagename);

            $front_back_image = $split_name[0].'.png';
            $request->image->move(public_path('/storage/wheels'), $imagename);
            $request->front_back_image->move(public_path('/storage/wheels/front_back'), $front_back_image);  
            $wheel = Wheel::create($request->all());
            $wheel->image = 'storage/wheels/'.$imagename;
            $wheel->frontimage = 'storage/wheels/front_back/'.$front_back_image;
            $wheel->rearimage = 'storage/wheels/front_back/'.$front_back_image;
            $wheel->save();

            return back()->with('flash_success','Wheel Added successfully');
        }catch(Exception $e){
            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            
            $wheel = Wheel::find($id);
            return response()->json(['status' => true,'data'=>$wheel]); 
        } catch (Exception $e) {
            return response()->json(['status' => fasle,'data'=>$wheel]); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $this->validate($request, [
            // 'year' => 'required|max:255',
            'brand' => 'required|max:255', 
            'wheeltype' => 'required|max:255',
            'part_no' => 'required',
            'style' => 'required|max:255',
            'finish' => 'required|max:255',
            'wheeldiameter' => 'required|max:255',
            'wheelwidth' => 'required|max:255',
            // 'image' => 'required|mimes:jpg,png|max:5242880', 
            // 'front_back_image' => 'required|mimes:png|max:5242880', 
            // 'image' => 'required|mimes:jpg,png|max:5242880', 
            // 'front_back_image' => 'required|mimes:png|max:5242880', 
        ]);
        try{   
            $data = request()->except(['_token','_method']);
            $wheel = Wheel::whereid($id)->first();
            $wheel->update($data);
            $wheel = Wheel::whereid($id)->first();
            $imagename='';

             if($request->hasFile('image')){    
                $imagename = $request->image->getClientOriginalName();  
                $split_name = explode('.', $imagename);
                $front_back_image = $split_name[0].'.png';
                $request->image->move(public_path('/storage/wheels'), $imagename); 
                $wheel->image = 'storage/wheels/'.$imagename; 
            } 


            if($request->hasFile('front_back_image')){ 
                $front_back_image = str_replace('storage/wheels/', '', $wheel->image);  
                $request->front_back_image->move(public_path('/storage/wheels/front_back'), $front_back_image); 
 
                $wheel->frontimage = 'storage/wheels/front_back/'.$front_back_image;
                $wheel->rearimage = 'storage/wheels/front_back/'.$front_back_image; 
            }

           
            $wheel->save(); 

            return back()->with('flash_success','Wheel Updated successfully');
        }catch(Exception $e){
            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try {
            Wheel::find($id)->delete();
            return back()->with('flash_sucess', 'Wheel deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Wheel Not Found');
        }
    }

  



    public function uploadcsv(Request $request){ 
        try{   
            $this->validate($request, [ 
                'wheelfile'=>'required',
            ]); 

            if($request->hasFile('wheelfile') ){
                $filename = $request->wheelfile->getClientOriginalName();  
                $request->wheelfile->move(public_path('/storage/wheel_file'), $filename); 
                // dd(base_path('storage/app/public/wheel_products_file/').$filename);
                $filepath = base_path('storage/app/public/wheel_file/').$filename;  

                if( !$fr = @fopen($filepath, "r") ) die("Failed to open file");
                // $fw = fopen($out_file, "w");
                $i=1;
                while( ($data = fgetcsv($fr, 2000, ",")) !== FALSE ) {
                        if($i != 1){  
                            $wheel['part_no'] = $data[0]?:null;
                            $wheel['brand'] = $data[1]?:null;
                            $wheel['style'] = $data[2]?:null;
                            $wheel['finish'] = $data[3]?:null;
                            $wheel['image'] = $data[4]?:null;
                            $wheel['boldpattern1'] = $data[5]?:null;
                            $wheel['boldpattern2'] = $data[6]?:null;
                            $wheel['boldpattern3'] = $data[7]?:null;
                            $wheel['offset1'] = $data[8]?:null;
                            $wheel['offset2'] = $data[9]?:null;
                            $wheel['simpleoffset'] = $data[10]?:null;
                            $wheel['wheeltype'] = $data[11]?:null;
                            $wheel['wheeldiameter'] = $data[12]?:null;
                            $wheel['wheelwidth'] = $data[13]?:null;
                            $wheel['hub'] = $data[14]?:null;
                            $wheel['frontimage'] = $data[15]?:null;
                            $wheel['rearimage'] = $data[16]?:null;

                            Wheel::updateOrCreate(['part_no' =>$wheel['part_no']] , $wheel); 
                        
                        }
                        $i++;
                    }
                fclose($fr);
            }  

            return back()->with('flash_success','Wheel Data Uploaded successfully');
        }catch(Exception $e){
            return back()->with('flash_error',$e->getMessage());
        } 

    }
}
