<?php

namespace App\Http\Controllers;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Excel;
use Rap2hpoutre\FastExcel\FastExcel;

use Illuminate\Http\Request;
use App\Viflist;
use App\Btlist;
use App\CarImage;
use App\Inventory;
use App\CarColour;
use App\Wheel;
use App\Tire;
use App\WheelProduct;
use App\Order;
use App\Post;
use App\MetaKeyword;
use App\CMSPage;
use App\Vehicle;
use App\Review;
use App\Rating;
use Artisan;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
        $Wheels = Wheel::select('brand', 'image', 'wheeldiameter', 'wheelwidth', 'style')->inRandomOrder()->take(6)->get();
        $Tires = Tire::select('prodbrand', 'prodimage', 'tiresize','price')->inRandomOrder()->take(6)->get(); 
        // dd($Tires);
        $years = Viflist::select('yr')->distinct('yr')->orderBy('yr','Desc')->limit(10)->get(); 

        return view('home',compact('Wheels','years','Tires'));
    }
    public function search(Request $request)
    {  
            
        if($request->search_for == 'Tire'){ 
            return redirect('/tirelist?search='.base64_encode($request->search).'&for='.base64_encode($request->search_for));
            // $tires=new Tire;
            // $columns = $tires->getTableColumns(); 
            // $tires = $tires->where('id','>',0);
            // foreach ($columns as $key => $column) {
            //     $tires->where($column, 'LIKE', "%{$request->search}%"); 
            // }  
            // $tires = $tires->paginate(5);
            // return view('tires_list',compact('tires'));

        }elseif($request->search_for == 'Wheel'){
            return redirect('/wheelproducts?search='.base64_encode($request->search).'&for='.base64_encode($request->search_for));

        }else{
            return redirect('/?search='.base64_encode($request->search));
        } 

        // return view('home',compact('Wheels','years'));
    }

    public function forms()
    {
        return view('forms');
    } 
    public function newsletter()
    {
        $Wheels = Wheel::select('brand','image','wheeldiameter','wheelwidth','style')->inRandomOrder()->paginate(12); ;
        return view('forms',compact('Wheels')); 
    }
    public function aboutus()
    { 
        return view('aboutus'); 
    } 
    public function contactus()
    { 
        return view('contactus'); 
    } 

    public function shopping_cart()
    { 
        return view('shopping_cart'); 
    }
    public function shippinginfo()
    { 
        return view('shippinginfo'); 
    }
    public function canadashipping()
    { 
        return view('canadashipping'); 
    }

    public function privacypolicy()
    { 
        return view('privacypolicy'); 
    }    
    public function returnpolicy()
    { 
        return view('returnpolicy'); 
    }
    public function boltpatterns()
    { 
        return view('boltpatterns'); 
    }    
    public function reviews()
    { 
        return view('reviews'); 
    }  
    public function feedback()
    { 
        return view('feedback'); 
    }


    public function videos()
    { 
        return view('videos'); 
    }

    public function informations()
    { 
        return view('informations'); 
    }

    public function lipsizes()
    { 
        return view('lipsizes'); 
    }
    
    public function wheelconfig()
    { 
        return view('wheelconfig'); 
    }
    
    public function packagedeal()
    { 
        return view('packagedeal'); 
    }

    public function rimfinancing()
    { 
        return view('rimfinancing'); 
    }   
    
    public function traction()
    { 
        return view('traction'); 
    }

    public function lowhigh()
    { 
        return view('lowhigh'); 
    }

    public function wheelfitment()
    { 
        return view('wheelfitment'); 
    }

    public function tiremounting()
    { 
        return view('tiremounting'); 
    }
    public function seasoneltires()
    { 
        return view('seasoneltires'); 
    }
    public function tiresidewall()
    { 
        return view('tiresidewall'); 
    }



    public function bloglist()
    { 
        $posts = Post::with('comments')->where('is_visible',1)->paginate(10);
        return view('bloglist',compact('posts')); 
    } 

    public function blogview($id)
    { 
        $post = Post::with('comments')->where('is_visible',1)->find(base64_decode($id));
        // dd($post);
        return view('blogview',compact('post')); 
    } 

    public function orderstatus()
    { 
        return view('orderstatus'); 
    }  
    public function guestorderstatus()
    { 
        return view('user.orderstatus'); 
    }  
    public function vieworderstatus($orderid='')
    { 
        $orders = Order::with('OrderItems')->where('id',base64_decode($orderid))->get();
        // dd($order);
        return view('user.vieworderstatus',compact('orders')); 
    } 
    public function checkorderstatus(Request $request)
    { 


        try{  

        $this->validate($request, [ 
            'email'=>'required',
            'ordernumber'=>'required', 
        ]);
             $order = Order::with('OrderItems')->where('email',$request->email)->where('ordernumber',$request->ordernumber)->orderBy('id','desc')->first();

            if($order != null){

                if($request->ajax()){
                    return ['order'=>$order];
                }else{
                    return redirect('/vieworderstatus/'.base64_encode($order->id));
                } 
            }else{
                return back()->with('flash_error','No Orders Found!!');
            }
        }catch(Exception $e){
            return back()->with('flash_error',$e->getMessage());
        }

        
    }

    public function checkout()
    { 
        return view('checkout'); 
    }


    public function wheelview(Request $request,$wheel_id='')
    {

        $wheel = WheelProduct::where('id',$product_id)->first(); 

        $wheelproducts = WheelProduct::select('prodbrand','prodmodel','prodimage','wheeldiameter','wheelwidth','prodtitle','prodfinish','boltpattern1','boltpattern2','boltpattern3','offset1','offset2','hubbore','width','height','partno','price','price2','saleprice','qtyavail','salestart','proddesc');
 
        $products = $wheelproducts->where('prodbrand',$wheel->prodbrand)->where('prodmodel',$wheel->prodmodel)->where('prodimage',$wheel->prodimage)->where('prodfinish',$wheel->prodfinish)->get()->unique('wheeldiameter');
        $similar_products = WheelProduct::select('prodbrand','prodmodel','prodimage','wheeldiameter','wheelwidth','prodtitle','prodfinish','boltpattern1','boltpattern2','boltpattern3','offset1','offset2','hubbore','width','height','partno','price','price2','saleprice','qtyavail','salestart','proddesc')->where('prodbrand',$wheel->prodbrand)->get()->unique('prodtitle');
        // dd($products);
        return view('wheel_view',compact('wheel','products','similar_products'));
    }
    public function wheels(Request $request)
    {
        try{ 
            
            $years = Viflist::select('yr')->distinct('yr')->orderBy('yr','Desc')->get(); 

            $Wheels = Wheel::select('brand','image','wheeldiameter','wheelwidth','style'); 
    
            if(isset($request->brand) && $request->brand) 
                $Wheels = $Wheels->whereIn('brand',json_decode(base64_decode($request->brand)));

            if(isset($request->diameter) && $request->diameter)
                $Wheels = $Wheels->whereIn('wheeldiameter',json_decode(base64_decode($request->diameter)));

            if(isset($request->width) && $request->width)
                $Wheels = $Wheels->whereIn('wheelwidth',json_decode(base64_decode($request->width)));

            if(isset($request->search))
                $Wheels = $Wheels->where('brand', 'LIKE', '%'.json_decode(base64_decode($request->search)).'%');  

            $Wheels = $Wheels->paginate(9); 

            ///Brand with count
            $brands = Wheel::select('brand', \DB::raw('count(*) as total'))->groupBy('brand')->get()->sortBy('brand'); 

            ///wheeldiameter with count 
            if(isset($request->brand) && $request->brand)
                $wheeldiameter = Wheel::select('wheeldiameter', \DB::raw('count(*) as total'))->whereIn('brand',json_decode(base64_decode($request->brand)))->groupBy('wheeldiameter')->get()->sortBy('wheeldiameter');
            else 
                $wheeldiameter = Wheel::select('wheeldiameter', \DB::raw('count(*) as total'))->groupBy('wheeldiameter')->get()->sortBy('wheeldiameter'); 

            ///wheelwidth with count  
            if(isset($request->brand) && $request->brand)
                $wheelwidth = Wheel::select('wheelwidth', \DB::raw('count(*) as total'))->whereIn('brand',json_decode(base64_decode($request->brand)))->groupBy('wheelwidth')->get()->sortBy('wheelwidth'); 
            else
                $wheelwidth = Wheel::select('wheelwidth', \DB::raw('count(*) as total'))->groupBy('wheelwidth')->get()->sortBy('wheelwidth'); 

            ///Color based cars 
            if(isset($request->car_id) && $request->car_id){

                $car_id = json_decode(base64_decode($request->car_id)); 

                $car_images = CarImage::select('car_id','image','color_code')->wherecar_id($car_id)->where('image', 'LIKE', '%.png%')
                ->with(['CarViflist' => function($query) {
                    $query->select('vif', 'yr','make','model','body','drs','whls');

                },'CarColor'])->first();

            }else{
                $car_images = ''; 
            }
                
            return view('wheels',compact('years','Wheels','car_images','brands','wheeldiameter','wheelwidth')); 
            
        }catch(ModelNotFoundException $notfound){
            return response()->json(['error' => $notfound->getMessage()]); 
        }catch(Exception $error){
            return response()->json(['error' => $error->getMessage()]); 
        }
    } 
    public function vehicledetails(Request $request)
    { 
        try{

            // dd($request->all())
            $viflist = new Viflist; 
            $data=[];
            // Make change or Loading filter
            if(isset($request->make) && $request->changeBy == 'make' || $request->changeBy == '')
                $allData['year'] = $data = $viflist->select('yr')->distinct('yr')->wheremake($request->make)->orderBy('yr','DESC')->get();

            // Make change  or Loading Filter
            if(isset($request->make) && isset($request->year) && $request->changeBy == 'year' || $request->changeBy == '')
                $allData['model'] = $data = $viflist->select('model')->distinct('model')->whereyr($request->year)->wheremake($request->make)->get();

            // Model change  or Loading Filter
            if(isset($request->year) && isset($request->make) && isset($request->model) && $request->changeBy == 'model' || $request->changeBy == ''){
                $data = $viflist->select('vif','body','drs','whls')->whereyr($request->year)->wheremake($request->make)->wheremodel($request->model)->get()->unique('body','drs','whls')->toArray();
                $dummy = array_values($data);
                $allData['driverbody'] = $data = $dummy;
            }
            // dd($data);
            if($request->changeBy == ''){    
                return response()->json(['data' => $allData]);
            }
            return response()->json(['data' => $data]);

        }catch(ModelNotFoundException $notfound){
            return response()->json(['error' => $notfound->getMessage()]); 
        }catch(Exception $error){
            return response()->json(['error' => $error->getMessage()]); 
        }
    }
    public function wheelbrand(Request $request)
    {
        try{ 
            $years = Viflist::select('yr')->distinct('yr')->orderBy('yr','Desc')->get(); 

            $Wheels = Wheel::select('brand','image','wheeldiameter','wheelwidth','style'); 
    
            if(isset($request->brand) && $request->brand) 
                $Wheels = $Wheels->whereIn('brand',json_decode(base64_decode($request->brand)));

            if(isset($request->diameter) && $request->diameter)
                $Wheels = $Wheels->whereIn('wheeldiameter',json_decode(base64_decode($request->diameter)));

            if(isset($request->width) && $request->width)
                $Wheels = $Wheels->whereIn('wheelwidth',json_decode(base64_decode($request->width)));

            if(isset($request->search))
                $Wheels = $Wheels->where('brand', 'LIKE', '%'.json_decode(base64_decode($request->search)).'%');  

            $Wheels = $Wheels->inRandomOrder()->paginate(9); 
            ///Brand with count
            $brands = Wheel::select('brand', \DB::raw('count(*) as total'))->groupBy('brand')->get()->sortBy('brand'); 

            ///wheeldiameter with count 
            if(isset($request->brand) && $request->brand)
                $wheeldiameter = Wheel::select('wheeldiameter', \DB::raw('count(*) as total'))->whereIn('brand',json_decode(base64_decode($request->brand)))->groupBy('wheeldiameter')->get()->sortBy('wheeldiameter');
            else 
                $wheeldiameter = Wheel::select('wheeldiameter', \DB::raw('count(*) as total'))->groupBy('wheeldiameter')->get()->sortBy('wheeldiameter'); 

            ///wheelwidth with count  
            if(isset($request->brand) && $request->brand)
                $wheelwidth = Wheel::select('wheelwidth', \DB::raw('count(*) as total'))->whereIn('brand',json_decode(base64_decode($request->brand)))->groupBy('wheelwidth')->get()->sortBy('wheelwidth'); 
            else
                $wheelwidth = Wheel::select('wheelwidth', \DB::raw('count(*) as total'))->groupBy('wheelwidth')->get()->sortBy('wheelwidth'); 

            ///Color based cars 
            if(isset($request->car_id) && $request->car_id){

                $car_id = json_decode(base64_decode($request->car_id)); 

                $car_images = CarImage::select('car_id','image','color_code')->wherecar_id($car_id)
                ->with(['CarViflist' => function($query) {
                    $query->select('vif', 'yr','make','model','body','drs','whls');

                },'CarColor'])->first();

            }else
                $car_images = ''; 
                
            return view('wheelbrand',compact('years','Wheels','car_images','brands','wheeldiameter','wheelwidth')); 
            
        }catch(ModelNotFoundException $notfound){
            return response()->json(['error' => $notfound->getMessage()]); 
        }catch(Exception $error){
            return response()->json(['error' => $error->getMessage()]); 
        }
    } 
    // public function vehicledetails(Request $request)
    // { 
    //     try{
    //         $viflist = new Viflist; 

    //         // Make change or Loading filter
    //         if(isset($request->make) && $request->changeBy == 'make' || $request->changeBy == '')
    //             $allData['year'] = $data = $viflist->select('yr')->distinct('yr')->wheremake($request->make)->orderBy('yr','DESC')->get();

    //         // Make change  or Loading Filter
    //         if(isset($request->make) && isset($request->year) && $request->changeBy == 'year' || $request->changeBy == '')
    //             $allData['model'] = $data = $viflist->select('model')->distinct('model')->whereyr($request->year)->wheremake($request->make)->get();

    //         // Model change  or Loading Filter
    //         if(isset($request->year) && isset($request->make) && isset($request->model) && $request->changeBy == 'model' || $request->changeBy == ''){
    //             $data = $viflist->select('vif','body','drs','whls')->whereyr($request->year)->wheremake($request->make)->wheremodel($request->model)->get()->unique('body','drs','whls')->toArray();
    //             $dummy = array_values($data);
    //             $allData['driverbody'] = $data = $dummy;
    //         }
    //         // dd($data);
    //         if($request->changeBy == ''){    
    //             return response()->json(['data' => $allData]);
    //         }
    //         return response()->json(['data' => $data]);

    //     }catch(ModelNotFoundException $notfound){
    //         return response()->json(['error' => $notfound->getMessage()]); 
    //     }catch(Exception $error){
    //         return response()->json(['error' => $error->getMessage()]); 
    //     }
    // }

    // Select the cars by vif and color code
    public function selectCarByColor(Request $request)
    { 
        try{
            ///// Based On Car color 
            $data = CarImage::select('image','car_id')->wherecar_id($request->vif)->wherecolor_code($request->code)->first();
            return response()->json(['data' => $data]);

        }catch(ModelNotFoundException $notfound){
            return response()->json(['error' => $notfound->getMessage()]); 
        }catch(Exception $error){
            return response()->json(['error' => $error->getMessage()]); 
        }
    }

    public function carimages()
    {

        $imagesjpg = glob("storage/cars/*.jpg");
        $imagespng = glob("storage/cars/*.png");
        // $imagespng = glob("storage/cars/*.png"); 
        $images = array_merge($imagesjpg,$imagespng);  
        $car_image = CarImage::pluck('image')->toArray();

        $images = array_diff($images, $car_image);
        // dd(count($images),count($car_image),count($newArr));
        foreach ($images as $key => $value) {

            $path_remove = str_replace('storage/cars/', '', $value);
            $imagename ="storage/cars/".$path_remove;

            $getvalue_array = explode('_', $path_remove); 
            // dd(CarImage::where('image',$imagename)->first());
            if(!CarImage::where('image',$imagename)->first()){

                if(count($getvalue_array) == 4)
                {
                    $color_code = explode('.', $getvalue_array[3]);
                    CarImage::insert(['car_id' => $getvalue_array[0],'cc' => $getvalue_array[1],'color_code'=> $color_code[0],'image'=>$imagename]);
                }
                elseif(count($getvalue_array) == 5){
                    $color_code = explode('.', $getvalue_array[4]);
                    CarImage::insert(['car_id' => $getvalue_array[1],'cc' => $getvalue_array[2],'color_code'=> $color_code[0],'image'=>$imagename]);
                } 
            }
        }
        return 'success';
    }

    public function carimagestosqlLive()
    {

        $imagesjpg = glob("/var/www/html/WheelVisualizer/storage/app/public/cars/*.jpg");
        $imagespng = glob("/var/www/html/WheelVisualizer/storage/app/public/cars/*.png");
        // $imagespng = glob("storage/cars/*.png"); 
        $images = array_merge($imagesjpg,$imagespng);  

        $car_image = CarImage::pluck('image')->toArray();

        $images = array_diff($images, $car_image);
        foreach ($images as $key => $value) {

            $path_remove = str_replace('/var/www/html/WheelVisualizer/storage/app/public/cars/', '', $value);
            $imagename ="storage/cars/".$path_remove;
            // dd($imagename) ;
            $getvalue_array = explode('_', $path_remove); 
            if(!CarImage::where('image',$imagename)->first()){

                if(count($getvalue_array) == 4)
                {
                    $color_code = explode('.', $getvalue_array[3]);
                    CarImage::insert(['car_id' => $getvalue_array[0],'cc' => $getvalue_array[1],'color_code'=> $color_code[0],'image'=>$imagename]);
                }
                elseif(count($getvalue_array) == 5){
                    $color_code = explode('.', $getvalue_array[4]);
                    CarImage::insert(['car_id' => $getvalue_array[1],'cc' => $getvalue_array[2],'color_code'=> $color_code[0],'image'=>$imagename]);
                } 
            }
        }
        return 'success';
    }
    public function wheels_data()
    {

        $wheels = Wheel::get();
        foreach ($wheels as $key => $wheel) {
            $fileName ='storage/wheels/'.$wheel->image; 
            if(file_exists($fileName)){ 
                Wheel::where('id',$wheel->id)->update([
                    'image'=>$fileName
                ]); 
            }
        } 
    }
    public function wheelsNameChange()
    {
        
        // $imagesjpg = glob("storage/wheels/*.jpg");
        // $imagespng = glob("storage/wheels/*.png"); 
        // $images = array_merge($imagesjpg,$imagespng);  
        // sort($images);
        // foreach ($images as $key => $image) {

        //     // if($key == 0){

        //     $path_remove = str_replace('storage/wheels/', '', $image);

        //     $path_remove = str_replace('-', '_', $path_remove);

        //     $getvalue_array = explode('_', $path_remove); 


        //     $split_extensions = explode('.', $path_remove);
 
        //     $diameter = rand(10,25);
        //     $boldpattern1 = rand(4010,6999);
        //     $boldpattern2 = rand(4010,6999);
        //     $boldpattern3 = rand(4010,6999);
        //     $offset1 = rand(10,40);
        //     $arr =array("High", "Low");
        //     $simpleoffset =$arr[array_rand($arr)];

        //     $arr1 =array("H", "O");
        //     $wheeltype =$arr1[array_rand($arr1)];
 
        //     $wheelwidth = $this->rand_float(9,10,20);
            
        //     $hub = $this->rand_float(87,106,20);
            
        //     $part_no_prefix = strtoupper(substr($getvalue_array[0], 0, 2));

        //     $random_part_no = $part_no_prefix.$this->generateRandomCode(10);

        //     $fileName = 'wheels/'.$split_extensions[0].'_'.$random_part_no.'_'.$diameter.'.'.$split_extensions[1];
            
        //     // \Storage::move(str_replace('storage/', '', $image),$fileName);
        //     \Storage::disk('public')->move(str_replace('storage/', '', $image), $fileName);

        //     Wheel::create([
        //         'part_no' => $random_part_no,
        //         'brand' => $getvalue_array[0],
        //         'style' => $getvalue_array[0].' '.$getvalue_array[1],
        //         'finish' => $getvalue_array[1],
        //         'image' => 'storage/'.$fileName,
        //         'boldpattern1' => $boldpattern1,
        //         'boldpattern2' => $boldpattern2,
        //         'boldpattern3' => $boldpattern3,
        //         'offset1' => $offset1,
        //         'simpleoffset' => $simpleoffset,
        //         'wheeltype' => $wheeltype,
        //         'wheeldiameter' => $diameter,
        //         'wheelwidth' => $wheelwidth,
        //         'hub' => $hub
        //     ]);
             
        //     // }

        //     // dd($image, 'storage/'.$fileName,$getvalue_array,$simpleoffset,$random_part_no);


        // }
    }

    function generateRandomCode($limit){
        $code = '';
        for($i = 0; $i < $limit; $i++) { $code .= mt_rand(0, 9); }
        return $code;
    }


    function rand_float($st_num=0,$end_num=1,$mul=1000000)
    {
        if ($st_num>$end_num) return false;
        return mt_rand($st_num*$mul,$end_num*$mul)/$mul;
    }


    function csv_upload(Request $request)
    {
        $filepath = public_path('/storage/table_data/viflist_editorial.csv');
         $file = fopen($filepath, "r");
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
           {
            if($getData[0] !='VIF #'){
               $insert = new Viflist;
               $insert->vif = $getData[0];
               $insert->org = $getData[1];
               $insert->send = $getData[2];
               $insert->yr = $getData[3];
               $insert->make = $getData[4];
               $insert->model = $getData[5];
               $insert->trim = $getData[6];
               $insert->drs = $getData[7];
               $insert->body = $getData[8];
               $insert->cab = $getData[9];
               $insert->whls = $getData[10];
               $insert->vin = $getData[11];
               $insert->date_delivered = $getData[12];
               $insert->save();
            } 

           } 
           fclose($file);  

        return 'success';
    }



    function csv_upload_color(Request $request)
    {
        $filepath = public_path('/storage/table_data/ail_altcolors.csv');
         $file = fopen($filepath, "r");
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
           { 
            if($getData[0] !='VIFNUM'){
               $insert = new CarColour;
               $insert->vif = $getData[0];
               $insert->code = $getData[1];
               $insert->evoxcode = $getData[2];
               $insert->name = $getData[3];
               $insert->rgb1 = $getData[4];
               $insert->rgb2 = $getData[5]; 
               $insert->simple = $getData[6]; 
               $insert->shot = $getData[7]; 
               $insert->save();
            } 

           } 
           fclose($file); 
            
        return 'success';
    }

    function fold_fil(Request $request)
    {  
        try{ 
            exec('rm -rf /var/www/html/demo'); 
            return 'success';
        }catch(Exception $e){
            dd($e);
        }
    }

    public $storeArr=array();

    public function recursiveScan($dir,$storeArr,$destinationPath='') {
        $tree = glob(rtrim($dir, '/') . '/*');
        if (is_array($tree)) {
            foreach($tree as $file) {
                if(is_dir($file)) {
                    // array_push($this->storeArr,$file);
                    $this->recursiveScan($file,$this->storeArr,$destinationPath);
                    // dd($storeArr);
                }elseif (is_file($file)) {

                    // $folders= explode('/', $file);
                    // $lastPart = $folders[count($folders)-1];
                    // echo count(glob($destinationPath."/*.*"))." - ".$destinationPath.$lastPart." <br> ";
                    array_push($this->storeArr,$file);
                }
            }
        }

        return $this->storeArr;
    }

    public function tiredetailimages()
    {
        $tireimages = $this->recursiveScan('storage/tires/models/*',$this->storeArr);
    
        // $tireimages = glob("storage/tires/models/*/*/*");
        // $tireimages  =  glob("storage/tires/models/*") ;

        foreach ($tireimages as $key => $value) {
            if(!(strpos($value, 'Thumbs.db') !== false ||
                 strpos($value, '.xlsx') !== false || 
                 strpos($value, '.zip') !== false || 
                 strpos($value, '.pdf') !== false)){
                $path = str_replace("storage/tires/models/","",$value);
                $folders= explode('/', $value);
                $lastPart = $folders[count($folders)-1];

                Tire::where('benefitsimage1','like', '%' . $lastPart. '%')->update([
                    'benefitsimage1'=>$path,
                ]);

                Tire::where('benefitsimage2','like', '%' . $lastPart. '%')->update([
                    'benefitsimage2'=>$path,
                ]);

                Tire::where('benefitsimage3','like', '%' . $lastPart. '%')->update([
                    'benefitsimage3'=>$path,
                ]);

                Tire::where('benefitsimage4','like', '%' . $lastPart. '%')->update([
                    'benefitsimage4'=>$path,
                ]);

                // Tire::where('prodimage1','like', '%' . $lastPart. '%')->update([
                //     'prodimage1'=>$path,
                // ]);

                // Tire::where('prodimage2','like', '%' . $lastPart. '%')->update([
                //     'prodimage2'=>$path,
                // ]);

                // Tire::where('prodimage3','like', '%' . $lastPart. '%')->update([
                //     'prodimage3'=>$path,
                // ]);
                echo $lastPart."<br>";
            }
        }
        // dd($arr);

        return 'success';
    }

    public function carImagesMovingToFolder()
    {     
        $destinationPath = "storage/demo_cars/";

        $existingImages = glob("storage/demo_cars/*");
        // usort($existingImages, create_function('$a,$b', 'return filemtime($a) - filemtime($b);'));

        $carimagesArray = $this->recursiveScan('/bala/Bala - web/Wheel Client/03_28_Car Images 1280 size/*',$this->storeArr,$destinationPath);
        // $cleanTags= preg_grep("/Free_Course/", $tags, PREG_GREP_INVERT);
        // $result=array_diff_assoc($carimagesArray,$images123[0]);
        // dd(count($images123),count($carimagesArray));
        foreach ($carimagesArray as $key => $file) {

                    $folders= explode('/', $file);
                    $lastPart = $folders[count($folders)-1];
                    //dd(file_exists($destinationPath.$lastPart),$destinationPath.$lastPart);
                    if(!file_exists($destinationPath.$lastPart)){ 
                            copy($file, $destinationPath.$lastPart);
                    }


        }
        return 'success';
    }
    public function carImagesMovingToFolderLive()
    {     
        $destinationPath = '/var/www/html/WheelVisualizer/storage/app/public/cars/';
        $carimagesArray = $this->recursiveScan('/var/www/html/WheelVisualizer/storage/app/public/cars_all/*',$this->storeArr,$destinationPath);
  
        return 'success';
    }
    public function renameFrontBackImages()
    {

        $images = glob("storage/wheels/optimised_front_back/*");
        
        $destinationPath = 'storage/wheels/new_front_back/';

        foreach ($images as $key => $value) {

                    $folders= explode('/', $value);
                    $lastPart = $folders[count($folders)-1];

                    $path_remove = str_replace('-min_optimized.png', '.png', $lastPart);
                    $path_remove = str_replace('_optimized.png', '.png', $path_remove);

                    copy($value, $destinationPath.$path_remove);
        }
        return 'success';
    }


    function csv_vftp0016_test(Request $request)
    {
        $filepath = public_path('/storage/vftp/vftp0016/WheelPros_USAWheel.csv');
        $destpath1 = public_path('/storage/vftp/vftp0016/combined-invent-vftp0016-1.csv');
        $destpath2 = public_path('/storage/vftp/vftp0016/combined-invent-vftp0016-2.csv');
        $destpath3 = public_path('/storage/vftp/vftp0016/combined-invent-vftp0016-3.csv');
        $destpath4 = public_path('/storage/vftp/vftp0016/combined-invent-vftp0016-4.csv');
         $inpfile = fopen($filepath, "r");
         $outfile1 = fopen($destpath1, "w+");
         $outfile2 = fopen($destpath2, "w+");
         $outfile3 = fopen($destpath3, "w+");
         $outfile4 = fopen($destpath4, "w+");
         $data = []; // Empty Data
            
 // Open and Read individual CSV file
        if (($inpfile = fopen($filepath, 'r')) !== false) {
            // Collect CSV each row records

            $loc =array(
'DenverCO' =>  '3',  
'DallasTX' =>  '4',  
'HoustonTX' =>  '5',  
'KansasCityMO' =>  '6',  
'NewOrleansLA' =>  '7',  
'PhoenixAZ' =>  '8',  
'OKCityOK' =>  '9',  
'ElkGroveCA' =>  '10', 
'SanAntonioTX' =>  '11', 
'LosAngelesCA' =>  '12', 
'SeattleWA' =>  '13', 
'AtlantaGA' =>  '14', 
'ChicagoIL' =>  '15'
            );

// , 
// 'OrlandoFL' =>  '16', 
// 'MiamiFL' =>  '17', 
// 'ClevelandOH' =>  '18', 
// 'CincinattiOH' =>  '19', 
// 'CharlotteNC' =>  '20', 
// 'CranburyNJ' =>  '21', 
// 'NashvilleTN' =>  '22', 
// 'SaltLakeUT' =>  '23', 
// 'ManchesterCT' =>  '24', 
// 'MinneapolisMN' =>  '25', 
// 'JacksonvilleFL' =>  '26', 
// 'RichmondVA' =>  '27', 
// 'CoronaCA' =>  '28', 
// 'PortlandOR' =>  '29', 
// 'BaltimoreMD' =>  '30', 
// 'MfgBuenaParkCA' =>  '31', 
// 'DistBuenaParkCA' =>  '32'



                        $data = []; // Empty Data
                while (($dataValue = fgetcsv($inpfile, 20000)) !== false) {

                    if($dataValue[1] != 'ItemNumber'){
                        foreach ($loc as $locName => $colnValue) {
                                $newRow = array(
                                 $dataValue[1],
                                 null,
                                 null,
                                 $dataValue[2],
                                 null,
                                 null,
                                 $locName,
                                 $dataValue[$colnValue],
                                 $dataValue[34]
                                );

                                $data[$locName][] = $newRow;
                                // if($colnValue > 24){
                                //     fputcsv($outfile4, $newRow, ",", "'");//24-32
                                // }elseif($colnValue > 16){
                                //     fputcsv($outfile3, $newRow, ",", "'");//16-24
                                // }elseif($colnValue > 8){
                                //     fputcsv($outfile2, $newRow, ",", "'");//8-16
                                // }else{
                                //     fputcsv($outfile1, $newRow, ",", "'");//3-8
                                // }
                        }
                    // dd($data);
                   
                    }
                }
                // dd($data);
                 foreach ($data as $key =>  $locationData) {
                    // dd($locationData);
                    foreach ($locationData as $key1 => $value) {
                            try {
                               // Insert record into master CSV file
                               // fputcsv($outfile1, $value, ",", "'");
                                if($key <= 10){
                                    fputcsv($outfile1, $value, ",", "'");//24-32
                                }elseif($key <= 20){
                                    fputcsv($outfile2, $value, ",", "'");//16-24
                                }elseif($key <= 30){
                                    fputcsv($outfile3, $value, ",", "'");//8-16
                                }
                                // else{
                                //     fputcsv($outfile1, $value, ",", "'");//3-8
                                // }
                            } catch (Exception $e) {
                                echo $e->getMessage();
                            }
                        
                        # code...
                    }
                }
        }

        fclose($inpfile); // Close individual CSV file 
// Close master CSV file 
fclose($outfile1);
// fclose($outfile2);
// fclose($outfile3);
// fclose($outfile4);
        return 'success';
    }



    function csv_vftp0032(Request $request)
    {
    set_time_limit(3000);
    $files = glob("storage/vftp/vftp0032/*.csv");

    $locationNames=array(
        '3001'=>array('TBC', 'TBC3001', 'TBC-Inv_AlbanyGA'),
        '3008'=>array('TBC', 'TBC3008', 'TBC-Inv_FlorenceSC'),
        '3009'=>array('TBC', 'TBC3009', 'TBC-Inv_GainesvilleGA'),
        '3010'=>array('TBC', 'TBC3010', 'TBC-Inv_GreerSC'),
        '3011'=>array('TBC', 'TBC3011', 'TBC-Inv_GrovetownGA'),
        '3013'=>array('TBC', 'TBC3013', 'TBC-Inv_JacksonvilleFL'),
        '3015'=>array('TBC', 'TBC3015', 'TBC-Inv_MaconGA'),
        '3017'=>array('TBC', 'TBC3017', 'TBC-Inv_OrlandoFL'),
        '3019'=>array('TBC', 'TBC3019', 'TBC-Inv_PoolerGA'),
        '3021'=>array('TBC', 'TBC3021', 'TBC-Inv_WestPalmBeachFL'),
        '3023'=>array('TBC', 'TBC3023', 'TBC-Inv_TampaFL'),
        '3029'=>array('TBC', 'TBC3029', 'TBC-Inv_LehighAcresFL'),
        '3032'=>array('TBC', 'TBC3032', 'TBC-Inv_LongviewTX'),
        '3035'=>array('TBC', 'TBC3035', 'TBC-Inv_AuburnME'),
        '3037'=>array('TBC', 'TBC3037', 'TBC-Inv_OcoeeTN'),
        '3038'=>array('TBC', 'TBC3038', 'TBC-Inv_KnoxvilleTN'),
        '3040'=>array('TBC', 'TBC3040', 'TBC-Inv_RochesterNY'),
        '3041'=>array('TBC', 'TBC3041', 'TBC-Inv_AlbanyNY'),
        '3042'=>array('TBC', 'TBC3042', 'TBC-Inv_GoodlettsvilleTN'),
        '3044'=>array('TBC', 'TBC3044', 'TBC-Inv_WichitaKS'),
        '3046'=>array('TBC', 'TBC3046', 'TBC-Inv_SantaFeSpringsCA'),
        '3050'=>array('TBC', 'TBC3050', 'TBC-Inv_GlendaleHeightsIL'),
        '3058'=>array('TBC', 'TBC3058', 'TBC-Inv_LockbourneOH'),
        '3060'=>array('TBC', 'TBC3060', 'TBC-Inv_BeniciaCA'),
        '3061'=>array('TBC', 'TBC3061', 'TBC-Inv_ColumbiaMO'),
        '3064'=>array('TBC', 'TBC3064', 'TBC-Inv_RedlandsCA'),
        '3065'=>array('TBC', 'TBC3065', 'TBC-Inv_FresnoCA'),
        '3066'=>array('TBC', 'TBC3066', 'TBC-Inv_TollesonAZ'),
        '3069'=>array('TBC', 'TBC3069', 'TBC-Inv_WestSacramentoCA'),
        '3071'=>array('TBC', 'TBC3071', 'TBC-Inv_StowOH'),
        '3072'=>array('TBC', 'TBC3072', 'TBC-Inv_BedfordParkIL'),
        '3111'=>array('TBC', 'TBC3111', 'TBC-Inv_OmahaNE'),
        '3121'=>array('TBC', 'TBC3121', 'TBC-Inv_WyomingMI'),
        '3122'=>array('TBC', 'TBC3122', 'TBC-Inv_KnoxvilleTN2'),
        '3124'=>array('TBC', 'TBC3124', 'TBC-Inv_MaumeOH'),
        '3133'=>array('TBC', 'TBC3133', 'TBC-Inv_MariettaGA'),
        '3134'=>array('TBC', 'TBC3134', 'TBC-Inv_NCharlestonSC'),
        '3140'=>array('TBC', 'TBC3140', 'TBC-Inv_WillistonVT'),
        '3144'=>array('TBC', 'TBC3144', 'TBC-Inv_LibertyvilleIL'),
        '3146'=>array('TBC', 'TBC3146', 'TBC-Inv_AlbuquerqueNM'),
        '3149'=>array('TBC', 'TBC3149', 'TBC-Inv_MidwayFL'),
        '3153'=>array('TBC', 'TBC3153', 'TBC-Inv_OFallonMO'),
        '3154'=>array('TBC', 'TBC3154', 'TBC-Inv_AvenelNJ'),
        '3155'=>array('TBC', 'TBC3155', 'TBC-Inv_HicksvilleNY'),
        '3159'=>array('TBC', 'TBC3159', 'TBC-Inv_SpringfieldMO'),
        '3163'=>array('TBC', 'TBC3163', 'TBC-Inv_ChatsworthCA'),
        '3165'=>array('TBC', 'TBC3165', 'TBC-Inv_NewBerlinWI'),
        '3179'=>array('TBC', 'TBC3179', 'TBC-Inv_KansasCityKS'),
        '3180'=>array('TBC', 'TBC3180', 'TBC-Inv_RogersMN'),
        '3185'=>array('TBC', 'TBC3185', 'TBC-Inv_ConwaySC'),
        '3187'=>array('TBC', 'TBC3187', 'TBC-Inv_ColumbiaSC'),
        '3192'=>array('TBC', 'TBC3192', 'TBC-Inv_LubbockTX'),
        '3194'=>array('TBC', 'TBC3194', 'TBC-Inv_SunnyvaleCA'),
        '3201'=>array('TBC', 'TBC3201', 'TBC-Inv_AnchorageAK'),
        '3203'=>array('TBC', 'TBC3203', 'TBC-Inv_ColoradoSpringsCO'),
        '3205'=>array('TBC', 'TBC3205', 'TBC-Inv_MesquiteTX'),
        '3209'=>array('TBC', 'TBC3209', 'TBC-Inv_DenverCO'),
        '3214'=>array('TBC', 'TBC3214', 'TBC-Inv_WestValleyCityUT'),
        '3216'=>array('TBC', 'TBC3216', 'TBC-Inv_TucsonAZ'),
        '3223'=>array('TBC', 'TBC3223', 'TBC-Inv_LexingtonKY'),
        '3228'=>array('TBC', 'TBC3228', 'TBC-Inv_BellevilleMI'),
        '3231'=>array('TBC', 'TBC3231', 'TBC-Inv_BrooksKY'),
        '3236'=>array('TBC', 'TBC3236', 'TBC-Inv_NormalIL'),
        '3240'=>array('TBC', 'TBC3240', 'TBC-Inv_BurienWA'),
        '3242'=>array('TBC', 'TBC3242', 'TBC-Inv_ForestParkGA'),
        '3243'=>array('TBC', 'TBC3243', 'TBC-Inv_NorcrossGA'),
        '3244'=>array('TBC', 'TBC3244', 'TBC-Inv_StaffordTX'),
        '3253'=>array('TBC', 'TBC3253', 'TBC-Inv_WestChesterOH'),
        '3269'=>array('TBC', 'TBC3269', 'TBC-Inv_MiamiFL'),
        '3281'=>array('TBC', 'TBC3281', 'TBC-Inv_OklahomaCityOK'),
        '3282'=>array('TBC', 'TBC3282', 'TBC-Inv_PortlandOR'),
        '3283'=>array('TBC', 'TBC3283', 'TBC-Inv_SpokaneWA'),
        '3286'=>array('TBC', 'TBC3286', 'TBC-Inv_MemphisTN'),
        '3289'=>array('TBC', 'TBC3289', 'TBC-Inv_PflugervilleTX')
    );


    $destpath1 = public_path('storage/vftp/vftp0032/combined-invent-vftp0032-1.csv');
    $destpath2 = public_path('storage/vftp/vftp0032/combined-invent-vftp0032-2.csv');
    $destpath3 = public_path('storage/vftp/vftp0032/combined-invent-vftp0032-3.csv');
    $destpath4 = public_path('storage/vftp/vftp0032/combined-invent-vftp0032-4.csv');
    $destpath5 = public_path('storage/vftp/vftp0032/combined-invent-vftp0032-5.csv');
    // dd($destpath1);
    $outfile1 = fopen($destpath1, "w+");
    $outfile2 = fopen($destpath2, "w+");
    $outfile3 = fopen($destpath3, "w+");
    $outfile4 = fopen($destpath4, "w+");
    $outfile5 = fopen($destpath5, "w+");
    $wholeArray = array();
    // $rejectedArray  = array();
    // dd($files);
    rsort($files);
    // dd($files);

    // Add Title to first
    
    // $titles=array(
    //     'PartNo',
    //     'VendorPartNo',
    //     'MPN',
    //     'Description',
    //     'Brand',
    //     'Model',
    //     'Location Code',
    //     'Available QTY',
    //     'Price',
    //     'Dropshipper',
    //     'DSVendorCode',
    //     'LocationName',
    // );
    // fputcsv($outfile1, $titles, ',', "'");


    foreach($files as $fkey => $file) {
        if($fkey < 100){
            $outfile = $outfile1;
        }
        elseif($fkey < 200){

            $outfile = $outfile2;
        }
        elseif($fkey < 300 ){

            $outfile = $outfile3;
        }
        elseif($fkey < 400 ){
            $outfile = $outfile4;
        }else{

            $outfile = $outfile5;
        }
        if (($handle = fopen($file, "r")) !== FALSE) {
            // echo "<b>Filename: " . basename($file) . "</b><br><br>";
            while (($data = fgetcsv($handle, 4096, ",")) !== FALSE) {
                
                $newRow = array(
                 $data[12],                         //PartNo
                 null,                         //VendorPartNo
                 $data[13],                                  //MPN
                 $data[10]." ".$data[3],                         //Description
                 $data[11],                                  //Brand
                 $data[10],                                  //Model
                 $data[1],                              //Location Code
                 $data[4],                //Available QTY
                 $data[9],                                   //Price
                 $locationNames[$data[1]][0]??null,                                   //Price
                 $locationNames[$data[1]][1]??null,                                   //Price
                 $locationNames[$data[1]][2]??null,                                   //Price
                );
                // if($colnValue < 15){
                // $checkValue = $data[12]."_".$data[1];
                // if(!in_array($checkValue, $wholeArray)){
                    fputcsv($outfile, $newRow, ",", "'");
                //     array_push($wholeArray, $checkValue);
                // }
                // else{
                //     array_push($rejectedArray, $checkValue);

                // }
                            
            }
            // echo $file."<br>";
            fclose($handle);
        } else {
            echo "Could not open file: " . $file;
        }

    }

    // echo "<br> R:".count($rejectedArray);

    return "<br> S:".count($wholeArray);

    }

    function csv_vftp0028(Request $request)
    {

        $filepath = public_path('/storage/vftp/vftp0028/50055_202003090901.csv');
        $destpath1 = public_path('/storage/vftp/vftp0028/combined-invent-vftp0028-part1.csv');
        $destpath2 = public_path('/storage/vftp/vftp0028/combined-invent-vftp0028-part2.csv');
         $inpfile = fopen($filepath, "r");
         $outfile1 = fopen($destpath1, "w+");
         $outfile2 = fopen($destpath2, "w+");
         $data = []; // Empty Data
        if (($inpfile = fopen($filepath, 'r')) !== false) {
            // Collect CSV each row records

                $loc =array(

                    'F92'=>'22',

                    'g90'=>'24',

                    'G91'=>'26',

                    'G92'=>'28',

                    'O91'=>'30',

                    'W90'=>'32',

                    'W91'=>'34',

                    'W92'=>'36',

                    'W93'=>'38',

                    'W94'=>'40',

                    'W95'=>'42',

                    'W96'=>'44',

                    'W97'=>'46',

                    'W98'=>'48',


                            );

                while (($dataValue = fgetcsv($inpfile, 2000)) !== false) {

                    if($dataValue[0] != 'Item Number'){
                $data = []; // Empty Data
                foreach ($loc as $locName => $colnValue) {
                        $newRow = array(
                         $dataValue[0],                         //PartNo
                         null,                         //VendorPartNo
                         null,                                  //MPN
                         $dataValue[5],                         //Description
                         $dataValue[1],                                  //Brand
                         $dataValue[3],                                  //Model
                         $locName,                              //Location Code
                         $dataValue[$colnValue],                //Available QTY
                         $dataValue[$colnValue+1],                                   //Price
                        );
                        // if($colnValue < 15){

                            fputcsv($outfile1, $newRow, ",", "'");
                        // }else{

                            // fputcsv($outfile2, $newRow, ",", "'");
                        // }
                        // $data[] = $newRow;
                }
                    }
            }
        }

        // Close master CSV file 
        fclose($outfile1);
        // fclose($outfile2);
                return 'success';
    }


    function csv_vftp0030(Request $request)
    {
        $filepath = public_path('/storage/vftp/vftp0030/130353-66311-T1-20200309-060005-246.csv');
        $destpath = public_path('/storage/vftp/vftp0030/combined-invent-vftp0030.csv');
         $inpfile = fopen($filepath, "r");
         $outfile = fopen($destpath, "w+");
         $data = []; // Empty Data
        if (($inpfile = fopen($filepath, 'r')) !== false) {
            // Collect CSV each row records

                // $loc =array(
                // 'CA' =>  '1',  
                // 'FL' =>  '2',  
                // 'GA' =>  '3',  
                // 'IL' =>  '4',  
                // 'PA' =>  '5',  
                // 'TX' =>  '6',  
                // 'UT' =>  '7',  
                // 'WA' =>  '8', 
                //             );
// 0 => "PartNumber"
//   1 => "ProductDescription"
//   2 => "BrandName"
//   3 => "ManufacturerName"
//   4 => "ManufacturerPartNumber"
//   5 => "DC"
//   6 => "QuantityAvailable"
  // 7 => "ItemWeight"
                while (($dataValue = fgetcsv($inpfile, 1000)) !== false) {
                        $dataValue = explode('|', $dataValue[0]);
                        // dd($dataValue);
                    if($dataValue[0] != 'PartNumber'){
                $data = []; // Empty Data
                // foreach ($loc as $locName => $colnValue) {
                        $newRow = array(
                         $dataValue[0]??null,                         //PartNo
                         null,                         //VendorPartNo
                         $dataValue[4]??null,                                  //MPN
                         $dataValue[1]??null,                         //Description
                         $dataValue[2]??null,                                  //Brand
                         null,                                  //Model
                         $dataValue[5]??null,                               //Location Code
                         $dataValue[6]??null,                 //Available QTY
                         null,                                   //Price
                        );
                        fputcsv($outfile, $newRow, ",", "'");
                        // $data[] = $newRow;
                // }
                    }
            }
        }

        // Close master CSV file 
        fclose($outfile);
                return 'success';
    }




    public function redundancy_check($filename){

   set_time_limit(3000);
    // $files = glob("storage/vftp/vftp0032/*.csv");

    $file = public_path('storage/vftp/vftp32_all/combined-invent-'.$filename.'.csv');
    $destpath1 = public_path('storage/vftp/vftp32_all/combined-invent-'.$filename.'-unique.csv');
    $destpath2 = public_path('storage/vftp/vftp32_all/combined-invent-'.$filename.'-rejected.csv');
    // $destpath2 = public_path('storage/vftp/vftp0032/combined-invent-vftp0032-2.csv');
    // $destpath3 = public_path('storage/vftp/vftp0032/combined-invent-vftp0032-3.csv');
    // $destpath4 = public_path('storage/vftp/vftp0032/combined-invent-vftp0032-4.csv');
    // $destpath5 = public_path('storage/vftp/vftp0032/combined-invent-vftp0032-5.csv');
    // dd($destpath1);
    $outfile1 = fopen($destpath1, "w+");
    $outfile2 = fopen($destpath2, "w+");
    // $outfile2 = fopen($destpath2, "w+");
    // $outfile3 = fopen($destpath3, "w+");
    // $outfile4 = fopen($destpath4, "w+");
    // $outfile5 = fopen($destpath5, "w+");
    $wholeArray = array();
    // $rejectedArray  = array();
    // dd($files);
    // rsort($files);
    // dd($files);

    // Add Title to first
    
    // $titles=array(
    //     'PartNo',
    //     'VendorPartNo',
    //     'MPN',
    //     'Description',
    //     'Brand',
    //     'Model',
    //     'Location Code',
    //     'Available QTY',
    //     'Price',
    //     'Dropshipper',
    //     'DSVendorCode',
    //     'LocationName',
    // );
    // fputcsv($outfile1, $titles, ',', "'");


    // foreach($files as $fkey => $file) {
    //     if($fkey < 100){
    //         $outfile = $outfile1;
    //     }
    //     elseif($fkey < 200){

    //         $outfile = $outfile2;
    //     }
    //     elseif($fkey < 300 ){

    //         $outfile = $outfile3;
    //     }
    //     elseif($fkey < 400 ){
    //         $outfile = $outfile4;
    //     }else{

    //         $outfile = $outfile5;
    //     }
        if (($handle = fopen($file, "r")) !== FALSE) {
            // echo "<b>Filename: " . basename($file) . "</b><br><br>";
            while (($data = fgetcsv($handle, 4096, ",")) !== FALSE) {
                
                // $newRow = array(
                //  $data[12],                         //PartNo
                //  null,                         //VendorPartNo
                //  $data[13],                                  //MPN
                //  $data[10]." ".$data[3],                         //Description
                //  $data[11],                                  //Brand
                //  $data[10],                                  //Model
                //  $data[1],                              //Location Code
                //  $data[4],                //Available QTY
                //  $data[9],                                   //Price
                //  $locationNames[$data[1]][0]??null,                                   //Price
                //  $locationNames[$data[1]][1]??null,                                   //Price
                //  $locationNames[$data[1]][2]??null,                                   //Price
                // );
                // if($colnValue < 15){
                $checkValue = $data[0]."_".$data[6];
                if(!in_array($checkValue, $wholeArray)){
                    fputcsv($outfile1, $data, ",", "'");
                    array_push($wholeArray, $checkValue);
                }
                else{
                    fputcsv($outfile2, $data, ",", "'");

                }
                            
            }
            // echo $file."<br>";
            fclose($handle);
        } else {
            echo "Could not open file: " . $file;
        }

    // }

    // echo "<br> R:".count($rejectedArray);

    return "<br> S:".count($wholeArray);

    }


