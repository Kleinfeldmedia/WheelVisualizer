<?php

use App\Wheel; 
use App\Viflist;
use App\Tire;
use App\Vehicle;
use App\WheelProduct;
use App\MetaKeyword;
use App\CMSPage;
use App\Slider;
use App\Review;
use App\Rating;
use App\Country;
use App\State;

use Illuminate\Http\Request;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;

function MakeCustomPaginator($objectData,$request,$per_page=9,$page_name='page'){

	$data=$objectData->toArray();

	$total=count($data);

	$current_page = $request->input($page_name) ?? 1;

	$starting_point = ($current_page * $per_page) - $per_page;

	$data = array_slice($data, $starting_point, $per_page, true);

	$data = new Paginator($data, $total, $per_page, $current_page, [
		'path' => $request->url(),
		'query' => $request->query(),
		'pageName' => $page_name
	]);
	return $data;
}


function SplitBenefitHeading($string=''){
	$resultString = '';
	$flag=0;
	if($string != '' )
	{
		$words = explode(" ", $string);
        foreach($words as $word) {
        	$filteredWord = preg_replace('/[^A-Za-z0-9\-]/', '', $word);
        	$filteredWord = preg_replace("/-/", "", $filteredWord);
            if( ( ctype_upper($word) || ctype_upper($filteredWord) ) && $flag==0){
                $resultString.="<b>".$word."</b>";
            } 
            else{
            	if($flag==0){
            		if($resultString != ''){

                		$resultString.="<br>";
            		}
            		$flag=1;
            	}
                $resultString.=$word;
            }
            $resultString.=" ";
        }

	}

	return $resultString;
}

function convertBoltPattern($pattern=''){
	if($pattern == 'Blank5' || $pattern == 'Blank6'  || $pattern == 'Blank5x' || $pattern == '' )
	{
		$patternText='Fits most';
		if($pattern == 'Blank5'){
			$patternText.=' 5 lug';		
		}elseif($pattern == 'Blank6'){
			$patternText.=' 6 lug';
		}elseif($pattern == 'Blank5x'){
			$patternText.=' 5x lug';		
		}

		$patternText .=' bolt patterns';

		if($pattern == ''){
			return $pattern;
		}else{
			return $patternText??'';
		}
		
	}else{

		return substr_replace($pattern, ' x ', 1, 0);
	}
}
function showBoltPattern($bp1,$bp2='',$bp3=''){

	$pattern ='';
	if($bp1 == 'Blank5' || $bp2 == 'Blank6')
	{
		$pattern.='Fits most';
		if($bp1 == 'Blank5'){
			$pattern.=' 5 lug';		
		}
		if($bp2 == 'Blank6'){
			$pattern.=' And 6 lug';
		}

		$pattern .=' bolt patterns';
	}else{
		// $pattern.='Fits ';
		if($bp1 != null){
			$pattern.= convertBoltPattern($bp1) ;		
		}
		if($bp2 != null){
			$pattern.=' And '.convertBoltPattern($bp2) ;
		}

	}

	return $pattern;
}
function roundCurrency($amt=0){
	// return round($amt,2);
	return "$".number_format((float)$amt, 2, '.', '');
}

function getHigherSpeedRating($rating=''){
	$list = array("B","C","D","E","F","G","I","J","K","L","M","N","O","P","Q","R","S","T","U","H","V","W","X","Y","ZR");
	$key = array_search($rating, $list);


	$max1 = $key;
	$max2 = count($list);
	for ($i=0; ($i<$max1 && $i<$max2); $i++) {
	    unset($list[$i]);
	    $key--;
	}
	return array('list'=>$list,'key'=>$key);
}


