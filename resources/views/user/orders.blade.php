@extends('user.layouts.app') @section('content')
<style type="text/css">
   
    .items-modal{
      width: 1000px !important;
    }
    .td-center{
        text-align: center !important;
    } 
    .profile-img{
        text-align: center;
    }

</style>
 <div class="product-status mg-b-15">
    <div class="container-fluid" style="min-height: 680px;">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap drp-lst">
                    <h4>My Orders</h4>
                    <div style="text-align:right;padding-bottom: 20px">  
                    
                    </div>
                    <div class="asset-inner">
                        <table>
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Order # </th>
                                    <th>Name</th>
                                    <th>No.Of Items</th>
                                    <th>Billing Address</th>
                                    <th>Shipping Address</th>
                                    <th>Vehicle</th>
                                    <th>Notes</th>
                                    <!-- <th>Subtotal</th> -->
                                    <th>Fees</th>
                                    <th>Tax</th>
                                    <th>Shipping</th>
                                    <th>Total</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>Ordered At</th>
                                </tr>
                            </thead> 
                            @forelse(@$orders as $key => $order) 
                            <tr>
                                <td>{{@$key+1}}</td>
                                <td><a href="{{url('/user/invoice/')}}/{{base64_encode($order->id)}}">{{@$order->ordernumber?:'Download'}}</a></td>
                                <td>{{@$order->firstname}}</td>
                                <td class="td-center">

                                                    <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#items{{$key}}">{{@$order->OrderItems->count()}} Items</button>
                                
                                                    <!-- model Start -->
                                                    <div class="modal fade " id="items{{$key}}" role="dialog">
                                                        <div class="items-modal modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title text-left">Ordered Items</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                <h4 class="modal-title">
                                                                        <table class="table table-bordered"> 
                                                                          <tr>
                                                                            <th>Type</th>
                                                                            <th>Image</th>
                                                                            <th>Detail</th>
                                                                            <th>Each Price</th>
                                                                            <th>Quantity</th>
                                                                            <th>Total</th>
                                                                          </tr>
                                                                          @foreach($order->OrderItems as $orderKey =>$item)
                                                                          <tr>
                                                                            <td>{{ucfirst(@$item->producttype)}}</td>
                                                                            <td><img src="{{ViewImage(@$item->ProductDetail()->prodimage)}}"></td>
                                                                            <td>{{@$item->ProductDetail()->detailtitle}}</td>
                                                                            <td>{{roundCurrency(@$item->price)}}</td>
                                                                            <td  class="td-center">{{@$item->qty}}</td>
                                                                            <td>{{roundCurrency(@$item->total)}}</td>
                                                                          </tr>
                                                                          @endforeach
                                                                        </table>
                                                                </h4> 
                                                                        <div class="form-group has-success has-feedback text-center">
                                                                            <button class="btn btn-info btn-close" type="button" data-dismiss="modal" >Close</button>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Model End  -->                    
                                </td>
                                <td class="td-center">
                                                    <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#billing{{$key}}">View</button>
                                                    <!-- model Start -->
                                                    <div class="modal fade " id="billing{{$key}}" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title text-left">Billing Address</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                <h4 class="modal-title">
                                                                        <table class="table table-bordered"> 
                                                                          <tr>
                                                                            <td>First Name</td>
                                                                            <td>{{@$order->firstname}}</td> 
                                                                          </tr>
                                                                          <tr>
                                                                            <td>Last Name</td>
                                                                            <td>{{@$order->lastname}}</td> 
                                                                          </tr>
                                                                          <tr>
                                                                            <td>Company Name</td>
                                                                            <td>{{@$order->companyname}}</td> 
                                                                          </tr>
                                                                          <tr>
                                                                            <td>Email</td>
                                                                            <td>{{@$order->email}}</td> 
                                                                          </tr>
                                                                          <tr>
                                                                            <td>Day Phone</td>
                                                                            <td>{{@$order->dayphone}}</td> 
                                                                          </tr>

                                                                          <tr>
                                                                            <td>Cell Phone</td>
                                                                            <td>{{@$order->cellphone}}</td> 
                                                                          </tr>

                                                                          <tr>
                                                                            <td>Address</td>
                                                                            <td>{{@$order->address}}<br>{{@$order->address2}}</td> 
                                                                          </tr>

                                                                          <tr>
                                                                            <td>State</td>
                                                                            <td>{{@$order->state}}</td> 
                                                                          </tr>

                                                                          <tr>
                                                                            <td>Zip</td>
                                                                            <td>{{@$order->zip}}</td> 
                                                                          </tr>
                                                                        </table>
                                                                </h4> 
                                                                        <div class="form-group has-success has-feedback text-center">
                                                                            <button class="btn btn-info btn-close" type="button" data-dismiss="modal" >Close</button>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Model End  -->
                                </td>
                                <td class="td-center">
                                  @if(@$order->same_shipping != 'yes')
                                                    <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#shipping{{$key}}">View</button>
                                  @else
                                    Same as Billing Address
                                  @endif
                                                    <!-- model Start -->
                                                    <div class="modal fade " id="shipping{{$key}}" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title text-left">Shipping Address</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                <h4 class="modal-title">
                                                                        <table class="table table-bordered"> 
                                                                          <tr>
                                                                            <td>First Name</td>
                                                                            <td>{{@$order->shipping_firstname}}</td> 
                                                                          </tr>
                                                                          <tr>
                                                                            <td>Last Name</td>
                                                                            <td>{{@$order->shipping_lastname}}</td> 
                                                                          </tr>
                                                                          <tr>
                                                                            <td>Company Name</td>
                                                                            <td>{{@$order->shipping_companyname}}</td> 
                                                                          </tr>
                                                                          <tr>
                                                                            <td>Email</td>
                                                                            <td>{{@$order->shipping_email}}</td> 
                                                                          </tr>
                                                                          <tr>
                                                                            <td>Day Phone</td>
                                                                            <td>{{@$order->shipping_dayphone}}</td> 
                                                                          </tr>

                                                                          <tr>
                                                                            <td>Cell Phone</td>
                                                                            <td>{{@$order->shipping_cellphone}}</td> 
                                                                          </tr>

                                                                          <tr>
                                                                            <td>Address</td>
                                                                            <td>{{@$order->shipping_address}}<br>{{@$order->shipping_address2}}</td> 
                                                                          </tr>

                                                                          <tr>
                                                                            <td>State</td>
                                                                            <td>{{@$order->shipping_state}}</td> 
                                                                          </tr>

                                                                          <tr>
                                                                            <td>Zip</td>
                                                                            <td>{{@$order->shipping_zip}}</td> 
                                                                          </tr>
                                                                        </table>
                                                                </h4> 
                                                                        <div class="form-group has-success has-feedback text-center">
                                                                            <button class="btn btn-info btn-close" type="button" data-dismiss="modal" >Close</button>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Model End  -->
                                </td>
                                <td>
                                                    <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#vehicle{{$key}}">View</button>
                                                    <!-- model Start -->
                                                    <!-- model Start -->
                                                    <div class="modal fade " id="vehicle{{$key}}" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title text-left">Vehicle Information</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                <h4 class="modal-title">