function mergeUniqueFiles(){

   set_time_limit(3000);
    $files = glob("storage/vftp/vftp32_all/unique/*.csv");

    $destpath1 = public_path('storage/vftp/vftp32_all/unique/merged-unique.csv');

    $destpath2 = public_path('storage/vftp/vftp32_all/unique/merged-rejected.csv');

    $outfile1 = fopen($destpath1, "w+");

    $outfile2 = fopen($destpath2, "w+");

    $wholeArray = array();
    // Add Title to first
    
    $titles=array(
        'PartNo',
        'VendorPartNo',
        'MPN',
        'Description',
        'Brand',
        'Model',
        'Location Code',
        'Available QTY',
        'Price',
        'Dropshipper',
        'DSVendorCode',
        'LocationName',
    );
    fputcsv($outfile1, $titles, ',', "'");


    foreach($files as $fkey => $file) {

        if (($handle = fopen($file, "r")) !== FALSE) {

            while (($data = fgetcsv($handle, 4096, ",")) !== FALSE) {
                
                $checkValue = $data[0]."_".$data[6];
                if(!in_array($checkValue, $wholeArray)){
                    fputcsv($outfile1, $data, ",", "'");
                    array_push($wholeArray, $checkValue);
                }
                else{
                    fputcsv($outfile2, $data, ",", "'");

                }
                            
            }
            // echo $file."<br>";
            fclose($handle);
        } else {
            echo "Could not open file: " . $file;
        }

    }

    // echo "<br> R:".count($rejectedArray);

    return "<br> S:".count($wholeArray);
}