//// All Wheel Brands
function wheelbrands($splitarray = '') {
	$wheels = Wheel::select('brand');
	if($splitarray){
		if($splitarray == 3 || $splitarray == 4)
	 		$wheels = array_chunk($wheels->addSelect('image','style','wheeldiameter')->inRandomOrder()->get()->unique('brand')->toArray(), $splitarray); 
	 	else
	 		$wheels = array_chunk($wheels->addSelect('brand','style')->inRandomOrder()->take(10)->get()->unique('brand')->toArray(), $splitarray); 
	}
 	else
		$wheels = $wheels->get()->unique('brand');
 	return $wheels; 
} 

///// Wheel front and back image path 
function front_back_path($imgPath){ 
	$imageArray = explode('/', $imgPath);
	$filename = str_replace(".jpg","",end($imageArray)); 
	$filename = str_replace(".png","",$filename); //explode('.', end($imageArray));  
	$filename = str_replace(".jpeg","",$filename); //explode('.', end($imageArray));  
	if($imageArray != null){
		if(file_exists(public_path('storage/wheels/front_back/'.$filename.'.png'))){

			return 'storage/wheels/front_back/'.$filename.'.png';
		}else{

			return 'storage/wheels/front_back/'.$filename.'.png';
		}
	}else{
		return $imgPath;
	}
}
function front_back_filecheck($imgPath){ 
	$imageArray = explode('/', $imgPath);
	$filename = str_replace(".jpg","",end($imageArray)); 
	$filename = str_replace(".png","",$filename); //explode('.', end($imageArray));  
	$filename = str_replace(".jpeg","",$filename); //explode('.', end($imageArray));  
	if($imageArray != null){
		if(file_exists(base_path('storage/app/public/wheels/front_back/'.$filename.'.png'))){

			return 'storage/wheels/front_back/'.$filename.'.png';
		}else{

			return false;
		}
	}else{
		return $imgPath;
	}
}

function ViewUserProfileImage($url=''){
	if($url != ''){
		if(file_exists(public_path('/storage/'.$url))){
			return asset('/storage/'.$url);
		}else{
			return url('/user/img/no-user.png'); 
		}
	}else{
			return url('/user/img/no-user.png'); 
	}

}

function ViewImage($url=''){
	if($url != ''){
		if(file_exists(public_path('/storage/'.$url))){
			return asset('/storage/'.$url);
		}else{
			$wheel_products_url="/storage/wheel_products/".$url;
			$misc_url="/storage/misc_images/".$url;
			if(file_exists(public_path($wheel_products_url))){
				return asset($wheel_products_url);
			}else{
				if(file_exists(public_path($misc_url))){
					return asset($misc_url);
				}else{
					return asset('image/no_image.jpg');
				}
			}
		}
	}else{
			return asset('image/no_image.jpg');
	}

}

function ViewTireImage($url=''){ 
	if($url != ''){
		if(file_exists(public_path('/storage/tires/'.$url))){
			return asset('/storage/tires/'.$url);
		}else{
			$wheel_products_url="/storage/wheel_products/".$url;
			$misc_url="/storage/misc_images/".$url;
			if(file_exists(public_path($wheel_products_url))){
				return asset($wheel_products_url);
			}else{
				if(file_exists(public_path($misc_url))){
					return asset($misc_url);
				}else{
					return asset('image/no_image.jpg');
				}
			}
		}
	}else{
			return asset('image/no_image.jpg');
	}

}

function ViewTireBadgeImage($url=''){ 
	if($url != ''){
		if(file_exists(public_path('/storage/tires/badges/'.$url))){
			return asset('/storage/tires/badges/'.$url);
		}else{
				$misc_url="/storage/misc_images/".$url;
				if(file_exists(public_path($misc_url))){
					return asset($misc_url);
				}else{
					return false;
				}
		}
	}else{
			return false;
	}

}

function ViewExistImage($url=''){
	// return $url;
	if($url != ''){
		if(file_exists(public_path('/storage/tires/'.$url))){
			return asset('/storage/tires/'.$url);
		}else{ 
					return false; 
		}
	}else{
			return false;
	}

}

