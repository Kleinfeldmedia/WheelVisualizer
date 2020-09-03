<?php

namespace App\Http\Controllers;

use App\RemoteInventory;
use App\Inventory;
use App\InventoryMigration;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


use Storage;
use View;

class InventoryController extends Controller
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
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }


    public function  getUploadInventories(Request $request){
        // dd('hjhjkg');
        // $db_ext = \DB::connection('sqlsrv');
        // $inv = $db_ext->table('inventories')->count();

        $count = Inventory::count();
        // $last = RemoteInventory::get()->count();
        return ['status'=>true,'data'=>$count];
        // dd($inv);
    }


    static public function  liveCount(){ 
        $inventories = new Inventory;
        $total = $inventories->count(); 
        $dropshippers = $inventories->select('drop_shipper', \DB::raw('count(*) as total'))
                 ->groupBy('drop_shipper')
                 ->pluck('total','drop_shipper'); 

        $updated_inventories = $inventories->whereDate('updated_at', \Carbon\Carbon::today());
        $updated_inventories_today = $inventories->whereDate('updated_at', \Carbon\Carbon::today());
        
        $today_dropshippers = $updated_inventories_today->select('drop_shipper', \DB::raw('count(*) as total'))
                 ->groupBy('drop_shipper')
                 ->pluck('total','drop_shipper'); 
                 // dd($updated_inventories,$today_dropshippers);
        $starttime_dropshippers = $inventories->whereDate('updated_at', \Carbon\Carbon::today())->orderBy('updated_at','DESC')->distinct('drop_shipper')->pluck('updated_at','drop_shipper');
        $lasttime_dropshippers = $inventories->whereDate('updated_at', \Carbon\Carbon::today())->orderBy('updated_at','ASC')->distinct('drop_shipper')->pluck('updated_at','drop_shipper'); 
        // dd($starttime_dropshippers,$lasttime_dropshippers);

        return [
            'total'=>$total??0,
            'dropshippers'=>$dropshippers??[],
            'today_dropshippers'=>$today_dropshippers??[],
            'starttime_dropshippers'=>$starttime_dropshippers??[],
            'lasttime_dropshippers'=>$lasttime_dropshippers??[]
        ];
    }

    public function  liveReport(Request $request){  
        $liveData = $this->liveCount();
        if($request->ajax()){
            $view =View::make('admin.inventory.livedata')->with('liveData', $liveData);
            return $view;
        }
        return view('admin.inventory.livereport',compact('liveData'));
    }

 




    public function  UploadInventories(Request $request){

        set_time_limit(999999999);

        $filepath = public_path('/storage/inventories_data/vftp0018.csv');
        $inpfile = fopen($filepath, "r");
        // Open and Read individual CSV file
        if (($inpfile = fopen($filepath, 'r')) !== false) {
            // Collect CSV each row records
            $flag = 0;

        $skipLines = Inventory::get()->count(); // or however many lines you want to skip
        $lineNum = 1;
        if ($skipLines > 0) {
            while (fgetcsv($inpfile)) {
                if ($lineNum==$skipLines) { break; }
                $lineNum++;
            }
        }
        while (($data = fgetcsv($inpfile, 10000)) !== false) {

            if($flag != 0){
                if(!Inventory::where('partno',$data[0])->where('location_code',$data[6])->first()){
                    $inventory = new Inventory;
                    $inventory->partno = $data[0]??null;
                    $inventory->vendor_partno = $data[1]??null;
                    $inventory->mpn = $data[2]??null;
                    $inventory->description = $data[3]??null;
                    $inventory->brand = $data[4]??null;
                    $inventory->model = $data[5]??null;
                    $inventory->location_code = $data[6]??null;
                    $inventory->available_qty = $data[7]??null;
                    $inventory->price = $data[8]??null;
                    $inventory->drop_shipper = $data[9]??null;
                    $inventory->ds_vendor_code = $data[10]??null;
                    $inventory->location_name = $data[11]??null;
                    $inventory->save();

                }
            
            }
                $flag=1;
        }
    }
    fclose($inpfile); // Close individual CSV file 

    }
 

    public $storeArr=array();

    public function recursiveScan($dir,$storeArr) {
        $tree = glob(rtrim($dir, '/') . '/*');
  

        if (is_array($tree)) {
            foreach($tree as $file) {
                if(is_dir($file)) {
                    $this->recursiveScan($file,$this->storeArr);
                }elseif (is_file($file)) {

                    $folderPath = explode('/', $file);
 
                    $this->storeArr[$folderPath[8]][] = $file;
                    // array_push($this->storeArr[],$file);
                }
            }
        }
        return $this->storeArr;
    }


    public function inventoryFeedUpdate($newData,$db_ext){


        $table = "inventories"; 

        $newData['created_at']=\Carbon\Carbon::now();
        $newData['updated_at']=\Carbon\Carbon::now();

        \Log::info("Log : ".$newData['partno']);

        $columns = array_keys($newData);

        $columnsString = implode("','", $columns);

        $values = array_values($newData);
        $valuesString = implode("','", $values);

        // dd($valuesString,$columnsString);

        $existQuery ="select partno,location_code from {$table} where partno='".$newData['partno']."' and location_code='".$newData['location_code']."'";

        $exists = \DB::select($existQuery);

        if($exists){
            $query = "UPDATE  {$table}  SET 'price' = '".$newData['price']."','available_qty' = '".$newData['available_qty']."','updated_at' = '".$newData['updated_at']."' WHERE partno='".$newData['partno']."' and location_code='".$newData['location_code']."'";
        }else{
            $query = "INSERT INTO {$table} ('{$columnsString}') VALUES ('{$valuesString}')";
        
        }

        \DB::statement($query);
        
        
    }

    public function automationUpdate(Request $request)
    {

        for ($i = 0; $i < 2; $i++) {
             $process = new Process('php ' . base_path('artisan') . " task {$i}");
             $process->setTimeout(0);
             $process->disableOutput();
             $process->start();
             $processes[] = $process;
        }



        ini_set('max_execution_time',39600);
        set_time_limit(39600);

        $fieldsArray = array(

            "vftp0010"=>array(
                "partno" =>"0",
                "vendor_partno" =>"1",
                "mpn" =>null,
                "description" =>"3",
                "brand" =>"2",
                "model" =>null,
                "location_code" =>"6",
                "available_qty" =>"5",
                "price" =>"4", 
            ),

            "vftp0011"=>array(
                "partno" =>"0",
                "vendor_partno" =>null,
                "mpn" =>null,
                "description" =>"1",
                "brand" =>null,
                "model" =>null,
                "location_code" =>null,
                "available_qty" =>array("Jacksonville"=>"3","Columbia"=>"4","Tallahasee"=>"5"),
                "price" =>"2", 
            ),
            "vftp0012"=>array(
                "partno" =>"0",
                "vendor_partno" =>null,
                "mpn" =>"6",
                "description" =>"1",
                "brand" =>"2",
                "model" =>null,
                "location_code" =>null,
                "available_qty" =>"4",
                "price" =>"3", 
            ),
            "vftp0013"=>array(
                "partno" =>"1",
                "vendor_partno" =>null,
                "mpn" =>null,
                "description" =>"2",
                "brand" =>null,
                "model" =>null,
                "location_code" =>null,
                "available_qty" =>"3",
                "price" =>"4",
            ),
            "vftp0014"=>array(
                "partno" =>"0",
                "vendor_partno" =>null,
                "mpn" =>"2",
                "description" =>"1",
                "brand" =>"3",
                "model" =>null,
                "location_code" =>null,
                "available_qty" =>"4",
                "price" =>"5",
            ),
            "vftp0015"=>array(
                "partno" =>"0",
                "vendor_partno" =>null,
                "mpn" =>"2",
                "description" =>"3",
                "brand" =>null,
                "model" =>null,
                "location_code" =>"8",
                "available_qty" =>"7",
                "price" =>null,
            ),
            "vftp0016"=>array(
                "partno" =>"1",
                "vendor_partno" =>null,
                "mpn" =>null,
                "description" =>"2",
                "brand" =>"0",
                "model" =>null,
                "location_code" =>null,
                "available_qty" =>array(
                    "DenverCO"    =>"3",
                    "DallasTX"    =>"4",
                    "HoustonTX"   =>"5",
                    "KansasCityMO"    =>"6",
                    "NewOrleansLA"    =>"7",
                    "PhoenixAZ"   =>"8",
                    "OKCityOK"    =>"9",
                    "ElkGroveCA"  =>"10",
                    "SanAntonioTX"    =>"11",
                    "LosAngelesCA"    =>"12",
                    "SeattleWA"   =>"13",
                    "AtlantaGA"   =>"14",
                    "ChicagoIL"   =>"15",
                    "OrlandoFL"   =>"16",
                    "MiamiFL" =>"17",
                    "ClevelandOH" =>"18",
                    "CincinattiOH"    =>"19",
                    "CharlotteNC" =>"20",
                    "CranburyNJ"  =>"21",
                    "NashvilleTN" =>"22",
                    "SaltLakeUT"  =>"23",
                    "ManchesterCT"    =>"24",
                    "MinneapolisMN"   =>"25",
                    "JacksonvilleFL"  =>"26",
                    "RichmondVA"  =>"27",
                    "CoronaCA"    =>"28",
                    "PortlandOR"  =>"29",
                    "BaltimoreMD" =>"30",
                    "MfgBuenaParkCA"  =>"31",
                    "DistBuenaParkCA" =>"32",
                ),
                "price" =>"34", 
            ),
            "vftp0017"=>array(
                "partno" =>"0",
                "vendor_partno" =>null,
                "mpn" =>null,
                "description" =>null,
                "brand" =>null,
                "model" =>null,
                "location_code" =>null,
                "available_qty" =>array(
                    "CA"=>"1",
                    "FL"=>"2",
                    "GA"=>"3",
                    "IL"=>"4",
                    "PA"=>"5",
                    "TX"=>"6",
                    "UT"=>"7",
                    "WA"=>"8",
                ),
                "price" =>null, 
            ),
            "vftp0018"=>array(
                "partno" =>"0",
                "vendor_partno" =>null,
                "mpn" =>null,
                "description" =>"1",
                "brand" =>"4",
                "model" =>null,
                "location_code" =>null,
                "available_qty" =>array(
                    "ATL" =>"5",
                    "CHAR" =>"6",
                    "CHI" =>"7",
                    "COL" =>"8",
                    "DAL" =>"9",
                    "DEN" =>"10",
                    "HOUS" =>"11",
                    "IND" =>"12",
                    "JACKFL" =>"13",
                    "KSCITY" =>"14",
                    "LA" =>"15",
                    "LA2" =>"16",
                    "NASH" =>"17",
                    "NJ" =>"18",
                    "NORL" =>"19",
                    "PHXAZ" =>"20",
                    "SANT" =>"21",
                    "SEAWA" =>"22",
                ),
                "price" =>"2", 
            ),
            "vftp0022"=>array(
                "partno" =>"4",
                "vendor_partno" =>null,
                "mpn" =>null,
                "description" =>"2",
                "brand" =>"0",
                "model" =>null,
                "location_code" =>null,
                "available_qty" =>"5",
                "price" =>"7", 
            ),

            "vftp0023"=>array(
                "partno" =>"0",
                "vendor_partno" =>null,
                "mpn" =>null,
                "description" =>"3",
                "brand" =>null,
                "model" =>"2",
                "location_code" =>"4",
                "available_qty" =>"5",
                "price" =>null, 
            ),
            "vftp0027"=>array(
                "partno" =>"1",
                "vendor_partno" =>null,
                "mpn" =>null,
                "description" =>"2",
                "brand" =>"0",
                "model" =>null,
                "location_code" =>"5",
                "available_qty" =>"4",
                "price" =>"3", 
            ),
            "vftp0028"=>array(
                "partno" =>"0",
                "vendor_partno" =>null,
                "mpn" =>null,
                "description" =>"5",
                "brand" =>"1",
                "model" =>"3",
                "location_code" =>null,
                "available_qty" =>array(
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
                ),
                "price" =>null,  
            ),
            "vftp0029"=>array(
                "partno" =>"0",
                "vendor_partno" =>null,
                "mpn" =>null,
                "description" =>"1",
                "brand" =>null,
                "model" =>null,
                "location_code" =>null,
                "available_qty" =>"3",
                "price" =>"2", 
            ),
            "vftp0030"=>array(
                "partno" =>"0",
                "vendor_partno" =>null,
                "mpn" =>"4",
                "description" =>"1",
                "brand" =>"2",
                "model" =>null,
                "location_code" =>"5",
                "available_qty" =>"6",
                "price" =>null, 
            ),

            "vftp0031"=>array(
                "partno" =>"0",
                "vendor_partno" =>"2",
                "mpn" =>"1",
                "description" =>null,
                "brand" =>null,
                "model" =>null,
                "location_code" =>null,
                "available_qty" =>array(
                    "RALEIGHNC" => "3",
                    "BALTIMOREMD" => "4",
                    "PHILADELPHIANJ" => "5",
                    "TAMPAFL" => "6",
                    "JACKSONVILLEFL" => "7",
                    "DALLASTX" => "8",
                    "FTLAUDERDALEFL" => "9",
                    "OKCOK" => "10",
                    "CHARLOTTENC" => "11",
                    "ATLANTAGA" => "12",
                    "ORLANDOFL" => "13",
                    "KANSASCITYMO" => "14",
                    "LOUISVILLEKY" => "15",
                    "HOUSTONTX" => "16",
                    "SANANTONIOTX" => "17",
                    "HARTFORDCT" => "18",
                    "CLEVELANDOH" => "19",
                    "NASHVILLETN" => "20",
                    "NORTHJERSEYNJ" => "21",
                    "SALTLAKECITYUT" => "22",
                    "DENVERCO" => "23",
                    "PORTLANDOR" => "24",
                    "DETROITMI" => "25",
                    "RICHMONDVA" => "26",
                    "COLUMBUSOH" => "27",
                    "JACKSONMS" => "28",
                    "OMAHANE" => "29",
                    "CHICAGOIL" => "30",
                    "PITTSBURGHPA" => "31",
                    "PHOENIXAZ" => "32",
                    "OAKLANDCA" => "33",
                    "SIMIVALLEYCA" => "34",
                    "FONTANACA" => "35",
                    "MANASSASVA" => "36",
                    "ROCHESTERNY" => "37",
                    "LONGISLANDNY" => "38",
                    "ALBUQUERQUENM" => "39",
                    "CHATANOOGAGA" => "40",
                    "MEMPHISTN" => "41",
                    "CINCINNATIOH" => "42",
                    "INDIANAPOLISIN" => "43",
                    "ALBANYNY" => "44",
                    "BOSTONMA" => "45",
                    "PHILADELPHIANJ" => "46",
                    "ALLENTOWNPA" => "47",
                    "BUFFALONY" => "48",
                    "SYRACUSENY" => "49",
                    "GREENSBORONC" => "50",
                    "ATLANTAGA" => "51",
                    "BIRMINGHAMAL" => "52",
                    "MIAMIFL" => "53",
                    "NEWORLEANSLA" => "54",
                    "DALLASTX" => "55",
                    "HOUSTONTX" => "56",
                    "MOBILEAL" => "57",
                    "LASVEGASNV" => "58",
                    "FRESNOCA" => "59",
                    "SANTAANACA" => "60",
                    "LOSANGELESCA" => "61",
                    "SANJOSECA" => "62",
                    "SACRAMENTOCA" => "63",
                    "HAWAIIHI" => "64",
                    "SEATTLEWA" => "65",
                    "BENICIACA" => "66",
                    "SANDIEGOCA" => "67",
                    "BATONROUGELA" => "68",
                    "AUSTINTX" => "69",
                    "KNOXVILLETN" => "70",
                    "FTMYERSFL" => "71",
                ),
                "price" =>null,  
            ),
            "vftp0032"=>array(
                "partno" =>"12",
                "vendor_partno" =>null,
                "mpn" =>"13",
                "description" =>"10",
                "brand" =>"11",
                "model" =>"10",
                "location_code" =>"1",
                "available_qty" =>"4",
                "price" =>"9",  
            ),

            "vftp0033"=>array(
                "partno" =>"0",
                "vendor_partno" =>"1",
                "mpn" =>"2",
                "description" =>"3",
                "brand" =>"4",
                "model" =>"5",
                "location_code" =>"6",
                "available_qty" =>"7",
                "price" =>"8",  
            ),
        );

        $vendor_info = array(
                "vftp0010"=>array(
                    '8'  =>array ( "Omni","OS8","OS-Inv_AmarilloTX"),
                    '10' =>array ( "Omni","OS10","OS-Inv_BillingsMT"),
                    '11' =>array ( "Omni","OS11","OS-Inv_DallasTX"),
                    '15' =>array ( "Omni","OS15","OS-Inv_DallasTX"),
                    '19' =>array ( "Omni","OS19","OS-Inv_DallasTX"),
                    '20' =>array ( "Omni","OS20","OS-Inv_DallasTX"),
                    '22' =>array ( "Omni","OS22","OS-Inv_DallasTX"),
                    '61' =>array ( "Omni","OS61","OS-Inv_DallasTX"),
                    '62' =>array ( "Omni","OS62","OS-Inv_SaltLakeCityUT"),
                    '71' =>array ( "Omni","OS71","OS-Inv_CommerceCA"),
                    '72' =>array ( "Omni","OS71","OS-Inv_CommerceCA"),
                ),
                "vftp0011"=>array(
                    'Jacksonville' => array("Barons","BTJACK","BT-Inv_JacksonvilleFL"),
                    'Columbia' => array("Barons","BTCOLU","BT-Inv_ColumbiaSC"),
                    'Tallahasee' => array("Barons","BTTALLA","BT-Inv_TallahaseeFL"),
                ),
                "vftp0012"=>array(
                    'LongIsland' => array("Future","FTOLDB","FT-Inv_OldBethpageNY"),
                    'Philadelphia' => array("Future","FTPHIL","FT-Inv_PhiladelphiaPA"),
                    'Schenectady' => array("Future","FTSCHEN","FT-Inv_SchenectadyNY"),
                ),
                "vftp0013"=>array("Economy","ETDALL","ET-Inv_DallasTX"),
                "vftp0014"=>array("TWI","TWI1","TWI-Inv_TroyMI"),
                "vftp0015"=>array(
                    '1' =>   array("Reliable","RTNJ","RT-Inv_BlackwoodNJ"),
                    '3' =>   array("Reliable","RTGAM","RT-Inv_MaconGA"),
                    '5' =>   array("Reliable","RTNY","RT-Inv_SyracuseNY"),
                    '7' =>   array("Reliable","RTGAD","RT-Inv_DoravilleGA"),
                    '9' =>   array("Reliable","RTCT","RT-Inv_HartfordCT"),
                    '41' =>  array("Reliable","RTMD","RT-Inv_JessupMD"),
                ),
                "vftp0016"=>array(
                    "DenverCO"    => array("WheelPros","WP1001","WP-Inv_DenverCO"),
                    "DallasTX"    => array("WheelPros","WP1002","WP-Inv_DallasTX"),
                    "HoustonTX"   => array("WheelPros","WP1003","WP-Inv_HoustonTX"),
                    "KansasCityMO"    => array("WheelPros","WP1004","WP-Inv_KansasCityMO"),
                    "NewOrleansLA"    => array("WheelPros","WP1005","WP-Inv_NewOrleansLA"),
                    "PhoenixAZ"   => array("WheelPros","WP1006","WP-Inv_PhoenixAZ"),
                    "OKCityOK"    => array("WheelPros","WP1007","WP-Inv_OKCityOK"),
                    "ElkGroveCA"  => array("WheelPros","WP1008","WP-Inv_ElkGroveCA"),
                    "SanAntonioTX"    => array("WheelPros","WP1009","WP-Inv_SanAntonioTX"),
                    "LosAngelesCA"    => array("WheelPros","WP1011","WP-Inv_LosAngelesCA"),
                    "SeattleWA"   => array("WheelPros","WP1013","WP-Inv_SeattleWA"),
                    "AtlantaGA"   => array("WheelPros","WP1014","WP-Inv_AtlantaGA"),
                    "ChicagoIL"   => array("WheelPros","WP1015","WP-Inv_ChicagoIL"),
                    "OrlandoFL"   => array("WheelPros","WP1016","WP-Inv_OrlandoFL"),
                    "MiamiFL" => array("WheelPros","WP1018","WP-Inv_MiamiFL"),
                    "ClevelandOH" => array("WheelPros","WP1019","WP-Inv_ClevelandOH"),
                    "CincinattiOH"    => array("WheelPros","WP1020","WP-Inv_CincinattiOH"),
                    "CharlotteNC" => array("WheelPros","WP1021","WP-Inv_CharlotteNC"),
                    "CranburyNJ"  => array("WheelPros","WP1022","WP-Inv_CranburyNJ"),
                    "NashvilleTN" => array("WheelPros","WP1024","WP-Inv_NashvilleTN"),
                    "SaltLakeUT"  => array("WheelPros","WP1025","WP-Inv_SaltLakeUT"),
                    "ManchesterCT"    => array("WheelPros","WP1026","WP-Inv_ManchesterCT"),
                    "MinneapolisMN"   => array("WheelPros","WP1028","WP-Inv_MinneapolisMN"),
                    "JacksonvilleFL"  => array("WheelPros","WP1029","WP-Inv_JacksonvilleFL"),
                    "RichmondVA"  => array("WheelPros","WP1030","WP-Inv_RichmondVA"),
                    "CoronaCA"    => array("WheelPros","WP1031","WP-Inv_CoronaCA"),
                    "PortlandOR"  => array("WheelPros","WP1032","WP-Inv_PortlandOR"),
                    "BaltimoreMD" => array("WheelPros","WP1034","WP-Inv_BaltimoreMD"),
                    "MfgBuenaParkCA"  => array("WheelPros","WP1053","WP-Inv_MfgBuenaParkCA"),
                    "DistBuenaParkCA" => array("WheelPros","WP1054","WP-Inv_DistBuenaParkCA"),
                ),
                "vftp0017"=>array(
                    "CA"=>array("TSW","TSWCA","TSW-Inv_BreaCA"),
                    "FL"=>array("TSW","TSWFL","TSW-Inv_MiamiFL"),
                    "GA"=>array("TSW","TSWGA","TSW-Inv_AtlantaGA"),
                    "IL"=>array("TSW","TSWIL","TSW-Inv_ChicagoIL"),
                    "PA"=>array("TSW","TSWPA","TSW-Inv_PhiladelphiaPA"),
                    "TX"=>array("TSW","TSWTX","TWS-Inv_DallasTX"),
                    "UT"=>array("TSW","TSWUT","TSW-Inv_SaltLakeUT"),
                    "WA"=>array("TSW","TSWWA","TSW-Inv_SeattleWA"),
                ),
                "vftp0018"=>array(
                    "ATL" =>    array("TheWheelGroup","WG312","WG-Inv_AtlantaGA"),
                    "CHAR" =>   array("TheWheelGroup","WG307","WG-Inv_CharlotteNC"),
                    "CHI" =>    array("TheWheelGroup","WG317","WG-Inv_ChicagoIL"),
                    "COL" =>    array("TheWheelGroup","WG204","WG-Inv_ColumbusOH"),
                    "DAL" =>    array("TheWheelGroup","WG211","WG-Inv_DallasTX"),
                    "DEN" =>    array("TheWheelGroup","WG126","WG-Inv_DenverCO"),
                    "HOUS" =>   array("TheWheelGroup","WG210","WG-Inv_HoustonTX"),
                    "IND" =>    array("TheWheelGroup","WG324","WG-Inv_IndianapolisIN"),
                    "JACKFL" => array("TheWheelGroup","WG206","WG-Inv_JacksonvilleFL"),
                    "KSCITY" => array("TheWheelGroup","WG221","WG-Inv_KansasCityMO"),
                    "LA" => array("TheWheelGroup","WG328","WG-Inv_OntarioCA"),
                    "LA2" =>    array("TheWheelGroup","WG329","WG-Inv_Ontario2CA"),
                    "NASH" =>   array("TheWheelGroup","WG302","WG-Inv_NashvilleTN"),
                    "NJ" => array("TheWheelGroup","WG305","WG-Inv_NewBrunswickNJ"),
                    "NORL" =>   array("TheWheelGroup","WG325","WG-Inv_NewOrleansLA"),
                    "PHXAZ" =>  array("TheWheelGroup","WG113","WG-Inv_PhoenixAZ"),
                    "SANT" =>   array("TheWheelGroup","WG218","WG-Inv_SanAntonioTX"),
                    "SEAWA" =>  array("TheWheelGroup","WG114","WG-Inv_SeattleWA"),
                ),
                "vftp0018"=>array(
                    "ATL" =>    array("TheWheelGroup","WG312","WG-Inv_AtlantaGA"),
                    "CHAR" =>   array("TheWheelGroup","WG307","WG-Inv_CharlotteNC"),
                    "CHI" =>    array("TheWheelGroup","WG317","WG-Inv_ChicagoIL"),
                    "COL" =>    array("TheWheelGroup","WG204","WG-Inv_ColumbusOH"),
                    "DAL" =>    array("TheWheelGroup","WG211","WG-Inv_DallasTX"),
                    "DEN" =>    array("TheWheelGroup","WG126","WG-Inv_DenverCO"),
                    "HOUS" =>   array("TheWheelGroup","WG210","WG-Inv_HoustonTX"),
                    "IND" =>    array("TheWheelGroup","WG324","WG-Inv_IndianapolisIN"),
                    "JACKFL" => array("TheWheelGroup","WG206","WG-Inv_JacksonvilleFL"),
                    "KSCITY" => array("TheWheelGroup","WG221","WG-Inv_KansasCityMO"),
                    "LA" => array("TheWheelGroup","WG328","WG-Inv_OntarioCA"),
                    "LA2" =>    array("TheWheelGroup","WG329","WG-Inv_Ontario2CA"),
                    "NASH" =>   array("TheWheelGroup","WG302","WG-Inv_NashvilleTN"),
                    "NJ" => array("TheWheelGroup","WG305","WG-Inv_NewBrunswickNJ"),
                    "NORL" =>   array("TheWheelGroup","WG325","WG-Inv_NewOrleansLA"),
                    "PHXAZ" =>  array("TheWheelGroup","WG113","WG-Inv_PhoenixAZ"),
                    "SANT" =>   array("TheWheelGroup","WG218","WG-Inv_SanAntonioTX"),
                    "SEAWA" =>  array("TheWheelGroup","WG114","WG-Inv_SeattleWA"),
                ),
                "vftp0022"=>array("KMTires","KMHICK","KM-Inv_HickoryNC"),
                "vftp0023"=>array( 
                    "ATL" =>array("MHT","MHTATL","MHT-Inv_NORCROSSGA"),
                    "BAL39" =>array("MHT","MHTBAL39","MHT-Inv_BALTIMOREMD"),
                    "CHI" =>array("MHT","MHTCHI","MHT-Inv_ELKGROVEVILLAGEIL"),
                    "COL" =>array("MHT","MHTCOL","MHT-Inv_HILLIARDOH"),
                    "DAL" =>array("MHT","MHTDAL","MHT-Inv_SOUTHLAKETX"),
                    "DEN" =>array("MHT","MHTDEN","MHT-Inv_ENGLEWOODCO"),
                    "DET40" =>array("MHT","MHTDET40","MHT-Inv_STJOHNSMI"),
                    "FTL" =>array("MHT","MHTFTL","MHT-Inv_POMPANOBEACHFL"),
                    "GRN" =>array("MHT","MHTGRN","MHT-Inv_GREENSBORONC"),
                    "HOU" =>array("MHT","MHTHOU","MHT-Inv_HOUSTONTX"),
                    "KSC" =>array("MHT","MHTKSC","MHT-Inv_KANSASCITYMO"),
                    "LA" =>array("MHT","MHTLA","MHT-Inv_RANCHODOMINGUEZ"),
                    "LA2" =>array("MHT","MHTLA2","MHT-Inv_RANCHODOMINGUEZ2"),
                    "MSP38" =>array("MHT","MHTMSP38","MHT-Inv_MapleGroveMN"),
                    "NAS" =>array("MHT","MHTNAS","MHT-Inv_NASHVILLETN"),
                    "NJ" =>array("MHT","MHTNJ","MHT-Inv_NEWYORKNY"),
                    "NOCAL" =>array("MHT","MHTNOCAL","MHT-Inv_HAYWARDCA"),
                    "NOR" =>array("MHT","MHTNOR","MHT-Inv_KennerLA"),
                    "OK" =>array("MHT","MHTOK","MHT-Inv_OKLAHOMACITYOK"),
                    "ORL41" =>array("MHT","MHTORL41","MHT-Inv_ORLANDOFL"),
                    "PHX" =>array("MHT","MHTPHX","MHT-Inv_PHOENIXAZ"),
                    "POR37" =>array("MHT","MHTPOR37","MHT-Inv_PORTLANDOR"),
                    "SAN" =>array("MHT","MHTSAN","MHT-Inv_SANANTONIOTX"),
                    "SEA" =>array("MHT","MHTSEA","MHT-Inv_FIFEWA"),
                    "SLC" =>array("MHT","MHTSLC","MHT-Inv_SALTLAKECITYUT"),
                    "TMP" =>array("MHT","MHTTMP","MHT-Inv_TAMPAFL"),
                ),
                "vftp0027"=>array("KWTire","KWT1","KWT-Inv_LancasterPA"),
                "vftp0028"=>array( 
                    "F92"=>array("TreadMaxx","TMF92","TM-Inv_TampaFL"),
                    "g90"=>array("TreadMaxx","TMG90","TM-Inv_EllenwoodGA"),
                    "G91"=>array("TreadMaxx","TMG91","TM-Inv_MaconGA"),
                    "G92"=>array("TreadMaxx","TMG92","TM-Inv_AugustaSC"),
                    "O91"=>array("TreadMaxx","TMO91","TM-Inv_SharonvilleOH"),
                    "W90"=>array("TreadMaxx","TMW90","TM-Inv_LockbourneOH "),
                    "W91"=>array("TreadMaxx","TMW91","TM-Inv_AlabasterAL"),
                    "W92"=>array("TreadMaxx","TMW92","TM-Inv_SolonOH"),
                    "W93"=>array("TreadMaxx","TMW93","TM-Inv_CharlotteNC"),
                    "W94"=>array("TreadMaxx","TMW94","TM-Inv_MidwayFL"),
                    "W95"=>array("TreadMaxx","TMW95","TM-Inv_HoustonTX "),
                    "W96"=>array("TreadMaxx","TMW96","TM-Inv_DesotoTX"),
                    "W97"=>array("TreadMaxx","TMW97","TM-Inv_JacksonvilleFL"),
                    "W98"=>array("TreadMaxx","TMW98","TM-Inv_OrlandoFL"),
                ),                
                "vftp0029"=>array( 
                    "Birmingham" => array("SSTire","SST8","SST-Inv_BirminghamAL"),
                    "Columbia" => array("SSTire","SST9","SST-Inv_ColumbiaSC"),
                    "Fairfield" => array("SSTire","SST13","ST-Inv_CincinnatiOH"),
                    "Galax" => array("SSTire","SST4","SST-Inv_GalaxVA"),
                    "Huntington" => array("SSTire","SST2","SST-Inv_HuntingtonWV"),
                    "Lexington" => array("SSTire","SST1","SST-Inv_LexingtonKY"),
                    "Louisville" => array("SSTire","SST10","ST-Inv_LouisvilleKY"),
                    "Memphis" => array("SSTire","SST5","SST-Inv_MemphisTN"),
                    "Nashville" => array("SSTire","SST3","SST-Inv_NashvilleTN"),
                    "Shreveport" => array("SSTire","SST12","ST-Inv_ShreveportLA"),
                    "Springdale" => array("SSTire","SST11","ST-Inv_SpringdaleAR"),
                    "Tulsa" => array("SSTire","N/A","N/A"),
                ),

                "vftp0030"=>array( 
                    "8"   => array("ATD","ATD8","ATD-Inv_NashvilleTN"),
                    "12"  => array("ATD","ATD12","ATD-Inv_AshevilleNC"),
                    "13"  => array("ATD","ATD13","ATD-Inv_KnoxvilleTN"),
                    "15"  => array("ATD","ATD15","ATD-Inv_FayettevilleNC"),
                    "16"  => array("ATD","ATD16","ATD-Inv_RaleighNC"),
                    "17"  => array("ATD","ATD17","ATD-Inv_RichmondVA"),
                    "18"  => array("ATD","ATD18","ATD-Inv_AugustaGA"),
                    "40"  => array("ATD","ATD40","ATD-Inv_ColumbiaSC"),
                    "047"  => array("ATD","ATD47","ATD-Inv_ChattanoogaTN"),
                    "51"  => array("ATD","ATD51","ATD-Inv_TuckerGA"),
                    "52"  => array("ATD","ATD52","ATD-Inv_AtlantaSouthGA"),
                    "53"  => array("ATD","ATD53","ATD-Inv_PensacolaFL"),
                    "54"  => array("ATD","ATD54","ATD-Inv_JacksonMS"),
                    "55"  => array("ATD","ATD55","ATD-Inv_TexarkanaAR"),
                    "56"  => array("ATD","ATD56","ATD-Inv_MemphisTN"),
                    "58"  => array("ATD","ATD58","ATD-Inv_TallahasseeFL"),
                    "59"  => array("ATD","ATD59","ATD-Inv_NLittleRockAR"),
                    "60"  => array("ATD","ATD60","ATD-Inv_MauldinSC"),
                    "62"  => array("ATD","ATD62","ATD-Inv_LouisvilleKY"),
                    "70"  => array("ATD","ATD70","ATD-Inv_CharlotteNC"),
                    "75"  => array("ATD","ATD75","ATD-Inv_RoanokeVA"),
                    "80"  => array("ATD","ATD80","ATD-Inv_BurlingtonNC"),
                    "85"  => array("ATD","ATD85","ATD-Inv_RuralHallNC"),
                    "90"  => array("ATD","ATD90","ATD-Inv_NorfolkVA"),
                    "95"  => array("ATD","ATD95","ATD-Inv_OrlandoFL"),
                    "101"  => array("ATD","ATD101","ATD-Inv_WilsonNC"),
                    "105"  => array("ATD","ATD105","ATD-Inv_WilmingtonNC"),
                    "107"  => array("ATD","ATD107","ATD-Inv_ManassasVA"),
                    "110"  => array("ATD","ATD110","ATD-Inv_SalisburyMD"),
                    "111"  => array("ATD","ATD111","ATD-Inv_MiamiFL"),
                    "112"  => array("ATD","ATD112","ATD-Inv_WestPalmBeachFL"),
                    "113"  => array("ATD","ATD113","ATD-Inv_JacksonvilleFL"),
                    "114"  => array("ATD","ATD114","ATD-Inv_FtMyersFL"),
                    "115"  => array("ATD","ATD115","ATD-Inv_HarrisonburgVA"),
                    "117"  => array("ATD","ATD117","ATD-Inv_TampaFL"),
                    "121"  => array("ATD","ATD121","ATD-Inv_KennesawGA"),
                    "123"  => array("ATD","ATD123","ATD-Inv_SavannahGA"),
                    "124"  => array("ATD","ATD124","ATD-Inv_ByronGA"),
                    "130"  => array("ATD","ATD130","ATD-Inv_CharlestonSC"),
                    "132"  => array("ATD","ATD132","ATD-Inv_JohnsonCityTN"),
                    "140"  => array("ATD","ATD140","ATD-Inv_HuntsvilleAL"),
                    "141"  => array("ATD","ATD141","ATD-Inv_MontgomeryAL"),
                    "170"  => array("ATD","ATD170","ATD-Inv_CincinnatiOH"),
                    "180"  => array("ATD","ATD180","ATD-Inv_IndianapolisIN"),
                    "204"  => array("ATD","ATD204","ATD-Inv_NorthBaltimoreMD"),
                    "212"  => array("ATD","ATD212","ATD-Inv_PittsburghPA"),
                    "215"  => array("ATD","ATD215","ATD-Inv_RochesterNY"),
                    "219"  => array("ATD","ATD219","ATD-Inv_PocaWV"),
                    "225"  => array("ATD","ATD225","ATD-Inv_CantonNCTOH"),
                    "240"  => array("ATD","ATD240","ATD-Inv_ColumbusOH"),
                    "250"  => array("ATD","ATD250","ATD-Inv_PhiladelphiaNJ"),
                    "252"  => array("ATD","ATD252","ATD-Inv_MalvernPA"),
                    "260"  => array("ATD","ATD260","ATD-Inv_TotowaNJ"),
                    "270"  => array("ATD","ATD270","ATD-Inv_LongIslandNY"),
                    "275"  => array("ATD","ATD275","ATD-Inv_AlbanyNY"),
                    "280"  => array("ATD","ATD280","ATD-Inv_TauntonMA"),
                    "285"  => array("ATD","ATD285","ATD-Inv_ManchesterNH"),
                    "288"  => array("ATD","ATD288","ATD-Inv_MaineME"),
                    "290"  => array("ATD","ATD290","ATD-Inv_HartfordCT"),
                    "300"  => array("ATD","ATD300","ATD-Inv_SanJoseCA"),
                    "302"  => array("ATD","ATD302","ATD-Inv_SacramentoCA"),
                    "303"  => array("ATD","ATD303","ATD-Inv_FresnoCA"),
                    "304"  => array("ATD","ATD304","ATD-Inv_MoorparkCA"),
                    "306"  => array("ATD","ATD306","ATD-Inv_SantaFeSpringsCA"),
                    "307"  => array("ATD","ATD307","ATD-Inv_RanchoCucCA"),
                    "308"  => array("ATD","ATD308","ATD-Inv_PhoenixAZ"),
                    "309"  => array("ATD","ATD309","ATD-Inv_ChulaVistaCA"),
                    "310"  => array("ATD","ATD310","ATD-Inv_RenoNV"),
                    "312"  => array("ATD","ATD312","ATD-Inv_NorthBayCA"),
                    "314"  => array("ATD","ATD314","ATD-Inv_BakersfieldCA"),
                    "315"  => array("ATD","ATD315","ATD-Inv_TucsonAZ"),
                    "318"  => array("ATD","ATD318","ATD-Inv_ComptonCA"),
                    "320"  => array("ATD","ATD320","ATD-Inv_LasVegasNV"),
                    "345"  => array("ATD","ATD345","ATD-Inv_MedfordOR"),
                    "501"  => array("ATD","ATD501","ATD-Inv_LincolnNE"),
                    "502"  => array("ATD","ATD502","ATD-Inv_SiouxFallsSD"),
                    "507"  => array("ATD","ATD507","ATD-Inv_DesMoinesIA"),
                    "510"  => array("ATD","ATD510","ATD-Inv_MinneapolisMN"),
                    "515"  => array("ATD","ATD515","ATD-Inv_MilwaukeeWI"),
                    "522"  => array("ATD","ATD522","ATD-Inv_FargoND"),
                    "530"  => array("ATD","ATD530","ATD-Inv_DenverCO"),
                    "535"  => array("ATD","ATD535","ATD-Inv_GrandJunctionCO"),
                    "538"  => array("ATD","ATD538","ATD-Inv_ColoradoSpringsCO"),
                    "540"  => array("ATD","ATD540","ATD-Inv_DetroitMI"),
                    "548"  => array("ATD","ATD548","ATD-Inv_PeoriaIL"),
                    "550"  => array("ATD","ATD550","ATD-Inv_ChicagoIL"),
                    "563"  => array("ATD","ATD563","ATD-Inv_SpringfieldMO"),
                    "570"  => array("ATD","ATD570","ATD-Inv_KansasCityMO"),
                    "585"  => array("ATD","ATD585","ATD-Inv_WichitaKS"),
                    "601"  => array("ATD","ATD601","ATD-Inv_LubbockTX"),
                    "602"  => array("ATD","ATD602","ATD-Inv_McAllenTX"),
                    "603"  => array("ATD","ATD603","ATD-Inv_AmarilloTX"),
                    "604"  => array("ATD","ATD604","ATD-Inv_SanAngeloTX"),
                    "605"  => array("ATD","ATD605","ATD-Inv_DallasTX"),
                    "610"  => array("ATD","ATD610","ATD-Inv_SanAntonioTX"),
                    "615"  => array("ATD","ATD615","ATD-Inv_ElPasoTX"),
                    "618"  => array("ATD","ATD618","ATD-Inv_FtWorthTX"),
                    "635"  => array("ATD","ATD635","ATD-Inv_StLouisMO"),
                    "640"  => array("ATD","ATD640","ATD-Inv_AlbuquerqueNM"),
                    "645"  => array("ATD","ATD645","ATD-Inv_BirminghamAL"),
                    "650"  => array("ATD","ATD650","ATD-Inv_OklahomaCityOK"),
                    "655"  => array("ATD","ATD655","ATD-Inv_TulsaOK"),
                    "658"  => array("ATD","ATD658","ATD-Inv_BeaumontTX"),
                    "660"  => array("ATD","ATD660","ATD-Inv_HoustonTX"),
                    "665"  => array("ATD","ATD665","ATD-Inv_HoustonSouthTX"),
                    "670"  => array("ATD","ATD670","ATD-Inv_CorpusChristiTX"),
                    "675"  => array("ATD","ATD675","ATD-Inv_AustinTX"),
                    "680"  => array("ATD","ATD680","ATD-Inv_BatonRougeLA"),
                    "682"  => array("ATD","ATD682","ATD-Inv_SlidellLA"),
                    "710"  => array("ATD","ATD710","ATD-Inv_ATDWheelsEastNC"),
                    "711"  => array("ATD","ATD711","ATD-Inv_ATDWheelsWestCA"),
                    "810"  => array("ATD","ATD810","ATD-Inv_SaltLakeCityUT"),
                    "820"  => array("ATD","ATD820","ATD-Inv_CasperWY"),
                    "830"  => array("ATD","ATD830","ATD-Inv_BoiseID"),
                    "840"  => array("ATD","ATD840","ATD-Inv_SeattleWA"),
                    "845"  => array("ATD","ATD845","ATD-Inv_SpokaneWA"),
                    "850"  => array("ATD","ATD850","ATD-Inv_PortlandOR"),
                    "931"  => array("ATD","N/A","N/A"),
                    "971"  => array("ATD","N/A","N/A"),
                    "974"  => array("ATD","ATD974","ATD-Inv_AllianceTX"),
                    "976"  => array("ATD","N/A","N/A"),
                ),

                "vftp0031"=>array(
                    "ALBANYNY" => array("TireHub","142ALBANYNY","TIREHUB-Inv_142ALBANYNY"),
                    "ALBUQUERQUENM" => array("TireHub","136ALBUQUERQUENM","TIREHUB-Inv_136ALBUQUERQUENM"),
                    "ALLENTOWNPA" => array("TireHub","145ALLENTOWNPA","TIREHUB-Inv_145ALLENTOWNPA"),
                    "ATLANTAGA" => array("TireHub","106ATLANTAGA","TIREHUB-Inv_106ATLANTAGA"),
                    "AUSTINTX" => array("TireHub","202AUSTINTX","TIREHUB-Inv_202AUSTINTX"),
                    "BALTIMOREMD" => array("TireHub","101BALTIMOREMD","TIREHUB-Inv_101BALTIMOREMD"),
                    "BATONROUGELA" => array("TireHub","201BATONROUGELA","TIREHUB-Inv_201BATONROUGELA"),
                    "BENICIACA" => array("TireHub","168BENICIACA","TIREHUB-Inv_168BENICIACA"),
                    "BIRMINGHAMAL" => array("TireHub","151BIRMINGHAMAL","TIREHUB-Inv_151BIRMINGHAMAL"),
                    "BOSTONMA" => array("TireHub","143BOSTONMA","TIREHUB-Inv_143BOSTONMA"),
                    "BUFFALONY" => array("TireHub","146BUFFALONY","TIREHUB-Inv_146BUFFALONY"),
                    "CHARLOTTENC" => array("TireHub","112CHARLOTTENC","TIREHUB-Inv_112CHARLOTTENC"),
                    "CHATANOOGAGA" => array("TireHub","138CHATANOOGAGA","TIREHUB-Inv_138CHATANOOGAGA"),
                    "CHICAGOIL" => array("TireHub","126CHICAGOIL","TIREHUB-Inv_126CHICAGOIL"),
                    "CINCINNATIOH" => array("TireHub","140CINCINNATIOH","TIREHUB-Inv_140CINCINNATIOH"),
                    "CLEVELANDOH" => array("TireHub","116CLEVELANDOH","TIREHUB-Inv_116CLEVELANDOH"),
                    "COLUMBUSOH" => array("TireHub","123COLUMBUSOH","TIREHUB-Inv_123COLUMBUSOH"),
                    "DALLASTX" => array("TireHub","110DALLASTX","TIREHUB-Inv_110DALLASTX"),
                    "DENVERCO" => array("TireHub","120DENVERCO","TIREHUB-Inv_120DENVERCO"),
                    "DETROITMI" => array("TireHub","121DETROITMI","TIREHUB-Inv_121DETROITMI"),
                    "FONTANACA" => array("TireHub","131FONTANACA","TIREHUB-Inv_131FONTANACA"),
                    "FRESNOCA" => array("TireHub","160FRESNOCA","TIREHUB-Inv_160FRESNOCA"),
                    "FTLAUDERDALEFL" => array("TireHub","105FTLAUDERDALEFL","TIREHUB-Inv_105FTLAUDERDALEFL"),
                    "FTMYERSFL" => array("TireHub","206FTMYERSFL","TIREHUB-Inv_206FTMYERSFL"),
                    "GREENSBORONC" => array("TireHub","149GREENSBORONC","TIREHUB-Inv_149GREENSBORONC"),
                    "HARTFORDCT" => array("TireHub","115HARTFORDCT","TIREHUB-Inv_115HARTFORDCT"),
                    "HAWAIIHI" => array("TireHub","166HAWAIIHI","TIREHUB-Inv_166HAWAIIHI"),
                    "HOUSTONTX" => array("TireHub","113HOUSTONTX","TIREHUB-Inv_113HOUSTONTX"),
                    "INDIANAPOLISIN" => array("TireHub","141INDIANAPOLISIN","TIREHUB-Inv_141INDIANAPOLISIN"),
                    "JACKSONMS" => array("TireHub","124JACKSONMS","TIREHUB-Inv_124JACKSONMS"),
                    "JACKSONVILLEFL" => array("TireHub","104JACKSONVILLEFL","TIREHUB-Inv_104JACKSONVILLEFL"),
                    "KANSASCITYMO" => array("TireHub","109KANSASCITYMO","TIREHUB-Inv_109KANSASCITYMO"),
                    "KNOXVILLETN" => array("TireHub","204KNOXVILLETN","TIREHUB-Inv_204KNOXVILLETN"),
                    "LASVEGASNV" => array("TireHub","159LASVEGASNV","TIREHUB-Inv_159LASVEGASNV"),
                    "LONGISLANDNY" => array("TireHub","135LONGISLANDNY","TIREHUB-Inv_135LONGISLANDNY"),
                    "LOSANGELESCA" => array("TireHub","163LOSANGELESCA","TIREHUB-Inv_163LOSANGELESCA"),
                    "LOUISVILLEKY" => array("TireHub","108LOUISVILLEKY","TIREHUB-Inv_108LOUISVILLEKY"),
                    "MANASSASVA" => array("TireHub","132MANASSASVA","TIREHUB-Inv_132MANASSASVA"),
                    "MEMPHISTN" => array("TireHub","139MEMPHISTN","TIREHUB-Inv_139MEMPHISTN"),
                    "MIAMIFL" => array("TireHub","152MIAMIFL","TIREHUB-Inv_152MIAMIFL"),
                    "MOBILEAL" => array("TireHub","157MOBILEAL","TIREHUB-Inv_157MOBILEAL"),
                    "NASHVILLETN" => array("TireHub","117NASHVILLETN","TIREHUB-Inv_117NASHVILLETN"),
                    "NEWORLEANSLA" => array("TireHub","154NEWORLEANSLA","TIREHUB-Inv_154NEWORLEANSLA"),
                    "NORTHJERSEYNJ" => array("TireHub","118NORTHJERSEYNJ","TIREHUB-Inv_118NORTHJERSEYNJ"),
                    "OAKLANDCA" => array("TireHub","129OAKLANDCA","TIREHUB-Inv_129OAKLANDCA"),
                    "OKCOK" => array("TireHub","111OKCOK","TIREHUB-Inv_111OKCOK"),
                    "OMAHANE" => array("TireHub","125OMAHANE","TIREHUB-Inv_125OMAHANE"),
                    "ORLANDOFL" => array("TireHub","107ORLANDOFL","TIREHUB-Inv_107ORLANDOFL"),
                    "PHILADELPHIANJ" => array("TireHub","102PHILADELPHIANJ","TIREHUB-Inv_102PHILADELPHIANJ"),
                    "PHOENIXAZ" => array("TireHub","128PHOENIXAZ","TIREHUB-Inv_128PHOENIXAZ"),
                    "PITTSBURGHPA" => array("TireHub","127PITTSBURGHPA","TIREHUB-Inv_127PITTSBURGHPA"),
                    "PORTLANDOR" => array("TireHub","134PORTLANDOR","TIREHUB-Inv_134PORTLANDOR"),
                    "RALEIGHNC" => array("TireHub","100RALEIGHNC","TIREHUB-Inv_100RALEIGHNC"),
                    "RICHMONDVA" => array("TireHub","122RICHMONDVA","TIREHUB-Inv_122RICHMONDVA"),
                    "ROCHESTERNY" => array("TireHub","133ROCHESTERNY","TIREHUB-Inv_133ROCHESTERNY"),
                    "SACRAMENTOCA" => array("TireHub","165SACRAMENTOCA","TIREHUB-Inv_165SACRAMENTOCA"),
                    "SALTLAKECITYUT" => array("TireHub","119SALTLAKECITYUT","TIREHUB-Inv_119SALTLAKECITYUT"),
                    "SANANTONIOTX" => array("TireHub","114SANANTONIOTX","TIREHUB-Inv_114SANANTONIOTX"),
                    "SANDIEGOCA" => array("TireHub","200SANDIEGOCA","TIREHUB-Inv_200SANDIEGOCA"),
                    "SANJOSECA" => array("TireHub","164SANJOSECA","TIREHUB-Inv_164SANJOSECA"),
                    "SANTAANACA" => array("TireHub","162SANTAANACA","TIREHUB-Inv_162SANTAANACA"),
                    "SEATTLEWA" => array("TireHub","167SEATTLEWA","TIREHUB-Inv_167SEATTLEWA"),
                    "SIMIVALLEYCA" => array("TireHub","130SIMIVALLEYCA","TIREHUB-Inv_130SIMIVALLEYCA"),
                    "SYRACUSENY" => array("TireHub","147SYRACUSENY","TIREHUB-Inv_147SYRACUSENY"),
                    "TAMPAFL" => array("TireHub","103TAMPAFL","TIREHUB-Inv_103TAMPAFL"),
                ),

                "vftp0032"=>array(
                    "3001"=>array("TBC","TBC3001","TBC-Inv_AlbanyGA"),
                    "3008"=>array("TBC","TBC3008","TBC-Inv_FlorenceSC"),
                    "3009"=>array("TBC","TBC3009","TBC-Inv_GainesvilleGA"),
                    "3010"=>array("TBC","TBC3010","TBC-Inv_GreerSC"),
                    "3011"=>array("TBC","TBC3011","TBC-Inv_GrovetownGA"),
                    "3013"=>array("TBC","TBC3013","TBC-Inv_JacksonvilleFL"),
                    "3015"=>array("TBC","TBC3015","TBC-Inv_MaconGA"),
                    "3017"=>array("TBC","TBC3017","TBC-Inv_OrlandoFL"),
                    "3019"=>array("TBC","TBC3019","TBC-Inv_PoolerGA"),
                    "3021"=>array("TBC","TBC3021","TBC-Inv_WestPalmBeachFL"),
                    "3023"=>array("TBC","TBC3023","TBC-Inv_TampaFL"),
                    "3029"=>array("TBC","TBC3029","TBC-Inv_LehighAcresFL"),
                    "3032"=>array("TBC","TBC3032","TBC-Inv_LongviewTX"),
                    "3035"=>array("TBC","TBC3035","TBC-Inv_AuburnME"),
                    "3037"=>array("TBC","TBC3037","TBC-Inv_OcoeeTN"),
                    "3038"=>array("TBC","TBC3038","TBC-Inv_KnoxvilleTN"),
                    "3040"=>array("TBC","TBC3040","TBC-Inv_RochesterNY"),
                    "3041"=>array("TBC","TBC3041","TBC-Inv_AlbanyNY"),
                    "3042"=>array("TBC","TBC3042","TBC-Inv_GoodlettsvilleTN"),
                    "3044"=>array("TBC","TBC3044","TBC-Inv_WichitaKS"),
                    "3046"=>array("TBC","TBC3046","TBC-Inv_SantaFeSpringsCA"),
                    "3050"=>array("TBC","TBC3050","TBC-Inv_GlendaleHeightsIL"),
                    "3058"=>array("TBC","TBC3058","TBC-Inv_LockbourneOH"),
                    "3060"=>array("TBC","TBC3060","TBC-Inv_BeniciaCA"),
                    "3061"=>array("TBC","TBC3061","TBC-Inv_ColumbiaMO"),
                    "3064"=>array("TBC","TBC3064","TBC-Inv_RedlandsCA"),
                    "3065"=>array("TBC","TBC3065","TBC-Inv_FresnoCA"),
                    "3066"=>array("TBC","TBC3066","TBC-Inv_TollesonAZ"),
                    "3069"=>array("TBC","TBC3069","TBC-Inv_WestSacramentoCA"),
                    "3071"=>array("TBC","TBC3071","TBC-Inv_StowOH"),
                    "3072"=>array("TBC","TBC3072","TBC-Inv_BedfordParkIL"),
                    "3111"=>array("TBC","TBC3111","TBC-Inv_OmahaNE"),
                    "3121"=>array("TBC","TBC3121","TBC-Inv_WyomingMI"),
                    "3122"=>array("TBC","TBC3122","TBC-Inv_KnoxvilleTN2"),
                    "3124"=>array("TBC","TBC3124","TBC-Inv_MaumeOH"),
                    "3133"=>array("TBC","TBC3133","TBC-Inv_MariettaGA"),
                    "3134"=>array("TBC","TBC3134","TBC-Inv_NCharlestonSC"),
                    "3140"=>array("TBC","TBC3140","TBC-Inv_WillistonVT"),
                    "3144"=>array("TBC","TBC3144","TBC-Inv_LibertyvilleIL"),
                    "3146"=>array("TBC","TBC3146","TBC-Inv_AlbuquerqueNM"),
                    "3149"=>array("TBC","TBC3149","TBC-Inv_MidwayFL"),
                    "3153"=>array("TBC","TBC3153","TBC-Inv_OFallonMO"),
                    "3154"=>array("TBC","TBC3154","TBC-Inv_AvenelNJ"),
                    "3155"=>array("TBC","TBC3155","TBC-Inv_HicksvilleNY"),
                    "3159"=>array("TBC","TBC3159","TBC-Inv_SpringfieldMO"),
                    "3163"=>array("TBC","TBC3163","TBC-Inv_ChatsworthCA"),
                    "3165"=>array("TBC","TBC3165","TBC-Inv_NewBerlinWI"),
                    "3179"=>array("TBC","TBC3179","TBC-Inv_KansasCityKS"),
                    "3180"=>array("TBC","TBC3180","TBC-Inv_RogersMN"),
                    "3185"=>array("TBC","TBC3185","TBC-Inv_ConwaySC"),
                    "3187"=>array("TBC","TBC3187","TBC-Inv_ColumbiaSC"),
                    "3192"=>array("TBC","TBC3192","TBC-Inv_LubbockTX"),
                    "3194"=>array("TBC","TBC3194","TBC-Inv_SunnyvaleCA"),
                    "3201"=>array("TBC","TBC3201","TBC-Inv_AnchorageAK"),
                    "3203"=>array("TBC","TBC3203","TBC-Inv_ColoradoSpringsCO"),
                    "3205"=>array("TBC","TBC3205","TBC-Inv_MesquiteTX"),
                    "3209"=>array("TBC","TBC3209","TBC-Inv_DenverCO"),
                    "3214"=>array("TBC","TBC3214","TBC-Inv_WestValleyCityUT"),
                    "3216"=>array("TBC","TBC3216","TBC-Inv_TucsonAZ"),
                    "3223"=>array("TBC","TBC3223","TBC-Inv_LexingtonKY"),
                    "3228"=>array("TBC","TBC3228","TBC-Inv_BellevilleMI"),
                    "3231"=>array("TBC","TBC3231","TBC-Inv_BrooksKY"),
                    "3236"=>array("TBC","TBC3236","TBC-Inv_NormalIL"),
                    "3240"=>array("TBC","TBC3240","TBC-Inv_BurienWA"),
                    "3242"=>array("TBC","TBC3242","TBC-Inv_ForestParkGA"),
                    "3243"=>array("TBC","TBC3243","TBC-Inv_NorcrossGA"),
                    "3244"=>array("TBC","TBC3244","TBC-Inv_StaffordTX"),
                    "3253"=>array("TBC","TBC3253","TBC-Inv_WestChesterOH"),
                    "3269"=>array("TBC","TBC3269","TBC-Inv_MiamiFL"),
                    "3281"=>array("TBC","TBC3281","TBC-Inv_OklahomaCityOK"),
                    "3282"=>array("TBC","TBC3282","TBC-Inv_PortlandOR"),
                    "3283"=>array("TBC","TBC3283","TBC-Inv_SpokaneWA"),
                    "3286"=>array("TBC","TBC3286","TBC-Inv_MemphisTN"),
                    "3289"=>array("TBC","TBC3289","TBC-Inv_PflugervilleTX"),
                ),


                "vftp0033"=>array(
                    "AL" =>array("VisionWheels","VWAL","VW-Inv_DecaturAL"),
                    "CA" =>array("VisionWheels","VWCA","VW-Inv_CoronaCA"),
                    "IN" =>array("VisionWheels","VWIN","VW-Inv_PortageIN"),
                    "TX" =>array("VisionWheels","VWTX","VW-Inv_CoppellTX"),
                    "NC" =>array("VisionWheels","VWNC","VW-Inv_CharlotteNC"),
                    "ON" =>array("VisionWheels","VWON","VW-Inv_OntarioCA"),
                    "US" =>array("VisionWheels","N/A","N/A"),
                    "CAD" =>array("VisionWheels","N/A","N/A"),
                ),
        );
    
        $allFiles =array();

        $db_ext = \DB::connection('sqlsrv'); // SAP Server Connection

        $vftp = Storage::disk('vftp');
        $vftpFolders = $vftp->directories('/');

        foreach ($vftpFolders as $key => $vftpFolder) { 
            foreach ($vftp->files('/'.$vftpFolder) as $key1 => $fileAddress) {
                // dd($fileAddress);
                Storage::disk('public')->put("/vftp/".$fileAddress, $vftp->get("/".$fileAddress));
            }
        }  
        
 

        $allFiles = $this->recursiveScan(public_path('/storage/vftp'),$this->storeArr);

        foreach($allFiles as $folderKey => $vftpFolder) {

            foreach($vftpFolder as $key => $selectedFile) {  
                $filepathArray = explode('/', $selectedFile);
                $selectedFileName = end($filepathArray); 

                if(in_array($folderKey, ["vftp0013","vftp0017","vftp0027","vftp0028","vftp0030","vftp0032"])){

                    $isMigrate = InventoryMigration::where('foldername',$folderKey)->where('filename',$selectedFileName)->first(); 
                }else{
                    $isMigrate = false;
                }  

                if(!$isMigrate){


                    // $this->info("File Name : ",$selectedFile);

                    $fields = $fieldsArray[$folderKey]; 

                    // Open and Read individual CSV file
                    if (($inpfile = fopen($selectedFile, 'r')) !== false) {
                        // Collect CSV each row records
                        $flag = 0; 

                        if(strpos($selectedFileName, ".CSV") !== false || strpos($selectedFileName, ".csv") !== false){

                            while (($data = fgetcsv($inpfile, 10000)) !== false) {
                                // dd($data);
                                if($flag != 0){

                                    if($folderKey == "vftp0030"){
                                        $dataValue = explode('|', $data[0]);
                                    }else{
                                        $dataValue =  $data;
                                    } 

                                    $insertData = array(

                                        // 'filename'=>$folderKey,

                                         'partno'=>($fields['partno']!=null)?$dataValue[$fields['partno']]:null,                         //PartNo

                                         'vendor_partno'=>($fields['vendor_partno']!=null)?$dataValue[$fields['vendor_partno']]:null,        //VendorPartNo

                                         'mpn'=>($fields['mpn']!=null)?$dataValue[$fields['mpn']]:null,                 //MPN

                                         'description'=>($fields['description']!=null)?$dataValue[$fields['description']]:null,         //Description

                                         'brand'=>($fields['brand']!=null)?$dataValue[$fields['brand']]:null,               //Brand

                                         'model'=>($fields['model']!=null)?$dataValue[$fields['model']]:null,               //Model

                                         'location_code'=>($fields['location_code']!=null)?trim($dataValue[$fields['location_code']]," "):null,       //Location Code

                                         'price'=>($fields['price']!=null)?$dataValue[$fields['price']]:0,               //Price
                                    );  



                                    if(gettype($fields['available_qty']) != 'array'){

                                            $insertData['available_qty']=($fields['available_qty']!=null)?$dataValue[$fields['available_qty']]:0; 

                                    } 

                                    if($folderKey == "vftp0010" || $folderKey == "vftp0015"  || $folderKey == "vftp0023" || $folderKey == "vftp0030" || $folderKey == "vftp0032" || $folderKey == "vftp0033"){

                                        $insertData['drop_shipper']=$vendor_info[$folderKey][$insertData['location_code']][0];
                                        $insertData['ds_vendor_code']=$vendor_info[$folderKey][$insertData['location_code']][1];
                                        $insertData['location_name']=$vendor_info[$folderKey][$insertData['location_code']][2];
                                        $this->inventoryFeedUpdate($insertData,$db_ext);

                                    }elseif($folderKey == "vftp0011" || $folderKey == "vftp0016" || $folderKey == "vftp0017" ||  $folderKey == "vftp0018" ||   $folderKey == "vftp0031"){ 


                                        foreach ($vendor_info[$folderKey] as $key => $vendor) { 
                                            $insertData['available_qty']=$dataValue[$fieldsArray[$folderKey]['available_qty'][$key]]; 
                                            $insertData['location_code']=$key; 

                                            $insertData['drop_shipper']=$vendor[0];
                                            $insertData['ds_vendor_code']=$vendor[1];
                                            $insertData['location_name']=$vendor[2]; 
                                           

                                        $this->inventoryFeedUpdate($insertData,$db_ext);

                                        }
                                        
                                    }elseif($folderKey == "vftp0012" || $folderKey == "vftp0029"  ){

                                            $fullfile = explode('/', $selectedFile);
                                            $filename = explode(".",end($fullfile));
                                            $locName = $filename[0];

                                            if($folderKey == "vftp0029"){
                                                $filenameArray = explode('_',$locName);
                                                $locName = $filenameArray[2];
                                            }


                                            $insertData['drop_shipper']=$vendor_info[$folderKey][$locName][0];
                                            $insertData['ds_vendor_code']=$vendor_info[$folderKey][$locName][1];
                                            $insertData['location_name']=$vendor_info[$folderKey][$locName][2]; 

                                        $this->inventoryFeedUpdate($insertData,$db_ext);                                    

                                    }elseif($folderKey == "vftp0013"){

                                    }elseif($folderKey == "vftp0014" || $folderKey == "vftp0027"){

                                        $insertData['drop_shipper']=$vendor_info[$folderKey][0];
                                        $insertData['ds_vendor_code']=$vendor_info[$folderKey][1];
                                        $insertData['location_name']=$vendor_info[$folderKey][2];


                                        $this->inventoryFeedUpdate($insertData,$db_ext);

                                    }elseif($folderKey == "vftp0028"){ 

         
                                        $insertData['partno'] = preg_replace("/[^A-Za-z0-9]/", '',$insertData['partno']);
                                        foreach ($vendor_info[$folderKey] as $key => $vendor) { 
                                            $insertData['available_qty']=$dataValue[$fieldsArray[$folderKey]['available_qty'][$key]]; 
                                            $insertData['location_code']=$key; 

                                            $insertData['price']=$dataValue[($fieldsArray[$folderKey]['available_qty'][$key])+1];

                                            $insertData['drop_shipper']=$vendor[0];
                                            $insertData['ds_vendor_code']=$vendor[1];
                                            $insertData['location_name']=$vendor[2]; 

                                        $this->inventoryFeedUpdate($insertData,$db_ext);
                                        }
                                        
                                    }
                                }
                                $flag=1;
                            }
                        }else{
                        
                            \Excel::load($filepath, function($reader) {
                                // $reader->ignoreEmpty();
                                $results = $reader->get()->toArray();
                                // dd($results);
                                foreach($results as $key => $data){
                                    if($flag != 0){

                                        if($folderKey == "vftp0030"){
                                            $dataValue = explode('|', $data[0]);
                                        }else{
                                            $dataValue =  $data;
                                        } 

                                        $insertData = array(

                                            // 'filename'=>$folderKey,

                                             'partno'=>($fields['partno']!=null)?$dataValue[$fields['partno']]:null,                         //PartNo

                                             'vendor_partno'=>($fields['vendor_partno']!=null)?$dataValue[$fields['vendor_partno']]:null,        //VendorPartNo

                                             'mpn'=>($fields['mpn']!=null)?$dataValue[$fields['mpn']]:null,                 //MPN

                                             'description'=>($fields['description']!=null)?$dataValue[$fields['description']]:null,         //Description

                                             'brand'=>($fields['brand']!=null)?$dataValue[$fields['brand']]:null,               //Brand

                                             'model'=>($fields['model']!=null)?$dataValue[$fields['model']]:null,               //Model

                                             'location_code'=>($fields['location_code']!=null)?trim($dataValue[$fields['location_code']]," "):null,       //Location Code

                                             'price'=>($fields['price']!=null)?$dataValue[$fields['price']]:0,               //Price
                                        );  
                                        if(gettype($fields['available_qty']) != 'array'){

                                                $insertData['available_qty']=($fields['available_qty']!=null)?$dataValue[$fields['available_qty']]:0; 

                                        } 

                                        if($folderKey == "vftp0010" || $folderKey == "vftp0015"  || $folderKey == "vftp0023" || $folderKey == "vftp0030" || $folderKey == "vftp0032" || $folderKey == "vftp0033"){

                                            $insertData['drop_shipper']=$vendor_info[$folderKey][$insertData['location_code']][0];
                                            $insertData['ds_vendor_code']=$vendor_info[$folderKey][$insertData['location_code']][1];
                                            $insertData['location_name']=$vendor_info[$folderKey][$insertData['location_code']][2];
                                            $this->inventoryFeedUpdate($insertData,$db_ext);

                                        }elseif($folderKey == "vftp0011" || $folderKey == "vftp0016" || $folderKey == "vftp0017" ||  $folderKey == "vftp0018" ||   $folderKey == "vftp0031"){ 


                                            foreach ($vendor_info[$folderKey] as $key => $vendor) { 
                                                $insertData['available_qty']=$dataValue[$fieldsArray[$folderKey]['available_qty'][$key]]; 
                                                $insertData['location_code']=$key; 

                                                $insertData['drop_shipper']=$vendor[0];
                                                $insertData['ds_vendor_code']=$vendor[1];
                                                $insertData['location_name']=$vendor[2]; 
                                               

                                            $this->inventoryFeedUpdate($insertData,$db_ext);

                                            }
                                            
                                        }elseif($folderKey == "vftp0012" || $folderKey == "vftp0029"  ){

                                                $fullfile = explode('/', $selectedFile);
                                                $filename = explode(".",end($fullfile));
                                                $locName = $filename[0];

                                                if($folderKey == "vftp0029"){
                                                    $filenameArray = explode('_',$locName);
                                                    $locName = $filenameArray[2];
                                                }


                                                $insertData['drop_shipper']=$vendor_info[$folderKey][$locName][0];
                                                $insertData['ds_vendor_code']=$vendor_info[$folderKey][$locName][1];
                                                $insertData['location_name']=$vendor_info[$folderKey][$locName][2]; 

                                            $this->inventoryFeedUpdate($insertData,$db_ext);                                    

                                        }elseif($folderKey == "vftp0013"){

                                        }elseif($folderKey == "vftp0014" || $folderKey == "vftp0027"){

                                            $insertData['drop_shipper']=$vendor_info[$folderKey][0];
                                            $insertData['ds_vendor_code']=$vendor_info[$folderKey][1];
                                            $insertData['location_name']=$vendor_info[$folderKey][2];


                                            $this->inventoryFeedUpdate($insertData,$db_ext);

                                        }elseif($folderKey == "vftp0028"){ 

             
                                            $insertData['partno'] = preg_replace("/[^A-Za-z0-9]/", '',$insertData['partno']);
                                            foreach ($vendor_info[$folderKey] as $key => $vendor) { 
                                                $insertData['available_qty']=$dataValue[$fieldsArray[$folderKey]['available_qty'][$key]]; 
                                                $insertData['location_code']=$key; 

                                                $insertData['price']=$dataValue[($fieldsArray[$folderKey]['available_qty'][$key])+1];

                                                $insertData['drop_shipper']=$vendor[0];
                                                $insertData['ds_vendor_code']=$vendor[1];
                                                $insertData['location_name']=$vendor[2]; 

                                            $this->inventoryFeedUpdate($insertData,$db_ext);
                                            }
                                            
                                        }
                                    }
                                    $flag=1;
                                }
                            })->get();
 
                        }

                        $migratedFile = InventoryMigration::where('foldername',$folderKey)->where('filename',$selectedFileName)->first();
                        if($migratedFile){
                            
                            $migratedFile->foldername = $folderKey;
                            $migratedFile->filename = $selectedFileName;
                            $migratedFile->save();

                        }else{
                            InventoryMigration::create(['foldername'=>$folderKey,'filename'=>$selectedFileName]);
                        }
                    }

                }
            }
        } 
        return "success";
    }

 
 

}