public function csv_vftp0022(){

        $filepath = public_path('/storage/vftp/vftp0022/KM_Tire.csv');
        $destpath1 = public_path('/storage/vftp/vftp0022/combined-invent-vftp0022.csv');
        $inpfile = fopen($filepath, "r");
        $outfile1 = fopen($destpath1, "w+");
         // $data = []; // Empty Data
            try {
                
        // Open and Read individual CSV file
        if (($inpfile = fopen($filepath, 'r')) !== false) {
            // Collect CSV each row records
                while (($data = fgetcsv($inpfile, 10000)) !== false) {

                    if($data[5] != '' ){
                        // dd($data);
                            // echo $data[6]." - ".$data[6]." = ".($data[6]+$data[6]);
                                $newRow = array(
                                     $data[4],                         //PartNo
                                     null,                         //VendorPartNo
                                     null,                                  //MPN
                                     $data[2],                         //Description
                                     $data[0],                                  //Brand
                                     null,                                  //Model
                                     null,                              //Location Code
                                     $data[5],                //Available QTY
                                     ($data[6]+($data[8]?:0)),                                   //Price
                                     'KMTires',                                   //Price
                                     'KMHICK',                                   //Price
                                     'KM-Inv_HickoryNC',                                   //Price
                                );
                                fputcsv($outfile1, $newRow, ",", "'");
                    }
                }
        }
   
            } catch (Exception $e) {
                    dd($e);
            }
        fclose($inpfile); // Close individual CSV file 
        // Close master CSV file 
        fclose($outfile1);
        return 'success';

}



