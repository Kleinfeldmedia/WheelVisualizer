<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\WheelProduct;
use App\Tire;
use App\Dropshipper;
use App\Inventory;
use App\UserCart;
use Auth;

use App\Http\Controllers\ZipcodeController as Zipcode;
use Ixudra\Curl\Facades\Curl;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $user = Auth::user();
        if($user != null){

            $cart = UserCart::where('userid',$user->id)->get()->toArray();
        }else{

            $cart = Session::get('cart')?:[];
        }
        // dd($cart);
        $cartData=$cart;
        foreach ($cart as $key => $item) {
            if($item['producttype']=='wheel'){
                $cartData[$key]['data']=WheelProduct::find($item['productid']);
            }
            if($item['producttype']=='tire'){
                $cartData[$key]['data']=Tire::find($item['productid']);
            }
        }

        return view('shopping_cart',compact('cart','cartData')); 
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

        $msg = '';

        $user = Auth::user();
        if($user != null){

            $cart = UserCart::where('userid',$user->id)->get()->toArray();
        }else{

            $cart = Session::get('cart')?:[];
        }

        $flag=0;
        foreach ($cart as $key => $item) {

            if($item['productid'] == $request->productid && $item['producttype'] == $request->prodtype){
                $flag=1;
                $itemcart = UserCart::where('id',$item['id'])->first();
                $itemcart->productid =  $request->productid;
                $itemcart->producttype =  $request->prodtype;
                $itemcart->qty =  $request->qty;
                $itemcart->price =  $request->price;
                $itemcart->save();
                break;
            }
        }
        if($flag==0){
            if($request->productid != null ){ 


                if($request->prodtype=='wheel'){
                    $product =WheelProduct::find($request->productid);
                }
                if($request->prodtype=='tire'){
                    $product =Tire::find($request->productid);
                } 
 
                $zipcode = \Session::get('user.zipcode');

                // $dropshipper_codes = Dropshipper::where('zip',$zipcode)->pluck('code');

                // $inventories = Inventory::whereIn('location_name',$dropshipper_codes)->where('partno',$product->partno)->get();
                // dd(count($inventories) > 0 );
                // if(count($inventories) > 0 ){

                $itemcart = new UserCart;
                $itemcart->productid =  $request->productid;
                $itemcart->producttype =  $request->prodtype;
                $itemcart->qty =  $request->qty;
                $itemcart->price =  $request->price;
                $itemcart->save();
                // }else{
                //     $msg = '<br><b>This Product does not available near your location based on your zipcode. <br> Choose another product or Change the zipcode </b><br>'; 
                //     return ['status'=>'failed','message'=>$msg];
                // }


            }
        }
        // Session::put('cart', $cart);

        if(Session::get('user.packagetype') == 'wheeltirepackage' && $request->prodtype == 'tire'){
                $msg .= '<br><b>This completes your Wheel and Tire Package, which will come mounted and balanced, ready to be installed on your vehicle</b><br>'; 
        }

        if(Session::get('user.packagetype') == 'shippedpackage' && $request->prodtype == 'tire'){
                $msg .= '<br><b>This completes your Wheel and Tire Combo. Your wheels and tires will not come mounted together. Please make arrangements to have them properly mounted and balanced</b><br>'; 
        }

        // Session::put('user.packagetype') == null;
        // Session::flash('alert-class', 'alert-danger'); 

        // dd($cart);
        // Session::flash('success','Product Added to Cart!');
        //dd(Session::get('cart'));
        return ['status'=>'success','message'=>$msg];
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
    public function update(Request $request)
    {


        $user = Auth::user();
        if($user != null){

            $cart = UserCart::where('userid',$user->id)->get()->toArray();
        }else{

            $cart = Session::get('cart')?:[];
        }

         
        // dd($cart);
        foreach ($cart as $key => $item) {
            if($item['id'] == $request->productid && $item['type'] == $request->prodtype){
                $flag=1;
                $cart[$key]['qty']= $request->qty;
                Session::put('cart', $cart);
                return 'success';
            }
        }
        return 'failed';

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type,$id)
    {
        $cart = Session::get('cart');
        foreach ($cart as $key => $item) {
            if($item['id'] == $id && $item['type'] == $type){
                unset($cart[$key]);
            }
        }
        $cart = array_values($cart);
        Session::put('cart', $cart);
        Session::flash('success','Removed one Item!!');
        return redirect()->back();
    }

   
    public function clearCart(Request $cartdata)
    {
        $cart = Session::put('cart',null);
        return redirect()->back();
    }
   
    public function getCartCount(Request $cartdata)
    {
        $cart = Session::get('cart')??[];
        return count($cart);
    }

    public function checkout()
    {   
        $cart = Session::get('cart')?:[];
        // dd($cart);
        $cartData=$cart;
        $subtotal =0;
        $total =0;
        foreach ($cartData as $key => $item) {
            if($item['type']=='wheel'){
                $cartData[$key]['data']=WheelProduct::find($item['id']);
            }
            if($item['type']=='tire'){
                $cartData[$key]['data']=Tire::find($item['id']);
            } 
            $subtotal+=$cartData[$key]['qty']*$cartData[$key]['data']->price;
        }
        $payment['subtotal']=$subtotal;

        $payment['fees']=0;

        $payment['tax']=0;

        $payment['shipping']=0;

        $payment['total']=$subtotal+($payment['fees']+$payment['tax']+$payment['shipping']);
        // dd($cartData);
        return view('checkout',compact('cart','cartData','payment')); 
    }
    
    public function getZipcode(Request $request)
    { 
        $zip = Session::get('user.zipcode');

        return $zip?:'';
    }
    public function zipcodeUpdate(Request $request)
    { 
        $response = false;

        // $response = ZipCode::getCityState($request->all());

        if($response != false){

            $xml = simplexml_load_string($response);
            $state = (string) $xml->ZipCode->State;
            $city = (string) $xml->ZipCode->City;


            // dd($xml,$state,$city);
            Session::put('user.state', $state); 
            Session::put('user.city', $city); 
            Session::put('user.zipcode', $request->zipcode);  
        } else{

            Session::put('user.state', null); 
            Session::put('user.city', null); 
            Session::put('user.zipcode', $request->zipcode);  
        }



        return 'success';
    }

    public function zipcodeClear(Request $request)
    { 
        Session::put('user.zipcode', null);

        return back();
    }

}
