<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Wheel;
use App\CarImage;
use App\CarColor;
use App\Viflist;
use Exception;
use Illuminate\Support\Facades\Storage;

class CarResource extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $cars = Viflist::has('CarImages')->paginate(5); 
        // $cars = Viflist::with('CarImages')->paginate(10);
        $brands = Wheel::select('brand')->distinct('brand')->get();
        $makes = Viflist::select('make')->distinct('make')->get();
        $models = Viflist::select('model')->distinct('model')->get();
        $trims = Viflist::select('trim')->distinct('trim')->where('trim','!=','')->get();
        $wheels = Viflist::select('whls')->distinct('whls')->get();
        $bodies = Viflist::select('body')->distinct('body')->get();
        return view('admin.car.index',compact('cars','brands','makes','models','trims','wheels','bodies'));
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


        try{  

        $this->validate($request, [
            'vif' => 'required|max:255|unique:viflists,vif', 
            'yr' => 'required|max:255',
            'make' => 'required|max:255',
            'model' => 'required|max:255',
            'trim' => 'required|max:255',
            'whls' => 'required|max:255',
            'body' => 'required|max:255',
            'drs' => 'required|max:255',
            'vin' => 'required|max:255',
            'org' => 'required|max:255',
            'send' => 'required|max:255',
            'cc.*' => 'required|max:255',
            'color_code.*' => 'required|max:255',
            'evoxcode.*' => 'required|max:255',
            'name.*' => 'required|max:255',
            'simple.*' => 'required|max:255',
            'rgb1.*' => 'required|max:255',
            'car_image.*' => 'required|mimes:jpg,png|max:5242880',
        ]);
            $viflist = Viflist::create($request->all());

            foreach ($request->car_image as $key => $image) {
                $ext = $request->car_image[$key]->getClientOriginalExtension();
                $image_full_name = $request->vif.'_'.$request->cc[$key].'_032_'.$request->color_code[$key].'.'.$ext;
                $request->car_image[$key]->move(public_path('/storage/cars'), $image_full_name);
                $image_stored_path = 'storage/cars/'.$image_full_name;
                
                // Create a new record for the car images 
                $car_image = CarImage::create([
                    'car_id' => $request->vif,
                    'cc' => $request->cc[$key],
                    'color_code' => $request->color_code[$key],
                    'image' => $image_stored_path,
                ]);

                // Create a new record for the car colors 
                $car_color = CarColor::create([
                    'vif' => $request->vif,
                    'code' => $request->color_code[$key],
                    'evoxcode' => $request->evoxcode[$key],
                    'name' => $request->name[$key],
                    'rgb1' => $request->rgb1[$key],
                    'simple' => $request->simple[$key],
                ]);
            }

            return back()->with('flash_success','Car Added successfully');
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
        //
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

        try{  

        $this->validate($request, [
            'vif' => 'required|max:255|unique:viflists,vif,' . $id,
            'yr' => 'required|max:255',
            'make' => 'required|max:255',
            'model' => 'required|max:255',
            'trim' => 'required|max:255',
            'whls' => 'required|max:255',
            'body' => 'required|max:255',
            'drs' => 'required|max:255',
            'vin' => 'required|max:255',
            'org' => 'required|max:255',
            'send' => 'required|max:255'
        ]);
            $viflist = Viflist::find($id);
            $car_images = $viflist->CarImages()->update([
                'car_id' => $request->vif,
            ]);
            $car_colors = $viflist->CarColors()->update([
                'vif' => $request->vif,
            ]);
            $viflist->update($request->except(['_method','_token']));


            return back()->with('flash_success','Car Updated successfully');
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

            $viflist = Viflist::find($id); 

            foreach ($viflist->CarImages as $key => $car) {

                if(file_exists(url($car->image))){
                    unlink(url($car->image));
                }
                $car->delete();
            }
            CarColor::where('vif',$viflist->vif)->delete();

            $viflist->delete();
            return back()->with('flash_sucess', 'Car deleted successfully');
        } 
        catch (Exception $e) {

            return back()->with('flash_error', 'Car Not Found');
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCarImages($id)
    {
        $vif = Viflist::find($id);
        $cars =CarImage::with('CarColor')->where('car_id',$vif->vif)->paginate(10);
        // dd($cars[0],$cars[0]->CarColor->where('code',$cars[0]->color_code)->first()->simple);
        $brands = Wheel::select('brand')->distinct('brand')->get();
        return view('admin.car.images',compact('cars','brands','vif'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setCarImages(Request $request,$id)
    { 

        try{  

        $this->validate($request, [
            'cc.*' => 'required|max:255',
            'color_code.*' => 'required|max:255',
            'evoxcode.*' => 'required|max:255',
            'name.*' => 'required|max:255',
            'simple.*' => 'required|max:255',
            'rgb1.*' => 'required|max:255',
            'car_image.*' => 'required|mimes:jpg,png|max:5242880',
        ]);
            $viflist = Viflist::find($id);

            foreach ($request->car_image as $key => $image) {
                $ext = $request->car_image[$key]->getClientOriginalExtension();
                $image_full_name = $viflist->vif.'_'.$request->cc[$key].'_032_'.$request->color_code[$key].'.'.$ext;
                $request->car_image[$key]->move(public_path('/storage/cars'), $image_full_name);
                $image_stored_path = 'storage/cars/'.$image_full_name;
                
                // Create a new record for the car images 
                $car_image = CarImage::create([
                    'car_id' => $viflist->vif,
                    'cc' => $request->cc[$key],
                    'color_code' => $request->color_code[$key],
                    'image' => $image_stored_path,
                ]);

                // Create a new record for the car colors 
                $car_color = CarColor::create([
                    'vif' => $viflist->vif,
                    'code' => $request->color_code[$key],
                    'evoxcode' => $request->evoxcode[$key],
                    'name' => $request->name[$key],
                    'rgb1' => $request->rgb1[$key],
                    'simple' => $request->simple[$key],
                ]);
            }

            return back()->with('flash_success','Car Images Added successfully');
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
    public function updateCarImages(Request $request,$id)
    {  
        // dd($request->all());
        $this->validate($request, [
            'cc' => 'required|max:255',
            'color_code' => 'required|max:255',
            'evoxcode' => 'required|max:255',
            'name' => 'required|max:255',
            'simple' => 'required|max:255',
            'rgb1' => 'required|max:255',
            'car_image' => 'required|mimes:jpg,png|max:5242880',
        ]);

        try{  
                $car = CarImage::find($id);
                $car_color = CarColor::where('code',$car->color_code)->where('vif',$car->car_id)->first(); 

                if($request->hasFile('car_image')){

                    //Remove the existing image in the folder
                    if(file_exists(public_path($car->image))){
                        unlink(public_path($car->image));
                    }

                    $ext = $request->car_image->getClientOriginalExtension();
                    $image_full_name = $car->car_id.'_'.$request->cc.'_032_'.$request->color_code.'.'.$ext;
                    $request->car_image->move(public_path('/storage/cars'), $image_full_name);
                    $image_stored_path = 'storage/cars/'.$image_full_name;


                    // Update the New Image 
                    $car->image = $image_stored_path;
                    $car->save();

                }
                
                // Updtae the record for the car images 
                $car->update([
                    'cc' => $request->cc,
                    'color_code' => $request->color_code,
                    'image' => $image_stored_path,
                ]);

                // Create a new record for the car colors 
                $car_color->update([ 
                    'code' => $request->color_code,
                    'evoxcode' => $request->evoxcode,
                    'name' => $request->name,
                    'rgb1' => $request->rgb1,
                    'simple' => $request->simple,
                ]);
            return back()->with('flash_success','Car Images & Colors Updated successfully');
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
    public function destroyCarImages($id)
    {
     
        try {
            $car_image = CarImage::find($id);
            if(file_exists(url($car_image->image))){
                unlink(url($car_image->image));
            }
            CarColor::where('vif',$car_image->car_id)->where('code',$car_image->color_code)->delete();
            $car_image->delete();

            return back()->with('flash_sucess', 'Car Images deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Car Images Not Found');
        }   
    }


    public function uploadcsv(Request $request){ 
        try{  



            if($request->hasFile('viflistuploadedfile') && $request->type == 'viflist' ){
                $filename = $request->vehicleuploadedfile->getClientOriginalName();  
                $request->vehicleuploadedfile->move(public_path('/storage/uploaded_csv'), $filename); 
                // dd(base_path('storage/app/public/uploaded_csv/').$filename);
                $filepath = base_path('storage/app/public/uploaded_csv/').$filename;  

                if( !$fr = @fopen($filepath, "r") ){

                    return back()->with('flash_error',"File Could not be read!!");
                }
                // $fw = fopen($out_file, "w");
                $i=1;
                
                while( ($data = fgetcsv($fr, 2000000, ",")) !== FALSE ) {
                    if($i != 1){ 
                        if((isset($data[0])&&$data[0]!='')){ 
                            $vif['vif'] =$data[0];
                            $vif['org'] =$data[1];
                            $vif['send'] =$data[2];
                            $vif['yr'] =$data[3];
                            $vif['make'] =$data[4];
                            $vif['model'] =$data[5];
                            $vif['trim'] =$data[6];
                            $vif['drs'] =$data[7];
                            $vif['body'] =$data[8];
                            $vif['cab'] =$data[9];
                            $vif['whls'] =$data[10];
                            $vif['vin'] =$data[11];
                            $vif['date_delivered'] =$data[12]; 
                            Viflist::updateOrCreate(['vif' =>$vif['vif']] , $vif ); 
                        }
                    }
                    $i++;
                }
                fclose($fr);
                return back()->with('flash_success','Viflist Data Uploaded successfully');
            }elseif($request->hasFile('carimagesuploadedfile') && $request->type == 'carimages' ){
                $filename = $request->carimagesuploadedfile->getClientOriginalName();  
                $request->carimagesuploadedfile->move(public_path('/storage/uploaded_csv'), $filename); 
                // dd(base_path('storage/app/public/uploaded_csv/').$filename);
                $filepath = base_path('storage/app/public/uploaded_csv/').$filename;  

                if( !$fr = @fopen($filepath, "r") ){

                    return back()->with('flash_error',"File Could not be read!!");
                }
                // $fw = fopen($out_file, "w");
                $i=1;
                
                while( ($data = fgetcsv($fr, 2000000, ",")) !== FALSE ) {
                    if($i != 1){ 
                        if((isset($data[0])&&$data[0]!='')){ 
                            $carimage['car_id'] =$data[0];
                            $carimage['cc'] =$data[1];
                            $carimage['color_code'] =$data[2];
                            $carimage['image'] =$data[3];  

                            CarImage::updateOrCreate(['car_id' =>$carimage['car_id'],'color_code' =>$carimage['color_code']] , $carimage ); 
                        }

                    }
                    $i++;
                }
                fclose($fr);
                return back()->with('flash_success','Car Images Data Uploaded successfully');
            }elseif($request->hasFile('carcolorsuploadedfile') && $request->type == 'carcolors' ){
                $filename = $request->carcolorsuploadedfile->getClientOriginalName();  
                $request->carcolorsuploadedfile->move(public_path('/storage/uploaded_csv'), $filename); 
                // dd(base_path('storage/app/public/uploaded_csv/').$filename);
                $filepath = base_path('storage/app/public/uploaded_csv/').$filename;  

                if( !$fr = @fopen($filepath, "r") ){

                    return back()->with('flash_error',"File Could not be read!!");
                }
                // $fw = fopen($out_file, "w");
                $i=1;
                
                while( ($data = fgetcsv($fr, 2000000, ",")) !== FALSE ) {
                    if($i != 1){ 
                        if((isset($data[0])&&$data[0]!='')){
 
                            $carcolor['vif'] = $data[0]?:null;
                            $carcolor['code'] = $data[1]?:null;
                            $carcolor['evoxcode'] = $data[2]?:null;
                            $carcolor['name'] = $data[3]?:null;
                            $carcolor['rgb1'] = $data[4]?:null;
                            $carcolor['rgb2'] = $data[5]?:null;
                            $carcolor['simple'] = $data[6]?:null;
                            $carcolor['shot'] = $data[7]?:null; 

                            CarColor::updateOrCreate(['vif' =>$carcolor['vif'],'code' =>$carcolor['code']] , $carcolor ); 
                        }
                    }
                    $i++;
                }
                fclose($fr);
                return back()->with('flash_success','Car Colors Data Uploaded successfully');
            }else{
                return back()->with('flash_error',"File Could not be read!!");
            }


        }catch(Exception $e){
            return back()->with('flash_error',$e->getMessage());
        } 

    }
}