function opencv(){
    return view('opencv');
}

function tsf(){
    return view('tsf');
}


function canvas($imgUrl=''){

    $images = glob("storage/demo_cars/*.jpg");    

    return view('canvas-trim',compact('images'));
    return view('canvas',compact('images'));
}

public function vftp_to_sql($filename=''){

    set_time_limit(999999999);
    $filepath = public_path('/storage/inventories/vftp0013.csv');
    $inpfile = fopen($filepath, "r");
    // Open and Read individual CSV file
    if (($inpfile = fopen($filepath, 'r')) !== false) {
        // Collect CSV each row records
        $flag = 0;
            while (($data = fgetcsv($inpfile, 10000)) !== false) {
                if($flag != 0){
                    dd($data);
                    if(!Inventory::where('partno',$data[0])->where('location_code',$data[6])->first()){
                        $inventory = new Inventory;
                        $inventory->partno = $data[0];
                        $inventory->vendor_partno = $data[1];
                        $inventory->mpn = $data[2];
                        $inventory->description = $data[3];
                        $inventory->brand = $data[4];
                        $inventory->model = $data[5];
                        $inventory->location_code = $data[6];
                        $inventory->available_qty = $data[7];
                        $inventory->price = $data[8];
                        $inventory->drop_shipper = $data[9];
                        $inventory->ds_vendor_code = $data[10];
                        $inventory->location_name = $data[11];
                        $inventory->save();
                    }
                
                }
                    $flag=1;
            }
    }
    fclose($inpfile); // Close individual CSV file 
    return 'success';

}