function ViewBenefitImage($url=''){
	if($url != ''){
		if(file_exists(public_path('/storage/tires/models/'.$url))){
			return asset('/storage/tires/models/'.$url);
		}elseif(file_exists(public_path('/storage/tires/benefits/'.$url))){
			return asset('/storage/tires/benefits/'.$url);
		}else{
			return asset('/storage/tires/models/Checkmark.png');
		}
	}else{
			return asset('/storage/tires/models/Checkmark.png');
	}

}
function ViewProductImage($url=''){
	if($url != ''){
		if(file_exists(public_path('/storage/tires/models/'.$url))){
			return asset('/storage/tires/models/'.$url);
		}else{
			return false;
		}
	}else{
			return false;
	}

}
// Rim size to Wheel Diameter Conversion
function getRimToWheelDiameter($rimSize=''){

		$rim = explode('x', $rimSize);
		$diameter = $rim[1]; 
        return $diameter;
}
// Rim size to Wheel Diameter Conversion
function getWheelDiameterToRim($diameter='',$width=''){

		// $rim = explode('x', $rimSize);
		$rim = $width ." x ". $diameter; 
        return $rim;
}

function getMakeList(){

        $make = Viflist::select('make')->distinct('make')->orderBy('make','Asc')->pluck('make'); 
        return $make;
}


//***************************** Discount Tires Starts*************************************//


function getTireList($columnname=''){
		if($columnname){ 
			//width=305&profile=55&diameter=20
			$selectedwidth = Session::get('user.searchByTireSize')['width']??null;
			$selectedprofile = Session::get('user.searchByTireSize')['profile']??null;
			$selecteddiameter = Session::get('user.searchByTireSize')['diameter']??null; 

            $tires = new Tire;  

             if ($columnname == 'width'){

             	$data = $tires->select('tirewidth')
                ->distinct('tirewidth') 
                ->orderBy('tirewidth', 'DESC')
                ->pluck('tirewidth');
             }


             if (isset($selectedwidth) && $columnname == 'profile') {
				$data = $tires->select('tireprofile')
                ->distinct('tireprofile')
                ->wheretirewidth($selectedwidth)
                ->orderBy('tireprofile', 'DESC')
                ->pluck('tireprofile');
             }


            // // Width change  or Loading Filter
            if (isset($selectedwidth) && isset($selectedprofile) && $columnname == 'diameter') {
            	 $data = $tires->select('tirediameter')
                ->distinct('tirediameter')
                ->where('tirewidth', $selectedwidth)
                ->where('tireprofile', $selectedprofile)
                ->pluck('tirediameter');
            	
            }

            return $data??[];
		}
		return []; 
}

function getTireBrandList(){

        $tires = Tire::select('prodbrand')->distinct('prodbrand')->pluck('prodbrand')->toArray(); 
        sort($tires);
        return $tires;
}


//***************************** Discount Tires Ends*************************************//

//***************************** Discount Wheels - Products Starts*************************************//