<pre>
Make                    : {{@$order->make}},
Year                    : {{@$order->year}},
Model                   : {{@$order->model}},
Trim                    : {{@$order->trim}},

Is Vehicle Modified?    : {{@$order->vehicle_modified}}<br>
Big Brake Kit?          : {{@$order->big_brake_kit}}<br>
Raised or Lowered?      : {{@$order->raised_lowered}}<br>
Modified Please Explain : 
    {{@$order->modified_notes}}


</pre>
                                                                </h4> 
                                                                        <div class="form-group has-success has-feedback text-center">
                                                                            <button class="btn btn-info btn-close" type="button" data-dismiss="modal" >Close</button>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Model End  -->

                                </td>

                                <td><textarea class="form-control" cols="15" readonly="">{{@$order->notes}}
                                        </textarea></td>
                                <!-- <td>{{roundCurrency(@$order->subtotal)}}</td> -->
                                <td>{{roundCurrency(@$order->fees)}}</td>
                                <td>{{roundCurrency(@$order->tax)}}</td>
                                <td>{{roundCurrency(@$order->shipping)}}</td>
                                <td>{{roundCurrency(@$order->total)}}</td>
                                <td>{{@$order->payment_status?'Paid':'Not Paid'}}</td> 
                                <td>{{@$order->status}}</td>
                                
                                <td><a href="{{url('trackorder')}}/{{base64_encode($order->id)}}" class="btn btn-info"> Track Order</a></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Orders found</td>
                            </tr>
                            @endforelse
                        </table>

                        {{$orders->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

@endsection