<?php

namespace App\Console\Commands;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


use App\Inventory;
use App\InventoryMigration;
use App\InventoryProcess;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Storage;


class InventoryAutoUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autoupdate:inventories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'VFTP folders read and update to database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
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

 

        \Log::info("Part No : ".$newData['partno']." location_code : ".$newData['location_code']);


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
            $query = "UPDATE  {$table}  SET price = '".$newData['price']."',available_qty = '".$newData['available_qty']."',updated_at = '".$newData['updated_at']."' WHERE partno='".$newData['partno']."' and location_code='".$newData['location_code']."'";
        }else{
            $query = "INSERT INTO {$table} ('{$columnsString}') VALUES ('{$valuesString}')";
        
        }

        \DB::statement($query);
        
        $db_ext->statement($query);


    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // ini_set('max_execution_time',39600);
        // set_time_limit(39600);

        $foldersArray = array(
            "vftp0010",
            "vftp0011",
            // "vftp0012",//Client Asked to Stop
            "vftp0013",
            "vftp0014",
            "vftp0015",
            "vftp0016",
            "vftp0017",
            "vftp0018",
            "vftp0019",
            "vftp0022",
            "vftp0023",
            "vftp0024",
            "vftp0027",
            "vftp0028",
            "vftp0029",
            "vftp0030",
            // "vftp0031", //Client Asked to Stop
            "vftp0032",
            "vftp0033",
            "vftp0036",
            "vftp0037",
            "vftp0038",
            "vftp0040",
            "vftp0042",
            "vftp0043",
            "vftp0044",
            "vftp0045",
            "vftp0046",
            "vftp0047",
            "vftp0048",
            "vftp0049",
            "vftp0050",
            "vftp0051",
            "vftp0052",
            "vftp0053",
            "vftp0054",
            "vftp0055"
        );
 
        // $allFiles =array();

        // $db_ext = \DB::connection('sqlsrv'); // SAP Server Connection

        $vftp = Storage::disk('vftp');
        $vftpFolders = $vftp->directories('/');

        foreach ($vftpFolders as $key => $vftpFolder) { 
            foreach ($vftp->files('/'.$vftpFolder) as $key1 => $fileAddress) {
                // dd($fileAddress);
                Storage::disk('public')->put("/vftp/".$fileAddress, $vftp->get("/".$fileAddress));
            }
        }  
        

        $allFiles = $this->recursiveScan(public_path('/storage/vftp'),$this->storeArr);

        unset($allFiles['vftp0020']);
        unset($allFiles['vftp0021']);
        unset($allFiles['vftp0025']);
        unset($allFiles['vftp0034']);
        unset($allFiles['vftp0035']);

        $processes = array();

        \Log::info('Sub Process Started!...........');

        $existingProcessIds = InventoryProcess::where('started_at','<', \Carbon\Carbon::now())->pluck('processid')->toArray();
        // dd($existingProcessIds) ;
        if(count($existingProcessIds) > 0){
                $pidStr = implode(" ",$existingProcessIds);
                $process = new Process("kill -HUP ".$pidStr);
                $process->disableOutput();
                $process->start();
        }
        // dd('hgkg');
        foreach($foldersArray as $key => $folder) {

                 $process = new Process('php ' . base_path('artisan') . " folderupdate:inventories ".$folder);
                 // $process->setTimeout(0);
                 $process->disableOutput();
                 $process->start();
                // dd($folder);
                \Log::info('Sub Process Started!...........'.$folder);
                 // $processes[] = $process;

 
        } 
        // dd($processes);
        return "success";
    }
}