// -------------> Shop By Size 
function getWheelList($columnname=''){
		if($columnname){ 
			$selectedwheeldiameter = Session::get('user.searchByWheelSize')['wheeldiameter']??null;
			$selectedwheelwidth = Session::get('user.searchByWheelSize')['wheelwidth']??null;
			$selectedboltpattern = Session::get('user.searchByWheelSize')['boltpattern']??null;
			$selectedminoffset = Session::get('user.searchByWheelSize')['minoffset']??null;
			$selectedmaxoffset = Session::get('user.searchByWheelSize')['maxoffset']??null;

            $products = new WheelProduct;  

             if ($columnname == 'wheeldiameter'){

             	$data = $products->select('wheeldiameter')
                ->distinct('wheeldiameter') 
                ->orderBy('wheeldiameter', 'DESC')
                ->pluck('wheeldiameter');
             }


             if (isset($selectedwheeldiameter) && $columnname == 'wheelwidth') 
             	$data = $products->select('wheelwidth')
                ->distinct('wheelwidth')
                ->wherewheeldiameter($selectedwheeldiameter)
                ->orderBy('wheelwidth', 'DESC')
                ->pluck('wheelwidth');

            // Width change  or Loading Filter
            if (isset($selectedwheeldiameter) && isset($selectedwheelwidth) && $columnname == 'boltpattern') 
            	 $data = $products->select('boltpattern1')
                ->distinct('boltpattern1')
                ->where('wheelwidth', $selectedwheelwidth)
                ->where('wheeldiameter', $selectedwheeldiameter)
                ->pluck('boltpattern1');

            // boltpattern change  or Loading Filter
            if (isset($selectedwheeldiameter) && isset($selectedwheelwidth) && isset($selectedboltpattern) && $columnname == 'minoffset'){

                
                 $data = $products->select('offset1')
                ->distinct('offset1')
                ->where('wheelwidth', $selectedwheelwidth)
                ->where('boltpattern1', $selectedboltpattern)
                ->where('wheeldiameter', $selectedwheeldiameter)
                ->orderBy('offset1','ASC')
                ->pluck('offset1');

            } 

            // minoffset change  or Loading Filter
            if (isset($selectedwheeldiameter) && isset($selectedwheelwidth) && isset($selectedboltpattern) && isset($selectedminoffset) && $columnname == 'maxoffset'){

                
                $data = $products->select('offset1')
                ->distinct('offset1')
                ->where('wheelwidth', $selectedwheelwidth)
                ->where('boltpattern1', $selectedboltpattern)
                ->where('wheeldiameter', $selectedwheeldiameter)
                ->where('offset1', '>',$selectedminoffset)
                ->orderBy('offset1','ASC')
                ->pluck('offset1');
            }

            return $data??[];
		}
		return [];
}
// -------------> Shop By Brand 
function getWheelBrandList(){

        $brand = WheelProduct::select('prodbrand')->distinct('prodbrand')->orderBy('prodbrand','Asc')->pluck('prodbrand'); 
        return $brand;
}
function ViewWheelProductImage($url=''){
	if($url != ''){
		$wheel_products_url="/storage/wheel_products/".$url;
		$misc_url="/storage/misc_images/".$url;
		if(file_exists(public_path($wheel_products_url))){
			return asset($wheel_products_url);
		}else{
			if(file_exists(public_path($misc_url))){
				return asset($misc_url);
			}else{
				return asset('image/no_image.jpg');
			}
		}
	}else{
			return asset('image/no_image.jpg');
	}

}

function getWheelProductImage($url=''){
	if($url != ''){
		$wheel_products_url="storage/app/public/wheel_products/".$url;
		$misc_url="storage/app/public/misc_images/".$url;
		if(file_exists(base_path($wheel_products_url))){
			return base_path($wheel_products_url);
		}else{
			if(file_exists(base_path($misc_url))){
				return base_path($misc_url);
			}else{
				return false;
			}
		}
	}else{
			return false;
	}

}

//***************************** Discount Wheels - Products Ends*************************************//


function getVehicleList($columnname='',$sortorder='asc'){
		if($columnname){
	        // $make = Vehicle::select($columnname)->distinct($columnname)->orderBy($columnname,'Asc')->pluck($columnname);
	        // return $make;
			$selectedMake = Session::get('user.searchByVehicle')['make']??'';
			$selectedYear = Session::get('user.searchByVehicle')['year']??'';
			$selectedModel = Session::get('user.searchByVehicle')['model']??'';

            $vehicle = new Vehicle; 
            // dd($request->all(),$vehicle);
            // Make change or Loading filter

            $vehicle = $vehicle->orderby($columnname,$sortorder);
            if($columnname == 'make'){
                $data = $vehicle->select('make')->distinct('make')->orderBy('make','DESC')->pluck('make');//->wheremake($request->make)
            }

            if(isset($selectedMake) && $columnname == 'year'){
				$data = $vehicle->wheremake($selectedMake)->select('year')->distinct('year')->orderBy('year','DESC')->pluck('year');
            }

            if(isset($selectedMake) && isset($selectedYear) && $columnname == 'model'){
				$data = $vehicle->wheremake($selectedMake)->where('year',$selectedYear)->select('model')->distinct('model')->orderBy('model','DESC')->pluck('model');
            }


            if(isset($selectedMake) && isset($selectedYear) && isset($selectedModel) && $columnname == 'submodel'){

				$data = $vehicle->wheremake($selectedMake)->where('year',$selectedYear)->where('model',$selectedModel)->select('submodel','body')->distinct('submodel','body')->orderBy('submodel','DESC')->pluck('submodel','body');
            }
 

            return $data??[];
		}
		return [];
}


