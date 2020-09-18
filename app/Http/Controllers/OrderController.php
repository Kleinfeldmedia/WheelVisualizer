<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\OrderStatus;
use App\Tire;
use App\WheelProduct;
use Illuminate\Http\Request;
use Session;
use Auth;
use PDF;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('OrderItems')->paginate(10);
        // dd($orders);
        return view('admin.orders.index',compact('orders'));
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
            'firstname'=>'required|max:255',
            'lastname'=>'required|max:255',
            // 'companyname'=>'required|max:255',
            'email'=>'required|email|max:255',
            'dayphone'=>'required|max:255',
            'cellphone'=>'required|max:255',
            'address'=>'required|max:255',
            // 'address2'=>'required|max:255',
            'state'=>'required|max:255',
            'city'=>'required|max:255',
            'zip'=>'required|max:255',
            'make'=>'required|max:255',
            'year'=>'required|max:255',
            'model'=>'required|max:255',
            'trim'=>'required|max:255',
            'vehicle_modified'=>'required|max:255',
            'big_brake_kit'=>'required|max:255',
            'raised_lowered'=>'required|max:255',
            // 'modified_notes'=>'required|max:255',
            // 'notes'=>'required|max:255',
        ]);
        try{  



            $data = $request->except(['_token']);

            $cart = Session::get('cart')?:[];

            if(count($cart) > 0){

                $order = Order::create($data);
                $subtotal =0;
                $updateOrder=[];
                foreach ($cart as $key => $item) {
                    if($item['type']=='wheel'){
                        $cart[$key]['data']=WheelProduct::find($item['id']);
                    }
                    if($item['type']=='tire'){
                        $cart[$key]['data']=Tire::find($item['id']);
                    } 
                    $total=$cart[$key]['qty']*$cart[$key]['data']->price;
                    $subtotal +=$total;
                    OrderItem::create([
                        "orderid" => $order->id,
                        "producttype" => $item['type'],
                        "productid" => $item['id'],
                        "qty" => $item['qty'],
                        "price" => $cart[$key]['data']->price,
                        "total" => $total,
                    ]);


                }

                $updateOrder['userid'] = Auth::user()->id??null;
                
                $updateOrder['subtotal']=$subtotal;

                $updateOrder['fees']=0;

                $updateOrder['tax']=0;

                $updateOrder['shipping']=0;

                $updateOrder['total']=$subtotal+($updateOrder['fees']+$updateOrder['tax']+$updateOrder['shipping']);

                $updateOrder['payment_status'] = 0;

                $updateOrder['status'] = 'ORDERED';

                $updateOrder['ordernumber'] = getOrderNumber($order->id); 


                OrderStatus::create([
                    "orderid" => $order->id,
                    "status" => 'ORDERED'
                ]);


                $order->update($updateOrder);

                Session::put('cart',null);
                
                return redirect('/CartItems')->with('success','Order saved successfully');
            }else{

                return back()->with('error','Something Went Wrong!!');
            }
        }catch(Exception $e){
            return back()->with('error',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    { 

        if($order != null){
            $order->status=$request->status;
            $order->save();
            OrderStatus::create([
                'status'=>$request->status,
                'orderid'=>$order->id,
            ]);
            return ['status' => true,'msg'=>'Status Updated Successfully!!'];
        }else{

            return ['status' => false,'msg'=>'Status Updated Failed!!'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function invoice_pdf(Request $request,$id){
        $id = base64_decode($id);
        if($id != ''){

            $order = Order::with('OrderItems')->find($id); 

            $pdf = PDF::loadView('user.orders.invoice',compact('order'));
  
            
            return $pdf->download($order->ordernumber?:'Invoice'.'.pdf');
        }


        // $data = $this->usersGenerator();
        return (new FastExcel($data))->download($request->module.'.csv');


        // Excel::create($request->module, function($excel) use($data,$request) {

        //     $excel->sheet($request->module, function($sheet) use($data) {

        //         $sheet->fromArray($data);

        //     });

        // })->export('csv');
    }

}
