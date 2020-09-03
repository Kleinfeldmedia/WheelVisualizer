<?php

namespace App\Http\Controllers;

use App\Tire;
use App\ChassisModel;
use App\Vehicle;
use App\WheelProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\ZipcodeController as Zipcode;
use Session;
use DB;

class TireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tires');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request,$chassis_model_id='',$vehicle_id='',$wheelproduct_id='',$is_shipped='')
    {

        $tires = new Tire;

        $tires = $tires->select('prodimage','id','prodtitle','detailtitle','tiresize','loadindex','speedrating',
                    'price','prodmodel','tirewidth','tireprofile','tirediameter','partno');


                      
            if(count($request->all()) == 0 ){
                 $tires = $tires->limit(50);
            }


            
        // dd(base64_decode($chassis_model_id));
        $chassis_model = ChassisModel::find(base64_decode($chassis_model_id)) ?? null;
        // dd($chassis_model);
        $vehicle = Vehicle::where('vehicle_id',base64_decode($vehicle_id))->first() ?? null;

        // dd($chassis_model,$vehicle,$wheelproduct_id);

        if (isset($request->tiresize) && $request->tiresize) {
                $tires = $tires->where('tiresize',base64_decode($request->tiresize));
        }


        if($request->has('tirebrand')){
            if($request->tirebrand !=''){
                $tires = $tires->whereIn('prodbrand',json_decode(base64_decode($request->tirebrand)));
            }
        }
        if($request->has('tirespeedrating')){
            if($request->tirespeedrating !=''){
                $tires = $tires->where('speedrating',json_decode(base64_decode($request->tirespeedrating)));
            }
        }
        if($request->has('tireloadindex')){
            if($request->tireloadindex !=''){
                $tires = $tires->whereIn('loadindex',json_decode(base64_decode($request->tireloadindex)));
            }
        }
        if($request->has('minprice')){
            if($request->minprice !=''){
                $tires = $tires->where('price','>',json_decode(base64_decode($request->minprice)));
            }
        }
        
        if($request->has('maxprice')){
            if($request->maxprice !=''){
                $tires = $tires->where('price','<',json_decode(base64_decode($request->maxprice)));
            }
        }
 
        if( $chassis_model_id!='' && $vehicle_id!='' && $wheelproduct_id==''){
            $higherRating = getHigherSpeedRating($chassis_model->speed_index)['list'];
            $tires = $tires->where('tiresize',$chassis_model->tire_size)
                    ->where('loadindex','>=', $chassis_model->load_index)
                    ->whereIn('speedrating',$higherRating );
        }else{


            if($request->has('width') && $request->has('profile') && $request->has('diameter')){
                Session::put('user.searchByTireSize',$request->all());
            }

            if($request->has('width')){
                $tires = $tires->where('tirewidth',$request->width);
            }

            if($request->has('profile')){
                $tires = $tires->where('tireprofile',$request->profile);
            }

            if($request->has('diameter')){
                $tires = $tires->where('tirediameter',$request->diameter);
            }
        }
        
        $plussizes=[]; 
        if($wheelproduct_id){ 

            $wheel = WheelProduct::find(base64_decode($wheelproduct_id));
            if($wheel->dropshippable == 1){
                $offroadtype=Session::get('user.offroadtype')??null;
                $liftsize=Session::get('user.liftsize')??null;

                $plussizes = $offroadTireSizes = $vehicle->Offroads()->where('plussizetype',$liftsize)->select('tire1')->distinct('tire1')->pluck('tire1'); 

                        $tires = $tires->where(function ($query) use($offroadTireSizes) {
                             
                            foreach ($offroadTireSizes as $key => $offroadSize) {  
                                $query->orwhere('tiresize', 'like',  '%' . $offroadSize .'%');
                             }      
                        });  

 
            }else{
                // dd($wheel->dropshippable,$wheelproduct_id,);

                $rimsize = getWheelDiameterToRim($wheel->wheeldiameter,$wheel->wheelwidth);
                $plussizes = $vehicle->Plussizes->where('wheel_size',$rimsize)->pluck('tire1');
                // dd($wheel);
 
                $tires = $tires->whereIn('tiresize',$plussizes);

                if($tires->count() > 0){
                    Session::put('user.packagetype','wheeltirepackage');
                }else{
                    return back()->with('error','Matching Tires Not Found');
                }
            } 
        }
        if($is_shipped !=''){
            Session::put('user.packagetype','shippedpackage');
        } 

        // Load index search in the Sidebar

        $load_indexs = clone $tires;

        if (isset($request->tirebrand) && $request->tirebrand) {
            $load_indexs = $load_indexs->whereIn('prodbrand', json_decode(base64_decode($request->tirebrand)));
        }

        if (isset($request->speedrating) && $request->speedrating) {
            $load_indexs = $load_indexs->whereIn('speedrating', json_decode(base64_decode($request->speedrating)));
        }

        $load_indexs =  $load_indexs->select('loadindex', \DB::raw('count(DISTINCT prodmodel) as total'))
        ->groupBy('loadindex')
        ->get()
        ->sortBy('loadindex');



        // Speed Ratings search in the Sidebar

        $speedratings = clone $tires;

        if (isset($request->tirebrand) && $request->tirebrand) {
            $speedratings = $speedratings->whereIn('prodbrand', json_decode(base64_decode($request->tirebrand)));
        }

        if (isset($request->loadindex) && $request->loadindex) {
            $speedratings = $speedratings->whereIn('loadindex', json_decode(base64_decode($request->loadindex)));
        }

        $speedratings =  $speedratings->select('speedrating', \DB::raw('count(DISTINCT prodmodel) as total'))
        ->groupBy('speedrating')
        ->get()
        ->sortBy('speedrating');



            // Tire Brands search in the Sidebar

            $countsByBrand = clone $tires;
            
            $brands = clone $tires; 

            if (isset($request->tirebrand) && $request->tirebrand) {
                $countsByBrand = $countsByBrand->whereIn('prodbrand', json_decode(base64_decode($request->tirebrand)));
            }

            if (isset($request->loadindex) && $request->loadindex) {
                $countsByBrand = $countsByBrand->whereIn('loadindex', json_decode(base64_decode($request->loadindex)));
            }

            $brands = $countsByBrand->select('prodbrand')
            ->groupBy('prodbrand')
            ->get()
            ->sortBy('prodbrand');

            $countsByBrand = $countsByBrand->select('prodbrand', \DB::raw('count(DISTINCT prodmodel) as total'))
            ->groupBy('prodbrand')
            ->pluck('total','prodbrand');

            $prices =  Tire::select('price')
            ->groupBy('price')
            ->get()
            ->sortBy('price');



            if (isset($request->search) && $request->search) {

                $searchText = base64_decode($request->search);

                $searchTerms = explode(' ', $searchText);
                $tires = new Tire; 
                // $tires = $tires->where('id','>',0);
                foreach ($searchTerms as $key => $term) {
 
                        $tires = $tires->where('metadesc', 'LIKE', '%' . $term . '%');
   
                }

                if($tires->count() <= 0){ 
                            $tires = new Tire;

                            $tires= $tires
                            ->where('partno', 'LIKE', '%' . $term . '%') //->orderBy('tirewidth','ASC')
                            ->orWhere('tirewidth', 'LIKE', '%' . $term . '%') //->orderBy('tirewidth','ASC')
                            ->orWhere('tireprofile', 'LIKE', '%' . $term . '%') //->orderBy('tireprofile','ASC')
                            ->orWhere('tirediameter', 'LIKE', '%' . $term . '%') //->orderBy('tirediameter','ASC') 
                            ->orWhere('prodbrand', 'LIKE', '%' . $term . '%') //->orderBy('prodbrand','ASC')
                            ->orWhere('prodmodel', 'LIKE', '%' . $term . '%') //->orderBy('prodmodel','ASC')
                            ->orWhere('tiresize', 'LIKE', '%' . $term . '%') //->orderBy('tiresize','ASC')
                            ->orWhere('speedrating', 'LIKE', '%' . $term . '%')
                            ->orWhere('keywords', 'LIKE', '%' . $term . '%') //->orderBy('keywords','ASC') 
                            ;
                }

            }
            // dd($tires->get());


            // dd($wheelpackage);
            // if zipcode is available....
            // dd($vehicle);
            $zipcode =Session::get('user.zipcode');
            if($zipcode != null){ 
                if($is_shipped != ''){
                        $zipcodes = Zipcode::getZipcodesByRadius('92831',50);
                }else{
                        $zipcodes = Zipcode::getZipcodesByRadius($zipcode,150);

                }
                // dd($zipcodes);
                // $zipcodes = array(
                //     0 => "32218",
                //     4 => "32226",
                //     6 => "32208",
                //     7 => "32206",
                //     8 => "32209",
                //     9 => "32204",
                //     10 => "32225",
                //     11 => "32231",
                //     12 => "32216",
                //     13 => "32227",
                //     14 => "32220",
                //     15 => "32210",
                //     16 => "32266",
                //     17 => "32240",
                //     18 => "32257",
                //     19 => "32009",
                //     20 => "32004",
                //     21 => "32006",
                //     22 => "32258",
                //     23 => "31548",
                //     24 => "31562",
                //     25 => "32259",
                //     26 => "32260",
                //     27 => "32234",
                //     29 => "32068",
                //     30 => "31569",
                //     31 => "32067",
                //     32 => "32063",
                //     33 => "32040",
                //     34 => "31537",
                //     35 => "32092",
                //     38 => "32058",
                //     40 => "31565",
                //     41 => "32095",
                //     42 => "32083",
                //     43 => "32085",
                //     44 => "31568",
                //     45 => "32091",
                //     47 => "32007",
                //     48 => "31521",
                //     49 => "31523",
                // ); 

                // $radius_tires = clone $tires;
                // $radius_tires = $radius_tires->whereHas('Inventories')->whereHas('Inventories.Dropshippers')->with([
                //                     'Inventories'=>function ($query){ 
                //                                         $query->where('available_qty','>=',4); 
                //                                         $query->orderBy('available_qty','DESC'); 
                //                     },
                //                     'Inventories.Dropshippers'=>function ($query1) use($zipcodes){ 
                //                                         $query1->whereIn('zip',$zipcodes); 
                //                     }
                //                 ]); 
                // // dd($radius_tires->get());

                // $radius_tires = $radius_tires           
                // ->orderBy('price', 'ASC')
                // ->get()
                // ->unique('prodtitle');


                // $tires = $tires->join('inventories', 'tires.partno', '=', 'inventories.partno')
                //         ->where('inventories.available_qty','>=',1)
                //         ->orderBy('inventories.available_qty', 'DESC')
                //         ->select('tires.*')->with('Inventories'); 

 
                // $tires = $tires->with([
                //                     'Inventories'=>function ($query){ 
                //                                         $query->where('available_qty','>=',4); 
                //                                         $query->orderBy('available_qty','DESC'); 
                //                     },
                //                     'Inventories.Dropshippers'=>function ($query) use($zipcodes){ 
                //                                         $query->whereIn('zip',$zipcodes); 
                //                     }
                //                 ])

                if($is_shipped != ''){
                    $tires =$tires->whereHas('DropshipperInventories');
                }
                
                $tires = $tires->with([
                                    'DropshipperInventories'=>function ($query) use($zipcodes){ 
                                                            $query->where('qty','>=',4); 
                                                            $query->Where(function ($query1) use($zipcodes) { 
                                                                foreach ($zipcodes as $key => $zipcode) {
                                                                    $query1->orwhere('zip', 'like',  '%' . $zipcode.'%');
                                                                }     
                                                            });  
                                                            $query->orderBy('qty','DESC'); 
                                    }
                                ])
   
                ->orderBy('price', 'ASC');
                 

            }else{

                $tires = $tires->with([
                                        'DropshipperInventories'=>function ($query){ 
                                                                $query->where('qty','>=',4);  
                                                                $query->orderBy('qty','DESC'); 
                                        }
                                    ]) ->whereHas('DropshipperInventories')        
                ->orderBy('price', 'ASC');
            }        

            $tires=$tires->get()->unique('prodtitle');

                // dd($tires);
            // if($zipcode != null){

            //     if($is_shipped != ''){
            //         $tires =$radius_tires;
            //     }else{
            //         $tires =collect($radius_tires->merge($tires));

            //     }
            // }
            

        if(count($tires) == 0){

            $load_indexs =  Tire::select('loadindex', \DB::raw('count(DISTINCT prodmodel) as total'))
            ->groupBy('loadindex')
            ->get()
            ->sortBy('loadindex');

            $speedratings =  Tire::select('speedrating', \DB::raw('count(DISTINCT prodmodel) as total'))
            ->groupBy('speedrating')
            ->get()
            ->sortBy('speedrating');
            $countsByBrand = Tire::select('prodbrand', \DB::raw('count(DISTINCT prodmodel) as total'))
                ->groupBy('prodbrand')
                ->pluck('total','prodbrand');
        }


            $tires = MakeCustomPaginator($tires, $request, 8);
 
            if($vehicle){
                Session::put('user.vehicle',$vehicle);
            }else{

                Session::put('user.vehicle',null);
            }


  

        // dd($tires);
        // dd($speedratings,json_decode(base64_decode($request->tirespeedrating)));
        return view('tires_list',compact('tires','vehicle','chassis_model','load_indexs','speedratings','brands','countsByBrand','prices','request','zipcode','wheelproduct_id','plussizes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tireview(Request $request,$tire_id='',$vehicle_id='',$wheelproduct_id='')
    {
        if($vehicle_id!=''){
            $vehicle = Vehicle::with('ChassisModels')->where('id',base64_decode($vehicle_id))->first();
        }else
        {
            $vehicle='';
        }
        // dd($vehicle);
        $tire = Tire::select('id','prodimage','warranty','detailtitle','prodbrand','tiresize','prodmodel',
                'speedrating','loadindex','utqg','partno','originalprice','yousave','set_amount','vehicle_type','price','saletype','qtyavail','dry_performance','wet_performance','mileage_performance','ride_comfort','quiet_ride',
                'winter_performance','fuel_efficiency','braking','responsiveness','sport','off_road','youtube1','youtube2','youtube3','youtube4','proddesc','benefits1','benefits2','benefits3','benefits4','benefitsimage1','benefitsimage2','benefitsimage3','benefitsimage4','badge1','badge2','badge3','detaildesctype','detaildescfeatures')
                ->where('id',base64_decode($tire_id))
                ->with(['Brand'])->first();
        $diff_tires =  Tire::select('id','warranty','tiresize',
                'speedrating','loadindex','utqg','partno','price','prodmodel')
                ->where('tiresize',$tire->tiresize)
                ->with(['Brand'])
                ->get();

        $similar_tires = Tire::select('id','detailtitle','prodimage','id','warranty','tiresize',
                'speedrating','loadindex','utqg','partno','price','prodmodel')
                // ->where('prodbrand',$tire->prodbrand)
                ->where('tiresize',$tire->tiresize)
                ->where('speedrating',$tire->speedrating)
                ->where('loadindex',$tire->loadindex)
                // ->orWhere('tirewidth',$tire->tirewidth)
                // ->orWhere('tirediameter',$tire->tirediameter)
                ->get()
                ->unique('prodmodel');
        return view('tire_view',compact('tire','diff_tires','similar_tires','vehicle','wheelproduct_id'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function brand(Request $request,$brand_name='')
    {
        $tires = new Tire;
        
        if($brand_name != ''){
                $tires = $tires->where('prodbrand',base64_decode($brand_name));
        }

        $tires = $tires->select('prodimage','prodtitle','prodmodel','price','id','prodbrand','vehicle_type')
                ->with(['Brand'])
                ->orderBy('price','ASC');

        $ptires =clone $tires;
        $lttires =clone $tires;
        $tire = $tires->first();
        $ptires = $ptires->where(function ($query) {
                    $query->where('vehicle_type','Passenger');
                    // $query->orWhereNull('vehicle_type');
                    })->get()
                    ->unique('prodmodel');
        $lttires =$lttires->where(function ($query) {
                    $query->where('vehicle_type','!=','Passenger');
                    // $query->orWhereNotNull('vehicle_type');
                    })->get()
                    ->unique('prodmodel');

        // $ptires = MakeCustomPaginator($ptires, $request, 6,'ptpage');
        // $lttires = MakeCustomPaginator($lttires, $request, 6,'ltpage');

        return view('tire_brand',compact('ptires','lttires','tire','brand_name'));
    }

    public function tirebrandmodel(Request $request,$tire_id='')
    {
        $tire = Tire::with(['Brand'])->where('id',base64_decode($tire_id))->first();
        // dd($tire);
        $diff_tires =  Tire::with(['Brand'])->where('prodmodel',$tire->prodmodel)->get();

        // dd($tire,$diff_tires);
        return view('tire_brand_model',compact('tire','diff_tires'));
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
     * @param  \App\Tire  $tire
     * @return \Illuminate\Http\Response
     */
    public function show(Tire $tire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tire  $tire
     * @return \Illuminate\Http\Response
     */
    public function edit(Tire $tire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tire  $tire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tire $tire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tire  $tire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tire $tire)
    {
        //
    }


    /**
     * Search the records by filters.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function getFiltersByTire(Request $request)
    {
        try{
            $tire = new Tire;  

            // Width change or Loading filter
            if(isset($request->width) && $request->changeBy == 'width' || $request->changeBy == '')
                $allData['profile'] = $data = $tire->select('tireprofile')->distinct('tireprofile')->wheretirewidth($request->width)->orderBy('tireprofile','DESC')->get();

            // Profile change  or Loading Filter
            if(isset($request->width) && isset($request->profile) && $request->changeBy == 'profile' || $request->changeBy == '')
                $allData['diameter'] = $data = $tire->select('tirediameter')->distinct('tirediameter')->where('tirewidth',$request->width)->where('tireprofile',$request->profile)->get();

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
    // /**
    //  * Search the records by filters.
    //  *
    //  * @param  \App\Vehicle  $vehicle
    //  * @return \Illuminate\Http\Response
    //  */
    // public function setFiltersByTire(Request $request)
    // {
    //     try{
    //         $tires = Tire::select('prodimage','id','prodtitle','tiresize','loadindex','speedrating',
    //                 'price','prodmodel','tirewidth','tireprofile','tirediameter')
    //                 ->where('tirewidth',$request->width)
    //                 ->where('tireprofile',$request->profile)
    //                 ->where('tirediameter',$request->diameter)
    //                 ->get();  
    //         $load_indexs =Tire::select('loadindex', \DB::raw('count(*) as total'))->groupBy('loadindex')->get()->sortBy('loadindex');
        
    //         $speedratings =Tire::select('speedrating', \DB::raw('count(*) as total'))->groupBy('speedrating')->get()->sortBy('speedrating');

    //         return view('tires_list',compact('tires','load_indexs','speedratings'));

    //     }catch(ModelNotFoundException $notfound){
    //         return response()->json(['error' => $notfound->getMessage()]); 
    //     }catch(Exception $error){
    //         return response()->json(['error' => $error->getMessage()]); 
    //     }
    // }



    public function Tires_data_import(){
         // $in_file = public_path('/storage/tires_data/Falken-Export.csv'); 
         // $in_file = public_path('/storage/tires_data/Conti-Web-02-08.csv'); 
         // $in_file = public_path('/storage/tires_data/Tire-Master-3-3-20.csv'); 
         // $in_file = public_path('/storage/tires_data/Tire-Master-3-11-20.csv'); 
         $in_file = public_path('/storage/tires_data/Tires-March-27.csv'); 


        if( !$fr = @fopen($in_file, "r") ) die("Failed to open file");
        // $fw = fopen($out_file, "w");
        $i=1;
        while( ($data = fgetcsv($fr, 2000000, ",")) !== FALSE ) {
                if($i != 1){
                    // dd($data[55]);
                    if((isset($data[0])&&$data[0]!='')){

                        $tire =Tire::where('partno',$data[22])->first();
                        if($tire==null){
                            $tire=new Tire;

                            $tire->partno = isset($data[22])?$data[22]:null;  
                            $tire->prodtitle = isset($data[0])?$data[0]:null;   
                            $tire->prodbrand = isset($data[1])?$data[1]:null;   
                            $tire->prodmodel = isset($data[2])?$data[2]:null;   
                            $tire->prodmetadesc = isset($data[3])?$data[3]:null;    
                            $tire->prodimage = isset($data[4])?$data[4]:null;   
                            $tire->prodimageshow = isset($data[5])?$data[5]:null;   
                            $tire->prodsortcode = isset($data[6])?$data[6]:null;    
                            $tire->prodheaderid = isset($data[7])?$data[7]:null;    
                            $tire->prodfooterid = isset($data[8])?$data[8]:null;    
                            $tire->prodinfoid = isset($data[9])?$data[9]:null;  
                            $tire->proddesc = isset($data[10])?$data[10]:null;    
                            $tire->tirediameter = isset($data[11])?$data[11]:null;    
                            $tire->tirewidth = isset($data[12])?$data[12]:null;   
                            $tire->tireprofile = isset($data[13])?$data[13]:null; 
                            $tire->tiresize = isset($data[14])?$data[14]:null;    
                            $tire->speedrating = isset($data[15])?$data[15]:null; 
                            $tire->loadindex = isset($data[16])?$data[16]:null;   
                            $tire->ply = isset($data[17])?$data[17]:null; 
                            $tire->utqg = isset($data[18])?$data[18]:null;    
                            $tire->warranty = isset($data[19])?$data[19]:null;    
                            $tire->detailtitle = isset($data[20])?$data[20]:null; 
                            $tire->keywords = isset($data[21])?$data[21]:null;    
                            $tire->price = isset($data[23])?$data[23]:0;   
                            $tire->price2 = isset($data[24])?$data[24]:0;  
                            $tire->cost = isset($data[25])?$data[25]:0;    
                            $tire->rate = isset($data[26])?$data[26]:0;    
                            $tire->saleprice = isset($data[27])?$data[27]:0;   
                            $tire->saletype = isset($data[28])?$data[28]:null;    
                            $tire->salestart = isset($data[29])?$data[29]:null;   
                            $tire->saleexp = isset($data[30])?$data[30]:null; 
                            $tire->weight = isset($data[31])?$data[31]:null;  
                            $tire->length = isset($data[32])?$data[32]:null;  
                            $tire->width = isset($data[33])?$data[33]:null;   
                            $tire->height = isset($data[34])?$data[34]:null;  
                            $tire->shpsep = isset($data[35])?$data[35]:null;  
                            $tire->shpfree = isset($data[36])?$data[36]:null; 
                            $tire->shpcode = isset($data[37])?$data[37]:null; 
                            $tire->shpflatrate = isset($data[38])?$data[38]:null; 
                            $tire->partno_old = isset($data[39])?$data[39]:null;  
                            $tire->metadesc = isset($data[40])?$data[40]:null;    
                            $tire->qtyavail = isset($data[41])?$data[41]:0;    
                            $tire->proddetailid = isset($data[42])?$data[42]:null;    
                            $tire->productid = isset($data[43])?$data[43]:null;   
                            $tire->dropshippable = isset($data[44])?$data[44]:null;   
                            $tire->vendorpartno = isset($data[45])?$data[45]:null;    
                            $tire->dropshipper = isset($data[46])?$data[46]:null; 
                            $tire->vendorpartno2 = isset($data[47])?$data[47]:null;   
                            $tire->dropshipper2 = isset($data[48])?$data[48]:null;    
                            $tire->tiretype = isset($data[49])?$data[49]:null;    
                            $tire->lt = isset($data[50])?$data[50]:null;  
                            $tire->xl = isset($data[51])?$data[51]:null;  
                            $tire->originalprice = isset($data[52])?$data[52]:0;   
                            $tire->yousave = isset($data[53])?$data[53]:0; 
                            $tire->set_amount = isset($data[54])?$data[54]:0;  
                            $tire->vehicle_type = isset($data[55])?$data[55]:null;    
                            $tire->badge1 = isset($data[56])?$data[56]:null;  
                            $tire->badge2 = isset($data[57])?$data[57]:null;  
                            $tire->badge3 = isset($data[58])?$data[58]:null;  
                            $tire->detaildesctype = isset($data[59])?$data[59]:null;  
                            $tire->detaildescfeatures = isset($data[60])?$data[60]:null;  
                            $tire->detaildesc = isset($data[61])?$data[61]:null;  
                            $tire->benefits1 = isset($data[62])?$data[62]:null;   
                            $tire->benefits2 = isset($data[63])?$data[63]:null;   
                            $tire->benefits3 = isset($data[64])?$data[64]:null;   
                            $tire->benefits4 = isset($data[65])?$data[65]:null;   
                            $tire->benefitsimage1 = isset($data[66])?$data[66]:null;  
                            $tire->benefitsimage2 = isset($data[67])?$data[67]:null;  
                            $tire->benefitsimage3 = isset($data[68])?$data[68]:null;  
                            $tire->benefitsimage4 = isset($data[69])?$data[69]:null;  
                            $tire->prodlandingdesc = isset($data[70])?$data[70]:null; 
                            $tire->prodimage1 = isset($data[71])?$data[71]:null;  
                            $tire->prodimage2 = isset($data[72])?$data[72]:null;  
                            $tire->prodimage3 = isset($data[73])?$data[73]:null;  
                            $tire->dry_performance =(isset($data[74]) && $data[74] != '')?$data[74]:0; 
                            $tire->wet_performance = (isset($data[75]) && $data[75] !='')?$data[75]:0; 
                            $tire->mileage_performance = (isset($data[76]) && $data[76] !='')?$data[76]:0; 
                            $tire->ride_comfort = (isset($data[77]) && $data[77] !='')?$data[77]:0;    
                            $tire->quiet_ride = (isset($data[78]) && $data[78] !='')?$data[78]:0;  
                            $tire->winter_performance = (isset($data[79]) && $data[79] !='')?$data[79]:0;  
                            $tire->fuel_efficiency = (isset($data[80]) && $data[80] !='')?$data[80]:0; 
                            $tire->braking = (isset($data[81]) && $data[81] !='')?$data[81]:0; 
                            $tire->responsiveness = (isset($data[82]) && $data[82] !='')?$data[82]:0;  
                            $tire->sport = (isset($data[83]) && $data[83] !='')?$data[83]:0;   
                            $tire->off_road = (isset($data[84]) && $data[84] !='')?$data[84]:0;    
                            $tire->youtube1 = isset($data[85])?$data[85]:null;    
                            $tire->youtube2 = isset($data[86])?$data[86]:null;    
                            $tire->youtube3 = isset($data[87])?$data[87]:null;    
                            $tire->youtube4 = isset($data[88])?$data[88]:null;    
                            // dd($tire);
                            $tire->save(); 

                        }
                    // echo $tire->id."-----------".$tire->partno."<br>";
                    }else{

                        echo "break<br>";
                        break;
                    }
                }
                $i++;
            }
        fclose($fr);
        // fclose($fw);
        return 'success';
    }



    // public function Falken_Import(){
    //      // $in_file = public_path('/storage/tires_data/Falken-Export.csv'); 
    //      $in_file = public_path('/storage/tires_data/01 - Falken-Tire-Data - Falken 950_with_desc.csv'); 

    //     if( !$fr = @fopen($in_file, "r") ) die("Failed to open file");
    //     // $fw = fopen($out_file, "w");
    //     $i=1;
    //     while( ($data = fgetcsv($fr, 2000, ",")) !== FALSE ) {
    //             if($i != 1){
    //                 $tire =Tire::where('partno',$data[0])->first();
    //                 $tire->badge1 = $data[52];
    //                 $tire->badge2 = $data[53];
    //                 $tire->badge3 = $data[54];
    //                 $tire->originalprice = $data[55];
    //                 $tire->detaildesctype = $data[56];
    //                 $tire->detaildescfeatures = $data[57];
    //                 $tire->detaildesc = $data[58];
    //                 $tire->benefits1 = $data[59];
    //                 $tire->benefits2 = $data[60];
    //                 $tire->benefits3 = $data[61];
    //                 $tire->benefits4 = $data[62];
    //                 $tire->benefitsimage1 = $data[63];
    //                 $tire->benefitsimage2 = $data[64];
    //                 $tire->benefitsimage3 = $data[65];
    //                 $tire->benefitsimage4 = $data[66];
    //                 $tire->prodlandingdesc = $data[67];
    //                 $tire->prodimage1 = $data[68];
    //                 $tire->prodimage2 = $data[69];
    //                 $tire->prodimage3 = $data[70];
    //                 $tire->save(); 
    //             }
    //             $i++;
    //         }
    //     fclose($fr);
    //     // fclose($fw);
    //     return 'hiii';
    // }



 function tires_update(){


        $in_file = public_path('/storage/tires_data/Updated-Benefits.csv'); 


        if( !$fr = @fopen($in_file, "r") ) die("Failed to open file");
        // $fw = fopen($out_file, "w");
        $i=1;
        while( ($data = fgetcsv($fr, 2000000, ",")) !== FALSE ) {
                if($i != 1){
                    // dd($data[55]);
                    if((isset($data[0])&&$data[0]!='')){

                        $tires =Tire::where('prodtitle',$data[0])->update([
                            "benefits1"=>$data[1],
                            "benefits2"=>$data[2],
                            "benefits3"=>$data[3],
                            "benefits4"=>$data[4],
                            "benefitsimage1"=>$data[5],
                            "benefitsimage2"=>$data[6],
                            "benefitsimage3"=>$data[7],
                            "benefitsimage4"=>$data[8]

                        ]);
                    }else{

                        echo "break<br>";
                        break;
                    }
                }
                $i++;
            }
        fclose($fr);
        // fclose($fw);
        return 'success';
 }


}