function embedYoutube($url){

	if(!(strpos($url, 'watch') !== false) && (strpos($url, 'youtu.be') !== false)){
		$parts = explode('/', $url);
		if(count($parts) > 1){
			$url = 'https://www.youtube.com/watch?v='.end($parts);			
		}

	}

	return preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$url);
}

function random_strings($length_of_string) 
{ 
  
    // String of all alphanumeric character 
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
  
    // Shufle the $str_result and returns substring 
    // of specified length 
    return substr(str_shuffle($str_result),  
                       0, $length_of_string); 
} 

function upload_file($path,$image,$sting_length){
	$imagename =random_strings($sting_length).'.png';
    $image->getClientOriginalName();
    $image->move(public_path($path),$imagename);
    return $path.$imagename;
}

function img($img){	
	if($img == ""){
		return asset('admin/no-image.png');
	}else if (strpos($img, 'http') !== false) {
        return $img;
    }else{
		return asset('storage/'.$img);
	}
}



function enquiries_list($key=''){     
	$list  = array(
		'1'=>'Sales Department Discounted Wheel Warehouse',
		'2'=>'For Local Retail Sales Questions',
		'3'=>'For Financing Questions',
		'4'=>'For Existing Order Questions',
	);

	if($key!=''){
		return $list[$key];
	}
	return $list;
}


function meta_attributes($key=''){     
	$list  = array(
				'description',
				'keywords',
				'author',
				'viewport',
			);
	return $list;
}

function meta_pages($key=''){     
	$list  = array(
				'Home',
				'Wheels',
				'Tires',
				'Visualiser',
				'About',
				'Contact',
			);
	return $list;
}


function MetaViewer($page='Home',$customData=[]){
	$tags = "";
	$keywords =MetaKeyword::where('page',$page)->get();
	foreach ($keywords as $key => $keyword) {
		$tags.="
	<meta name=".$keyword->key." content=".$keyword->value.">";
	}

	if(count($customData) > 0){
		foreach ($customData as $key => $value) {
			$tags.="
		<meta name=".$key." content=".$value.">";
		}
	}

	return $tags;

}

function OrderStatus($status='',$condition=''){     
	$list  = array(
				'RETURNED',
				'CANCELLED',
				'ORDERED',
				'PROCESSING',
				'PRODUCTION',
				'SHIPPED',
				'DELIVERED',
			);

	if($status !=''){
		if($condition!=''){
			if($condition == 'greater'){
				return array_slice($list, array_search($status, array_keys($list)));
			}elseif($condition == 'all'){
				return $list;
			}else{
				return $list;
			}
		}else{
			return $list[$status];
		}
	}

	return $list;
}


function getOrderNumber($id=''){     
	 
	return "DWW".date("y").date("m").date("d").str_pad($id, 4, '0', STR_PAD_LEFT);
}


function cmspagecategories($key=''){     
	$list  = array(
				'TopNavbar',
				'InformationPage',
				// 'ShortcutLinks',
			);
	return $list;
}