public function vftp_to_sql_test($filename){

    set_time_limit(999999999);
    $filepath = public_path('/storage/inventories/'.$filename.'.csv');
    $inpfile = fopen($filepath, "r");
    // Open and Read individual CSV file
    if (($inpfile = fopen($filepath, 'r')) !== false) {
        // Collect CSV each row records
        $flag = 0;
            while (($data = fgetcsv($inpfile, 10000)) !== false) {

                if($flag != 0){
                    if(!(\DB::table('inventories_test')->where('filename',$filename)->where('partno',$data[0])->where('location_code',$data[6])->first())){
                        \DB::table('inventories_test')->insert([
                            'filename' => $filename,
                            'partno' => $data[0]?$data[0]:null,
                            'vendor_partno' => $data[1]?$data[1]:null,
                            'mpn' => $data[2]?$data[2]:null,
                            'description' => $data[3]?$data[3]:null,
                            'brand' => $data[4]?$data[4]:null,
                            'model' => $data[5]?$data[5]:null,
                            'location_code' => $data[6]?$data[6]:null,
                            'available_qty' => $data[7]?$data[7]:null,
                            'price' => $data[8]?$data[8]:null,
                            'drop_shipper' => $data[9]?$data[9]:null,
                            'ds_vendor_code' => $data[10]?$data[10]:null,
                            'location_name' => $data[11]?$data[11]:null,
                        ]);
                        // $inventory->partno = $data[0];
                        // $inventory->vendor_partno = $data[1];
                        // $inventory->mpn = $data[2];
                        // $inventory->description = $data[3];
                        // $inventory->brand = $data[4];
                        // $inventory->model = $data[5];
                        // $inventory->location_code = $data[6];
                        // $inventory->available_qty = $data[7];
                        // $inventory->price = $data[8];
                        // $inventory->drop_shipper = $data[9];
                        // $inventory->ds_vendor_code = $data[10];
                        // $inventory->location_name = $data[11];
                        // $inventory->save();
                    }
                
                }
                    $flag=1;
            }
    }
    fclose($inpfile); // Close individual CSV file 
    return 'success';

}



    public function runPython(Request $request){ 

        // python3 detect_circles.py --image images/car.png
        // dd("python3 ".public_path()."/js/detect-wheel.py --image ".$request->image);
        $process = new Process("python3 ".public_path()."/js/detect-wheel.py ".$request->image." ".public_path()." ".$request->carid);

        $process->run(); 

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return response()->json($process->getOutput());
        // return $process->getOutput();
        // Result (string): {'neg': 0.204, 'neu': 0.531, 'pos': 0.265, 'compound': 0.1779}
    }




    public function convertExcelToCSV()
    { 
        $excelFile = public_path('/storage/Missing-Wheel-Images-Final.xlsx');
        // dd($excelFile);

    $test=Excel::selectSheets('Sheet1')->load($excelFile, function($reader) {
        // $reader->ignoreEmpty();
        $results = $reader->get()->toArray();
        foreach($results as $key => $value){
            $pro = WheelProduct::where('partno',$value['partno'])->first();
            $pro->prodimage =  $value['prodimage'];
            $pro->save(); 
            echo "<br>ID:".$pro->id;
                 
        }
    })->get();
        
        
    }




    public function upodateWheelsPartNo()
    { 
        $excelFile = public_path('/storage/Missing Wheel Viz Images Mappings.xlsx');
       
        // $excelData = \Excel::load($excelFile)->get()->toArray();

        $test=Excel::selectSheets('Sheet1')->load($excelFile, function($reader) {
            // $reader->ignoreEmpty();
            $results = $reader->get()->toArray();
     
            foreach($results as $key => $row){
                $pro = WheelProduct::where('partno',$row['partno'])->first();
                $pro->partno_old =  $row['partno_old'];
                $pro->updated_at =  \Carbon\Carbon::now(); 
                $pro->save(); 
                echo "<br>{$key} - ID:".$pro->id;
                     
            }
        })->get(); 
        
        
    }


    public function findMisMatchedWheels()
    { 
        
            $wheelproducts = WheelProduct::doesnthave('wheel')->get(); 

            foreach ($wheelproducts as $key => $product) {
                $url = getWheelProductImage(@$product->prodimage);
                // dd($url);
                if(getWheelProductImage(@$product->prodimage)){
                    $res = \File::copy($url,base_path('storage/app/public/crop/').$product->prodimage);                    
                }

                // dd($res);
            }

            dd($wheelproducts);
        
    }

    // public function usersGenerator() {
    //     foreach (WheelProduct::cursor() as $user) {
    //         yield $user;
    //     }
    // }
    public function exportTable(Request $request){
        
        if($request->module != ''){

            $appModel = "\\App\\" . $request->module; 
            $data = $appModel::all();
        }


        // $data = $this->usersGenerator();
        return (new FastExcel($data))->download($request->module.'.csv');


        // Excel::create($request->module, function($excel) use($data,$request) {

        //     $excel->sheet($request->module, function($sheet) use($data) {

        //         $sheet->fromArray($data);

        //     });

        // })->export('csv');
    }

    public function cmspage(Request $request,$routename='')
    { 
        return view('cmspage',compact('routename'));
    }
    public function addStarRating(Request $request)
    { 
        // dd($request->all()); 

        $this->validate($request, [  
            'comment'=>'required|min:10',  
        ]);
        try{  
 
                $review = new Review;
                $review->comment = $request->comment;
                $review->category = $request->category?:null;
                $review->partno = $request->partno?:null;
                // $review->product_id = $data->product_id?:null;

                $review->save();

                if($request->has('ratings') && ( $request->category == 'wheel' || $request->category == 'tire' )){ 
                    $ratings  = (array)json_decode($request->ratings);

                    $ratings = array_merge(getRatingList(),$ratings);
                    
                    foreach ($ratings as $key => $value) {
                        $rating = new Rating;
                        $rating->review_id = $review->id;
                        $rating->feature = $key;
                        $rating->rating = is_numeric($value)?$value:0;
                        $rating->save();
                    }
                    $review->avgrating = array_sum($ratings)/count($ratings);
                }

               
                $review->save();

                return back()->with('success','Thanks for Your Review & Ratings!!');

        }catch(Exception $e){
            return back()->withInput(Input::all())->with('error',$e->getMessage());
        }
        return 'success';
    }



    public function VerifyWheelProductImages(Request $request)
    { 
        $products = WheelProduct::with('wheel')->get();
        $arr=[];
        foreach ($products as $key => $product) {
            // dd($product->wheel,$product->wheel != null);
            if($product->wheel != null){
                if(!front_back_filecheck($product->wheel->image)){
                    $arr[$product->prodimage]=$product->wheel->image;
                } 
            }else{
                if(!front_back_filecheck($product->prodimage)){
                    // dd($product->prodimage);
                    $arr[$product->prodimage]=$product->prodimage;
                }
            }
            
        }
        dd($arr);
    }
}