function getCMSPages($category=''){  
	$list = CMSPage::where('pagecategory',$category)->get();
	if($list){
		return $list;
	}else{
		return null;
	}

}
function viewCMSPage($routename=''){  

	$page = CMSPage::where('routename',$routename)->first();
	if($page){
		return $page->content;
	}else{
		return null;
	}

}


function getSliders($page){

	$sliders = Slider::where('page',$page)->orderby('order')->get();

	return $sliders;
 
}


function TicketStatus($status='',$condition=''){    
	// Open, Responding, Waiting on Customer, Refund Request, RMA, Closed 
	$list  = array(
				'1'=>'OPEN',
				'2'=>'RESPONDING',
				'3'=>'WAITING',
				'4'=>'REFUNDREQUEST', 
				'5'=>'RMA',
				'6'=>'CLOSED',
			);

	if($status !=''){
		if($condition!=''){
			if($condition == 'greater'){
				return array_slice($list, array_search($status, array_keys($list)));
			}elseif($condition == 'all'){
				return $list;
			}else{
				return $list;
			}
		}else{
			return $list[$status];
		}
	}

	return $list;
}

function ViewTicketStatus($key=''){    
	// Open, Responding, Waiting on Customer, Refund Request, RMA, Closed 
 
	$list  = array(
		'OPEN'=>'Open',
		'RESPONDING'=>'Responding',
		'WAITING'=>'Waiting on Customer',
		'REFUNDREQUEST'=>'Refund Request',
		'RMA'=>'RMA',
		'CLOSED'=>'Closed',
	);

	if($key!=''){
		return $list[$key];
	}
	return $list;
}

 




function getTicketSubjects($key=''){     
	$list  = array(
		'1'=>'Issue on purchasing products through online',
		'2'=>'Products Delivery Delay'
	);

	if($key!=''){
		return $list[$key];
	}
	return $list;
}




function getTicketNumber($id=''){     
	 
	return "DWWTKT".date("y").date("m").str_pad($id, 4, '0', STR_PAD_LEFT);
}


function getLimitedWords($inputstring='',$wordcount='5'){     
	 $pieces = explode(" ", $inputstring);
	return implode(" ", array_splice($pieces, 0, $wordcount));
	// return "DWWTKT".date("y").date("m").str_pad($id, 4, '0', STR_PAD_LEFT);
}


function getRatingList($key=''){     
	$list  = array(
		"tread"=>"Tread",
		"noise"=>"Noise",
		"longevity"=>"Longevity",
		"grip"=>"Grip",
		"wet"=>"Wet", 
	);

	if($key!=''){
		return $list[$key];
	}
	return $list;
}


function getFeatureRatings($partno,$ratingfeature,$category){
	$reviews = Review::with('Ratings')->where('approval','1')->where('partno',$partno)->where('category',$category)->get();
	$featureRatings = array(); 
	foreach ($reviews as $key1 => $review) {
		foreach ($review->Ratings as $key2 => $rating) {
			if($rating->feature == $ratingfeature){

 				array_push($featureRatings,$rating->rating);
			}
		}
	} 
	if(count($featureRatings)>0 && array_sum($featureRatings) >0){

		return array_sum($featureRatings)/count($featureRatings);
	}else{

		return 0;
	}
}

function getReviewRatings($partno,$ratingValue,$category){
	$reviews = Review::with('Ratings')
		->where('approval','1')
		->where('partno',$partno)
		->where('category',$category)
		->where('avgrating','>=',$ratingValue)
		->where('avgrating','<',$ratingValue+1)
		->get();
	 
	return count($reviews);
}


function getStates($code='US'){

	$country = Country::where('code',$code)->first();
	if($country != null){
		$states = State::where('country_id',$country->id)->get();
	}else{
		$states = State::get();
	}
	
	return $states;
}

function getAdminModules($key='',$flag=null){     
	$list  = array(
		"brands"=>"Brands",
		"car"=>"Car",
		"chassis"=>"Chassis",
		"cmspage"=>"CMS",
		"dropshipper"=>"DropShippers",
		"enquiry"=>"Enquiries",
		"feedback"=>"Feedbacks" ,
		"metakeywords"=>"Meta Keywords",
		"orders"=>"Orders",
		"post"=>"Post",
		"review"=>"Review" ,
		"cms"=>"Settings",
		"slider"=>"Slider Images",
		"ticket"=>"Tickets",
		"tire"=>"Tires",
		"user"=>"Users",
		"vehicle"=>"Vehicles",
		"wheel"=>"Wheels",
		"wheelproduct"=>"Wheelproducts",
		"logs"=>"Server Logs",
	);
 
	if($flag){
		// dd(array_key_exists($key, $list));
		return array_key_exists($key, $list);
	}

	if($key!=''){
		return $list[$key];
	}
	return $list;
}


function VerifyAccess($routename='',$accessType=''){   

	$admin = Auth::guard('admin')->user();
	if(@$admin->is_super == '1'){
		return true;
	}else{
		if($routename){

			$readAccess = in_array($routename, json_decode($admin->Roles->read?:[])??array()); 
			$writeAccess = in_array($routename, json_decode($admin->Roles->write?:[])??array());
			$wholeAccess = in_array($routename, array_merge(json_decode($admin->Roles->read?:[]),json_decode($admin->Roles->write?:[])));

			if($accessType == 'read'){
				return $readAccess;
			}elseif($accessType == 'write'){
				return $writeAccess;
			}elseif($accessType == ''){
				return $wholeAccess;
			}
		}
		return false;
	}
}



function getFTPfolders($key='',$flag=null){     
	$list  = array(
		"Omni"=>"vftp0010",
		"Barons"=>"vftp0011",
		"Future"=>"vftp0012",
		"Economy"=>"vftp0013",
		"TWI"=>"vftp0014",
		"Reliable"=>"vftp0015",
		"WheelPros"=>"vftp0016",
		"TSW"=>"vftp0017",
		"TheWheelGroup"=>"vftp0018",
		"Turbo"=>"vftp0019",
		"KMTires"=>"vftp0022",
		"MHT"=>"vftp0023",
		"TiresWarehouse"=>"vftp0024",
		"KWTire"=>"vftp0027",
		"TreadMaxx"=>"vftp0028",
		"SSTire"=>"vftp0029",
		"ATD"=>"vftp0030",
		"TireHub"=>"vftp0031",
		"TBC"=>"vftp0032",
		"VisionWheels"=>"vftp0033",
		"Asanti"=>"vftp0036",
		"DWG"=>"vftp0037",
		"Giovanna"=>"vftp0038",
		"Lexani"=>"vftp0040",
		"BSI"=>"vftp0042",
		"MKW"=>"vftp0043",
		"NS-Tuner"=>"vftp0044",
		"Pinnacle"=>"vftp0045",
		"Prestige"=>"vftp0046",
		"Raceline"=>"vftp0047",
		"Rohana"=>"vftp0048",
		"Strada"=>"vftp0049",
		"TradeUnion"=>"vftp0050",
		"Ultra"=>"vftp0051",
		"VMR"=>"vftp0052",
		"XIX"=>"vftp0053",
		"Varro"=>"vftp0054",
		"Azad"=>"vftp0055",
	);
 
	if($flag){
		// dd(array_key_exists($key, $list));
		return array_key_exists($key, $list);
	}

	if($key!=''){
		return $list[$key]??'-';
	}
	return $list;
}
 

function getVehicleLiftSize($key='',$flag=null){ 
	$list  = array(
		'3lift'=>'3" Lift',
		'6lift'=>'6" Lift',
		'8lift'=>'8" Lift',
		'4lift'=>'4" Lift',
	); 
	if($flag){
		// dd(array_key_exists($key, $list));
		return array_key_exists($key, $list);
	}

	if($key!=''){
		return $list[$key]??'-';
	}
	return $list;
}
 


 function findMyIP(){
 	        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
 }